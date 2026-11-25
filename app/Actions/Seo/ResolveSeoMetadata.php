<?php

namespace App\Actions\Seo;

use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResolveSeoMetadata
{
    /** @var array<int, string> */
    private const INDEXABLE_ROUTES = [
        'home',
        'about',
        'service',
        'contact',
        'destinations.show',
        'packages.show',
    ];

    /**
     * @return array<int, string>
     */
    public function headElements(Request $request): array
    {
        $metadata = $this->handle($request);

        $head = [
            sprintf('<title data-inertia="">%s</title>', e($metadata['title'])),
            $this->meta('description', 'description', $metadata['description']),
            $this->meta('robots', 'robots', $metadata['indexable'] ? 'index, follow' : 'noindex, nofollow'),
            $this->meta('og:type', 'og:type', $metadata['type'], 'property'),
            $this->meta('og:site_name', 'og:site_name', (string) config('seo.site_name'), 'property'),
            $this->meta('og:title', 'og:title', $metadata['title'].' - '.(string) config('seo.site_name'), 'property'),
            $this->meta('og:description', 'og:description', $metadata['description'], 'property'),
            $this->meta('og:url', 'og:url', $metadata['url'], 'property'),
            $this->meta('og:image', 'og:image', $metadata['image'], 'property'),
            $this->meta('twitter:card', 'twitter:card', 'summary_large_image'),
            $this->meta('twitter:title', 'twitter:title', $metadata['title'].' - '.(string) config('seo.site_name')),
            $this->meta('twitter:description', 'twitter:description', $metadata['description']),
            $this->meta('twitter:image', 'twitter:image', $metadata['image']),
            sprintf('<link data-inertia="canonical" rel="canonical" href="%s">', e($metadata['url'])),
        ];

        $twitterSite = config('seo.twitter_site');

        if (is_string($twitterSite) && $twitterSite !== '') {
            array_splice($head, 10, 0, [$this->meta('twitter:site', 'twitter:site', $twitterSite)]);
        }

        $structuredData = json_encode($metadata['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

        $head[] = sprintf(
            '<script data-inertia="schema" type="application/ld+json">%s</script>',
            (string) $structuredData
        );

        return $head;
    }

    /**
     * @return array{
     *     title: string,
     *     description: string,
     *     image: string,
     *     url: string,
     *     type: string,
     *     indexable: bool,
     *     entity: array<string, mixed>|null,
     *     schema: array<string, mixed>
     * }
     */
    public function handle(Request $request): array
    {
        $siteName = (string) config('seo.site_name', config('app.name', 'Travel'));
        $defaultDescription = (string) config('seo.description');
        $defaultImage = (string) config('seo.image');
        $routeName = $request->route()?->getName();
        $url = $this->absoluteUrl($request->getPathInfo() ?: '/');

        $metadata = match ($routeName) {
            'home' => [
                'title' => 'Indonesia Culture Trip',
                'description' => $defaultDescription,
                'image' => $defaultImage,
                'type' => 'website',
                'entity' => null,
            ],
            'about' => [
                'title' => 'Tentang Kami',
                'description' => 'Kenali Ijen Bromo Travel, tim perjalanan lokal yang menghadirkan wisata budaya dan petualangan alam Indonesia yang autentik.',
                'image' => $defaultImage,
                'type' => 'website',
                'entity' => null,
            ],
            'service' => [
                'title' => 'Layanan Kami',
                'description' => 'Paket wisata, transportasi, akomodasi, dan pendampingan lokal untuk liburan tanpa repot di destinasi favorit Indonesia.',
                'image' => $defaultImage,
                'type' => 'website',
                'entity' => null,
            ],
            'contact' => [
                'title' => 'Hubungi Kami',
                'description' => 'Konsultasikan itinerary, harga paket, dan pemesanan perjalanan wisata Indonesia bersama tim Ijen Bromo Travel.',
                'image' => $defaultImage,
                'type' => 'website',
                'entity' => null,
            ],
            'destinations.show' => $this->destinationMetadata($request->route('destination'), $defaultDescription, $defaultImage),
            'packages.show' => $this->packageMetadata((string) $request->route('slug'), $defaultDescription, $defaultImage),
            default => [
                'title' => $siteName,
                'description' => $defaultDescription,
                'image' => $defaultImage,
                'type' => 'website',
                'entity' => null,
            ],
        };

        $metadata['url'] = $url;
        $metadata['description'] = $this->cleanDescription($metadata['description']);
        $metadata['image'] = $this->absoluteImage($metadata['image'] ?: $defaultImage);
        $metadata['indexable'] = in_array($routeName, self::INDEXABLE_ROUTES, true);
        $metadata['schema'] = $this->schema($metadata, $siteName, $url);

        return $metadata;
    }

    /**
     * @return array{title: string, description: string, image: string, type: string, entity: array<string, mixed>|null}
     */
    private function destinationMetadata(mixed $destination, string $defaultDescription, string $defaultImage): array
    {
        if (! $destination instanceof Destination) {
            return [
                'title' => 'Destinasi Wisata',
                'description' => $defaultDescription,
                'image' => $defaultImage,
                'type' => 'website',
                'entity' => null,
            ];
        }

        $description = $destination->short_description ?: ($destination->description ?: $defaultDescription);
        $image = $this->absoluteImage($destination->image ?: $defaultImage);
        $entity = [
            '@type' => 'TouristAttraction',
            'name' => $destination->name,
            'description' => Str::squish(strip_tags($description)),
            'image' => $image,
        ];

        if ($destination->location) {
            $entity['address'] = [
                '@type' => 'PostalAddress',
                'addressLocality' => $destination->location,
            ];
        }

        return [
            'title' => $destination->name.' - Destinasi',
            'description' => $description,
            'image' => $image,
            'type' => 'article',
            'entity' => $entity,
        ];
    }

    /**
     * @return array{title: string, description: string, image: string, type: string, entity: array<string, mixed>|null}
     */
    private function packageMetadata(string $slug, string $defaultDescription, string $defaultImage): array
    {
        $package = Package::query()
            ->select(['name_package', 'slug', 'location', 'short_description', 'thumbnail'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (! $package) {
            return [
                'title' => 'Paket Wisata',
                'description' => $defaultDescription,
                'image' => $defaultImage,
                'type' => 'website',
                'entity' => null,
            ];
        }

        $description = $package->short_description ?: $defaultDescription;
        $image = $this->absoluteImage($package->thumbnail ?: $defaultImage);
        $entity = [
            '@type' => 'Product',
            'name' => $package->name_package,
            'description' => Str::squish(strip_tags($description)),
            'image' => $image,
        ];

        if ($package->location) {
            $entity['additionalProperty'] = [
                '@type' => 'PropertyValue',
                'name' => 'Lokasi',
                'value' => $package->location,
            ];
        }

        return [
            'title' => $package->name_package.' - Detail Paket',
            'description' => $description,
            'image' => $image,
            'type' => 'product',
            'entity' => $entity,
        ];
    }

    /**
     * @param  array{title: string, description: string, image: string, entity: array<string, mixed>|null}  $metadata
     * @return array<string, mixed>
     */
    private function schema(array $metadata, string $siteName, string $url): array
    {
        $graph = [
            [
                '@type' => 'WebSite',
                '@id' => $url.'#website',
                'url' => $url,
                'name' => $siteName,
                'description' => $metadata['description'],
            ],
            [
                '@type' => 'WebPage',
                '@id' => $url.'#webpage',
                'url' => $url,
                'name' => $metadata['title'],
                'description' => $metadata['description'],
                'isPartOf' => ['@id' => $url.'#website'],
                'primaryImageOfPage' => [
                    '@type' => 'ImageObject',
                    'url' => $metadata['image'],
                ],
            ],
        ];

        if ($metadata['entity'] !== null) {
            $graph[] = array_merge([
                '@id' => $url.'#entity',
                'url' => $url,
            ], $metadata['entity']);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    private function meta(string $key, string $attributeName, string $content, string $attribute = 'name'): string
    {
        return sprintf(
            '<meta data-inertia="%s" %s="%s" content="%s">',
            e($key),
            $attribute,
            e($attributeName),
            e($content)
        );
    }

    private function cleanDescription(string $description): string
    {
        return Str::limit(Str::squish(strip_tags($description)), 160);
    }

    private function absoluteImage(string $path): string
    {
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return $this->absoluteUrl($path);
    }

    private function absoluteUrl(string $path): string
    {
        $baseUrl = rtrim((string) config('app.url'), '/');

        if ($path === '' || $path === '/') {
            return $baseUrl.'/';
        }

        return $baseUrl.'/'.ltrim($path, '/');
    }
}
