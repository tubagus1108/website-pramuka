<?php

namespace App\Http\Controllers;

use App\Models\OrganizationMenu;

class OrganizationController extends Controller
{
    public function index()
    {
        $menus = OrganizationMenu::where('is_active', true)->get();

        return view('pages.organization.index', compact('menus'));
    }

    public function show($slug)
    {
        $menu = OrganizationMenu::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.organization.show', compact('menu'));
    }
}
