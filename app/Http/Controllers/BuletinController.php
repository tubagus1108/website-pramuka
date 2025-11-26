<?php

namespace App\Http\Controllers;

use App\Models\Buletin;

class BuletinController extends Controller
{
    public function index()
    {
        $buletins = Buletin::where('is_active', true)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(12);

        return view('pages.buletin.index', compact('buletins'));
    }
}
