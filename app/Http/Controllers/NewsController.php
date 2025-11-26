<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Agenda;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by tag
        if ($request->has('tag') && $request->tag) {
            $query->where('tags', 'like', '%' . $request->tag . '%');
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $news = $query->orderByDesc('published_at')->paginate(12);
        
        // Get available categories for filter
        $categories = News::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        return view('news', compact('news', 'categories'));
    }

    public function show(string $slug)
    {
        $news = News::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related news by category
        $relatedNews = News::where('is_active', true)
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        // Get latest news for sidebar
        $latestNews = News::where('is_active', true)
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        // Get upcoming agendas
        $agendas = Agenda::where('is_active', true)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get();

        return view('news-detail', compact('news', 'relatedNews', 'latestNews', 'agendas'));
    }
}
