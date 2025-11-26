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
                        <a href="/organization" class="text-gray-700 hover:text-blue-600">Organisasi</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-orange-700 font-semibold">{{ $menu->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- PAGE HEADER --}}
        <div class="bg-gradient-to-r from-orange-600 to-orange-800 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                    <i class="fas fa-file-alt text-4xl md:text-5xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $menu->title }}</h1>
                    <p class="text-sm md:text-base text-orange-100">Organisasi Pramuka DIY</p>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="max-w-4xl mx-auto">
            {{-- MAIN CONTENT --}}
            <article class="bg-white rounded-lg shadow-md p-5 md:p-8">
                <div class="prose prose-sm md:prose-lg max-w-none">
                    @if($menu->content)
                        <div class="content text-gray-700 leading-relaxed">
                            {!! nl2br(e($menu->content)) !!}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Konten belum tersedia</p>
                        </div>
                    @endif
                </div>

                {{-- SHARE BUTTONS --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h4 class="font-bold mb-3 flex items-center gap-2 text-gray-800">
                        <i class="fas fa-share-alt text-orange-600"></i>
                        Bagikan Halaman Ini:
                    </h4>
                    <div class="flex flex-wrap gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank" 
                           class="flex items-center gap-2 bg-blue-600 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                            <i class="fab fa-facebook-f"></i>
                            <span class="hidden sm:inline">Facebook</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($menu->title) }}" 
                           target="_blank" 
                           class="flex items-center gap-2 bg-sky-500 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-sky-600 transition text-sm">
                            <i class="fab fa-twitter"></i>
                            <span class="hidden sm:inline">Twitter</span>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($menu->title . ' ' . request()->url()) }}" 
                           target="_blank" 
                           class="flex items-center gap-2 bg-green-600 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                            <i class="fab fa-whatsapp"></i>
                            <span class="hidden sm:inline">WhatsApp</span>
                        </a>
                    </div>
                </div>

                {{-- BACK TO ORGANIZATION --}}
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="/organization" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-800 font-semibold text-sm transition">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Halaman Organisasi
                    </a>
                </div>
            </article>
        </div>
    </div>
@endsection
