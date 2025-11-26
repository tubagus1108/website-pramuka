<?php

namespace App\Http\Controllers;

class RobotsController extends Controller
{
    public function index()
    {
        $robotsTxt = "User-agent: *\n";
        $robotsTxt .= "Allow: /\n";
        $robotsTxt .= "Disallow: /admin\n";
        $robotsTxt .= "Disallow: /filament\n";
        $robotsTxt .= "\n";
        $robotsTxt .= 'Sitemap: '.url('/sitemap.xml')."\n";
        $robotsTxt .= "\n";
        $robotsTxt .= "# Pramuka UIN Sultanah Nahrasiyah - Lhokseumawe, Aceh\n";

        return response($robotsTxt, 200, ['Content-Type' => 'text/plain']);
    }
}
