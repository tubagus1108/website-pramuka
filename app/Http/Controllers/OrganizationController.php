<?php

namespace App\Http\Controllers;

use App\Models\OrganizationMenu;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $menus = OrganizationMenu::where('is_active', true)->get();
        return view('organization', compact('menus'));
    }

    public function show($slug)
    {
        $menu = OrganizationMenu::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('organization-detail', compact('menu'));
    }
}
