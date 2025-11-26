<?php

namespace App\Http\Controllers;

use App\Models\ProfileMenu;

class ProfileController extends Controller
{
    public function index()
    {
        $menus = ProfileMenu::where('is_active', true)->get();

        return view('pages.profile.index', compact('menus'));
    }

    public function show($slug)
    {
        $menu = ProfileMenu::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.profile.show', compact('menu'));
    }
}
