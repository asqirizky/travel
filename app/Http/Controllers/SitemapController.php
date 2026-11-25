<?php

namespace App\Http\Controllers;

use App\Actions\Seo\GenerateSitemapXml;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(GenerateSitemapXml $generateSitemapXml): Response
    {
        return response($generateSitemapXml->handle(), 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
