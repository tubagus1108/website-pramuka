@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4">
        @php
            $menus = [
                ['url' => '/profile', 'label' => 'PROFIL'],
                ['url' => '/organization', 'label' => 'ORGANISASI'],
                ['url' => '/agenda', 'label' => 'AGENDA'],
                ['url' => '/news', 'label' => 'BERITA'],
            ];
            $profileMenus = \App\Models\ProfileMenu::where('is_active', true)->get();
        @endphp
        @include('components.navbar', ['menus' => $menus, 'profileMenus' => $profileMenus])

        <!-- Hero Slider -->
        <div class="mb-6">
            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                <span class="text-2xl font-bold text-gray-500">Slider Berita Utama</span>
            </div>
        </div>

        <!-- Newsflash & Agenda -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <div class="mb-4">
                    <span class="bg-blue-700 text-white px-2 py-1 rounded text-xs font-bold">NEWSFLASH</span>
                    <span class="ml-2 text-gray-700">Berikut Rincian Juara Pertapa Wiradya XXXVII Tahun 2025</span>
                </div>
                <!-- News Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Loop berita dari database -->
                    @foreach($news as $item)
                        <div class="bg-white rounded shadow hover:shadow-lg overflow-hidden">
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-32 object-cover">
                            <div class="p-3">
                                <span class="block text-xs text-blue-700 font-bold mb-1">{{ $item->category }}</span>
                                <h3 class="font-semibold text-base mb-2">{{ $item->title }}</h3>
                                <span class="text-xs text-gray-500">{{ $item->published_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="bg-white rounded shadow p-4 mb-4">
                    <h4 class="font-bold mb-2">Agenda Kegiatan</h4>
                    <!-- Loop agenda dari database -->
                    <ul class="space-y-2">
                        @foreach($agendas as $agenda)
                            <li class="text-sm text-gray-700 border-b pb-1">{{ $agenda->date->format('d M Y') }} - {{ $agenda->title }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white rounded shadow p-4">
                    <h4 class="font-bold mb-2">TRENDING TAGS</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="/news?tag={{ $tag }}" class="text-xs text-blue-700 hover:underline">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
