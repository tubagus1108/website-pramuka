<?php

namespace App\Http\Controllers;

use App\Models\ProfileMenu;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $menus = ProfileMenu::where('is_active', true)->get();
        return view('profile', compact('menus'));
    }

    public function show($slug)
    {
        $menu = ProfileMenu::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('profile-detail', compact('menu'));
    }
}
