<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter by level
        if ($request->has('level') && $request->level) {
            $query->where('level', $request->level);
        }

        // Filter by tag
        if ($request->has('tag') && $request->tag) {
            $query->where('tags', 'like', '%'.$request->tag.'%');
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('content', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $materials = $query->orderByDesc('published_at')->paginate(12);

        // Get available categories and levels
        $categories = Material::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        $levels = Material::where('is_active', true)
            ->distinct()
            ->pluck('level')
            ->filter()
            ->sort()
            ->values();

        return view('pages.materials.index', compact('materials', 'categories', 'levels'));
    }

    public function show(string $slug)
    {
        $material = Material::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Increment views
        $material->incrementViews();

        // Get related materials by category
        $relatedMaterials = Material::where('is_active', true)
            ->where('category', $material->category)
            ->where('id', '!=', $material->id)
            ->orderByDesc('published_at')
            ->limit(4)
            ->get();

        // Get popular materials
        $popularMaterials = Material::where('is_active', true)
            ->where('id', '!=', $material->id)
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        return view('pages.materials.show', compact('material', 'relatedMaterials', 'popularMaterials'));
    }
}
