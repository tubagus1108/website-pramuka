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
                        <span class="text-pink-700 font-semibold">Pesan Buper</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- PAGE HEADER --}}
        <div class="bg-gradient-to-r from-pink-600 to-pink-800 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                    <i class="fas fa-user-tie text-4xl md:text-5xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold mb-2">Pesan Ketua Umum (Buper)</h1>
                    <p class="text-sm md:text-base text-pink-100">Sambutan dan Pesan dari Pimpinan</p>
                </div>
            </div>
        </div>

        {{-- FEATURED MESSAGE --}}
        @if($featuredPesan)
            <div class="bg-white rounded-lg shadow-lg p-6 md:p-8 mb-8">
                <div class="flex flex-col md:flex-row gap-6">
                    @if($featuredPesan->author_photo)
                        <img src="{{ Storage::url($featuredPesan->author_photo) }}" alt="{{ $featuredPesan->author }}" class="w-48 h-48 rounded-lg object-cover">
                    @else
                        <div class="w-48 h-48 bg-gradient-to-br from-pink-500 to-pink-700 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-tie text-white text-6xl"></i>
                        </div>
                    @endif
                    <div class="flex-1">
                        <div class="inline-block bg-pink-100 text-pink-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                            <i class="fas fa-star mr-1"></i> Pesan Utama
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $featuredPesan->title }}</h2>
                        @if($featuredPesan->excerpt)
                            <p class="text-gray-600 mb-4">{{ $featuredPesan->excerpt }}</p>
                        @endif
                        <div class="prose max-w-none text-gray-700 mb-4">
                            {!! nl2br(e($featuredPesan->content)) !!}
                        </div>
                        <div class="border-t pt-4">
                            <p class="font-semibold text-gray-800">{{ $featuredPesan->author }}</p>
                            @if($featuredPesan->author_title)
                                <p class="text-sm text-gray-600">{{ $featuredPesan->author_title }}</p>
                            @endif
                            <p class="text-sm text-gray-500 mt-1">{{ $featuredPesan->published_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ALL MESSAGES --}}
        @if($pesanBupers->count() > 0)
            <h3 class="text-xl font-bold text-gray-800 mb-4">Pesan Lainnya</h3>
            <div class="space-y-6">
                @foreach($pesanBupers as $pesan)
                    @if(!$featuredPesan || $pesan->id != $featuredPesan->id)
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <div class="flex gap-4">
                                @if($pesan->author_photo)
                                    <img src="{{ Storage::url($pesan->author_photo) }}" alt="{{ $pesan->author }}" class="w-20 h-20 rounded-lg object-cover">
                                @else
                                    <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user-tie text-white text-2xl"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $pesan->title }}</h4>
                                    @if($pesan->excerpt)
                                        <p class="text-gray-600 mb-3">{{ $pesan->excerpt }}</p>
                                    @endif
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">{{ $pesan->author }}</p>
                                            @if($pesan->author_title)
                                                <p class="text-xs text-gray-500">{{ $pesan->author_title }}</p>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500">{{ $pesan->published_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $pesanBupers->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
                <div class="text-center py-12">
                    <div class="bg-pink-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-tie text-5xl text-pink-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Pesan</h2>
                    <p class="text-gray-600">Pesan dari pimpinan akan segera tersedia.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
