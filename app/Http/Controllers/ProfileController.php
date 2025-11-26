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

    public function show($id)
    {
        $menu = ProfileMenu::where('is_active', true)->findOrFail($id);
        return view('profile-detail', compact('menu'));
    }
}
