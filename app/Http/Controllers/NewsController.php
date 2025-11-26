<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_active', true)->orderByDesc('published_at')->get();
        return view('news', compact('news'));
    }
}
