<?php

namespace App\Http\Controllers;

use App\Models\PesanBuper;

class PesanBuperController extends Controller
{
    public function index()
    {
        $pesanBupers = PesanBuper::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $featuredPesan = PesanBuper::where('is_active', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        return view('pesan-buper', compact('pesanBupers', 'featuredPesan'));
    }
}
