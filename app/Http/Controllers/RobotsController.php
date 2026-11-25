<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $sitemapUrl = rtrim((string) config('app.url'), '/').'/sitemap.xml';
        $content = "User-agent: *\nAllow: /\n\nSitemap: ".$sitemapUrl."\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
