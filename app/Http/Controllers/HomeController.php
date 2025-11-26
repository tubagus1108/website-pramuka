<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Agenda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::where('is_active', true)
            ->orderByDesc('published_at')
            ->take(6)
            ->get();
        $agendas = Agenda::orderBy('date')->take(5)->get();
        $tags = News::where('is_active', true)
            ->pluck('tags')
            ->filter()
            ->flatMap(function ($tags) {
                return array_map('trim', explode(',', $tags));
            })
            ->unique()
            ->take(10)
            ->values();

        $menus = [
            ['url' => '/profile', 'label' => 'PROFIL'],
            ['url' => '/organization', 'label' => 'ORGANISASI'],
            ['url' => '/agenda', 'label' => 'AGENDA'],
            ['url' => '/news', 'label' => 'BERITA'],
        ];

        return view('home', compact('news', 'agendas', 'tags', 'menus'));
    }
}
