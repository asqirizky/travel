<?php

namespace App\Actions\Seo;

use App\Models\Destination;
use App\Models\Package;

class GenerateSitemapXml
{
    public function handle(): string
    {
        $baseUrl = rtrim((string) config('app.url'), '/');
        $urls = [
            $this->url($baseUrl.'/'),
            $this->url($baseUrl.'/about'),
            $this->url($baseUrl.'/service'),
            $this->url($baseUrl.'/contact'),
        ];

        foreach (Destination::query()
            ->select(['slug', 'updated_at'])
            ->where('is_active', true)
            ->orderBy('id')
            ->cursor() as $destination) {
            $urls[] = $this->url(
                $baseUrl.'/destinations/'.rawurlencode($destination->slug),
                $destination->updated_at?->toAtomString()
            );
        }

        foreach (Package::query()
            ->select(['slug', 'updated_at'])
            ->where('is_active', true)
            ->orderBy('id')
            ->cursor() as $package) {
            $urls[] = $this->url(
                $baseUrl.'/packages/'.rawurlencode($package->slug),
                $package->updated_at?->toAtomString()
            );
        }

        return '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"
            .implode("\n", $urls)."\n"
            .'</urlset>'."\n";
    }

    private function url(string $location, ?string $lastModified = null): string
    {
        $xml = '<url><loc>'.$this->escape($location).'</loc>';

        if ($lastModified !== null) {
            $xml .= '<lastmod>'.$this->escape($lastModified).'</lastmod>';
        }

        return $xml.'</url>';
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
