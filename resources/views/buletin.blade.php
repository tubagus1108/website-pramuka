@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.main')

@section('main-content')
    <div class="container mx-auto px-4 py-6 md:py-8">
        {{-- BREADCRUMB --}}
        <nav class="flex mb-4 md:mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="/" class="text-gray-700 hover:text-blue-600 inline-flex items-center">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-indigo-700 font-semibold">Buletin</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- PAGE HEADER --}}
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                    <i class="fas fa-newspaper text-4xl md:text-5xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold mb-2">Buletin Pramuka</h1>
                    <p class="text-sm md:text-base text-indigo-100">Kumpulan Buletin dan Publikasi Resmi</p>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        @if($buletins->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($buletins as $buletin)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        @if($buletin->cover_image)
                            <img src="{{ Storage::url($buletin->cover_image) }}" alt="{{ $buletin->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-6xl"></i>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-sm text-indigo-600 mb-2">
                                <i class="fas fa-calendar"></i>
                                <span>{{ $buletin->edition }} - {{ ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$buletin->month] }} {{ $buletin->year }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $buletin->title }}</h3>
                            @if($buletin->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $buletin->description }}</p>
                            @endif
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-eye mr-1"></i>{{ $buletin->views }} views
                                </span>
                                @if($buletin->file_pdf)
                                    <a href="{{ Storage::url($buletin->file_pdf) }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm inline-flex items-center gap-2">
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $buletins->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
                <div class="text-center py-12">
                    <div class="bg-indigo-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-newspaper text-5xl text-indigo-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Buletin</h2>
                    <p class="text-gray-600">Buletin akan segera tersedia.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
