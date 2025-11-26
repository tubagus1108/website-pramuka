<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Agenda;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();

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

        return view('home', compact('sliders', 'news', 'agendas', 'tags'));
    }
}
