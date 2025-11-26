<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get first slider image for preloading (LCP optimization)
        $heroImage = $sliders->first()?->image
            ? Storage::url($sliders->first()->image)
            : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&h=400&fit=crop&q=80';

        $news = News::where('is_active', true)
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        $agendas = Agenda::where('is_active', true)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get();

        $tags = News::where('is_active', true)
            ->pluck('tags')
            ->filter()
            ->flatMap(function ($tags) {
                return array_map('trim', explode(',', $tags));
            })
            ->unique()
            ->take(10)
            ->values();

        return view('pages.home', compact('sliders', 'news', 'agendas', 'tags', 'heroImage'));
    }
}
