@extends('layouts.app')

@section('content')
    {{-- HEADER TOP BANNER --}}
    <div class="bg-white border-b">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between py-2 px-4">
            <div class="flex items-center gap-4">
                <img src="/logo.png" alt="Logo" class="h-16">
                <span class="font-bold text-xl text-blue-700">PRAMUKADIY</span>
            </div>
            <div class="flex flex-col md:flex-row gap-2 items-center">
                <img src="/banner.png" alt="Banner" class="h-12 md:h-16">
                <span class="text-xs text-gray-600">#PramukaIstimewa</span>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    @php
        $menus = [
            ['url' => '/profile', 'label' => 'PROFIL'],
            ['url' => '/organization', 'label' => 'ORGANISASI'],
            ['url' => '/agenda', 'label' => 'AGENDA'],
            ['url' => '/news', 'label' => 'BERITA'],
            ['url' => '#', 'label' => 'MATERI'],
            ['url' => '#', 'label' => 'DOKUMEN'],
            ['url' => '#', 'label' => 'TAUTAN'],
        ];
        $profileMenus = \App\Models\ProfileMenu::where('is_active', true)->get();
    @endphp
    @include('components.navbar', ['menus' => $menus, 'profileMenus' => $profileMenus])

    {{-- SLIDER --}}
    <div class="container mx-auto px-4 mt-4">
        <div class="w-full h-64 md:h-96 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
            <span class="text-2xl font-bold text-gray-500">Slider Berita Utama</span>
        </div>
    </div>

    {{-- MAIN CONTENT GRID --}}
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="md:col-span-3 space-y-6">
            {{-- NEWSFLASH --}}
            <div class="bg-white rounded shadow p-4">
                <span class="bg-blue-700 text-white px-2 py-1 rounded text-xs font-bold">NEWSFLASH</span>
                <span class="ml-2 text-gray-700">Berikut Rincian Juara Pertapa Wiradya XXXVII Tahun 2025</span>
            </div>
            {{-- NEWS GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($news ?? [] as $item)
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
            {{-- ARTICLES --}}
            <div class="bg-white rounded shadow p-4">
                <h4 class="font-bold mb-2">Artikel Pramuka</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($articles ?? [] as $article)
                        <div class="border-b pb-2">
                            <h5 class="font-semibold">{{ $article->title }}</h5>
                            <span class="text-xs text-gray-500">{{ $article->published_at->format('d M Y') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- MATERI --}}
            <div class="bg-white rounded shadow p-4">
                <h4 class="font-bold mb-2">Materi Kepramukaan</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($materi ?? [] as $materiItem)
                        <div class="border-b pb-2">
                            <h5 class="font-semibold">{{ $materiItem->title }}</h5>
                            <span class="text-xs text-gray-500">{{ $materiItem->published_at->format('d M Y') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="space-y-6">
            {{-- AGENDA --}}
            <div class="bg-white rounded shadow p-4">
                <h4 class="font-bold mb-2">Agenda Kegiatan</h4>
                <ul class="space-y-2">
                    @foreach($agendas ?? [] as $agenda)
                        <li class="text-sm text-gray-700 border-b pb-1">{{ $agenda->date->format('d M Y') }} - {{ $agenda->title }}</li>
                    @endforeach
                </ul>
            </div>
            {{-- TRENDING TAGS --}}
            <div class="bg-white rounded shadow p-4">
                <h4 class="font-bold mb-2">TRENDING TAGS</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags ?? [] as $tag)
                        <a href="/news?tag={{ $tag }}" class="text-xs text-blue-700 hover:underline">{{ $tag }}</a>
                    @endforeach
                </div>
            </div>
            {{-- SIDEBAR WIDGETS (dummy) --}}
            <div class="bg-white rounded shadow p-4">
                <h4 class="font-bold mb-2">Radio Pramuka Istimewa</h4>
                <audio controls class="w-full">
                    <source src="/radio.mp3" type="audio/mpeg">
                    Browser tidak mendukung audio.
                </audio>
            </div>
            <div class="bg-white rounded shadow p-4">
                <h4 class="font-bold mb-2">Terhubung dengan kami</h4>
                <div class="flex gap-2">
                    <a href="#" class="text-blue-700"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-blue-700"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-blue-700"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-blue-700"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-blue-900 text-white mt-12 py-8">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <img src="/logo.png" alt="Logo" class="h-16">
                <div>
                    <span class="font-bold text-lg">YOGYAKARTA</span><br>
                    <span class="text-xs">Sekretariat: Gedung Dinas Pariwisata DIY, Jl. Cendana, Yogyakarta</span>
                </div>
            </div>
            <div class="text-xs">
                &copy; {{ date('Y') }} Website Pramuka DIY
            </div>
        </div>
    </footer>
@endsection
