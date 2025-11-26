@extends('layouts.main')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('main-content')
    {{-- HERO SLIDER --}}
    <div class="container mx-auto px-4 py-4 md:py-6">
        <div class="relative overflow-hidden rounded-xl shadow-2xl" style="height: 300px;" id="heroSlider">
            @if(isset($sliders) && count($sliders) > 0)
                @foreach($sliders as $index => $slider)
                    <div class="slider-item absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
                        <img src="{{ $slider->image ? Storage::url($slider->image) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&h=400&fit=crop' }}"
                             alt="{{ $slider->title }}"
                             class="w-full h-full object-cover"
                             onerror="this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&h=400&fit=crop'">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-blue-800/60 to-transparent flex items-center">
                            <div class="container mx-auto px-6 md:px-12">
                                <div class="max-w-2xl">
                                    <h2 class="text-white text-2xl md:text-4xl font-bold mb-2 md:mb-3 drop-shadow-lg">{{ $slider->title }}</h2>
                                    @if($slider->description)
                                        <p class="text-white text-sm md:text-lg mb-3 md:mb-4 drop-shadow">{{ $slider->description }}</p>
                                    @endif
                                    @if($slider->link)
                                        <a href="{{ $slider->link }}" class="inline-block bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 md:px-6 py-2 md:py-3 rounded-lg hover:from-yellow-500 hover:to-orange-600 transition-all transform hover:scale-105 shadow-lg text-sm md:text-base font-semibold">
                                            Selengkapnya →
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Slider Navigation Dots --}}
                @if(count($sliders) > 1)
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
                        @foreach($sliders as $index => $slider)
                            <button onclick="goToSlide({{ $index }})" class="slider-dot w-2 h-2 md:w-3 md:h-3 rounded-full transition-all {{ $index === 0 ? 'bg-yellow-400 w-6 md:w-8' : 'bg-white/50 hover:bg-white/75' }}"></button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h2 class="text-2xl md:text-4xl font-bold mb-2 md:mb-4">Selamat Datang di Pramuka UIN Sultanah Nahrasiyah</h2>
                        <p class="text-base md:text-xl">Racana Gerakan Pramuka Perguruan Tinggi</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-item');
        const dots = document.querySelectorAll('.slider-dot');

        function goToSlide(index) {
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0');
            if (dots[currentSlide]) {
                dots[currentSlide].classList.remove('bg-yellow-400', 'w-6', 'md:w-8');
                dots[currentSlide].classList.add('bg-white/50');
            }

            currentSlide = index;
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-100');
            if (dots[currentSlide]) {
                dots[currentSlide].classList.remove('bg-white/50');
                dots[currentSlide].classList.add('bg-yellow-400', 'w-6', 'md:w-8');
            }
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        if (slides.length > 1) {
            setInterval(nextSlide, 5000);
        }

        // Filter news by category
        function filterNews(category) {
            const newsCards = document.querySelectorAll('.news-card');
            const newsTabs = document.querySelectorAll('.news-tab');

            // Update active tab
            newsTabs.forEach(tab => {
                if (tab.dataset.category === category) {
                    tab.classList.remove('text-gray-600');
                    tab.classList.add('border-b-2', 'border-blue-600', 'text-blue-600');
                } else {
                    tab.classList.remove('border-b-2', 'border-blue-600', 'text-blue-600');
                    tab.classList.add('text-gray-600');
                }
            });

            // Filter cards
            newsCards.forEach(card => {
                if (card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

    {{-- MAIN CONTENT GRID --}}
    <div class="container mx-auto px-4 pb-8 md:pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
            {{-- LEFT CONTENT (NEWS) --}}
            <div class="lg:col-span-2 space-y-4 md:space-y-6">
                {{-- NEWSFLASH --}}
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3 md:px-4 py-2 md:py-3 rounded-lg flex items-center gap-2 md:gap-3 shadow-lg">
                    <span class="bg-white text-orange-600 px-2 md:px-3 py-1 rounded font-bold text-xs md:text-sm whitespace-nowrap">NEWSFLASH</span>
                    <div class="overflow-hidden flex-1">
                        <div class="animate-marquee whitespace-nowrap text-xs md:text-sm">
                            Selamat Datang di Website Resmi Pramuka UIN Sultanah Nahrasiyah - Ikuti terus informasi dan kegiatan terbaru kami!
                        </div>
                    </div>
                </div>

                {{-- NEWS CATEGORIES TABS --}}
                <div>
                    <div class="flex gap-1 md:gap-2 mb-3 md:mb-4 border-b border-gray-200 overflow-x-auto">
                        <button onclick="filterNews('BERITA')" class="news-tab px-3 md:px-4 py-2 font-semibold border-b-2 border-blue-600 text-blue-600 whitespace-nowrap text-sm md:text-base" data-category="BERITA">BERITA</button>
                        <button onclick="filterNews('ARTIKEL')" class="news-tab px-3 md:px-4 py-2 font-semibold text-gray-600 hover:text-blue-600 whitespace-nowrap text-sm md:text-base" data-category="ARTIKEL">ARTIKEL</button>
                        <button onclick="filterNews('KEGIATAN')" class="news-tab px-3 md:px-4 py-2 font-semibold text-gray-600 hover:text-blue-600 whitespace-nowrap text-sm md:text-base" data-category="KEGIATAN">KEGIATAN</button>
                    </div>

                    {{-- NEWS GRID --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4" id="newsGrid">
                        @forelse($news ?? [] as $item)
                            <a href="/news/{{ $item->slug }}" class="news-card bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1" data-category="{{ $item->category ?? 'BERITA' }}">
                                <div class="relative overflow-hidden h-40 md:h-48 bg-gray-100">
                                    <img src="{{ $item->image ? Storage::url($item->image) : 'https://via.placeholder.com/400x300/1e40af/ffffff?text=Pramuka+UIN' }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                         onerror="this.src='https://via.placeholder.com/400x300/1e40af/ffffff?text=Pramuka+UIN+SN'">
                                    <div class="absolute top-2 md:top-3 left-2 md:left-3">
                                        <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-2 md:px-3 py-1 rounded-md text-xs font-bold shadow-lg">
                                            {{ $item->category ?? 'BERITA' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-3 md:p-4">
                                    <h3 class="font-bold text-sm md:text-base mb-2 line-clamp-2 group-hover:text-blue-600 transition min-h-[2.5rem] md:min-h-[3rem]">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-xs md:text-sm text-gray-600 mb-2 md:mb-3 line-clamp-2">
                                        {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 80) }}
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <i class="far fa-calendar text-yellow-600"></i>
                                            <span class="hidden sm:inline">{{ $item->published_at->format('d M Y') }}</span>
                                            <span class="sm:hidden">{{ $item->published_at->format('d/m/y') }}</span>
                                        </span>
                                        <span class="flex items-center gap-1 text-orange-600">
                                            <i class="far fa-eye"></i>
                                            {{ rand(100, 999) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-8 md:py-12 bg-white rounded-lg shadow">
                                <i class="fas fa-newspaper text-4xl md:text-6xl text-gray-300 mb-3 md:mb-4"></i>
                                <p class="text-gray-500 text-sm md:text-base">Belum ada berita tersedia</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- LOAD MORE --}}
                    @if(isset($news) && count($news) >= 6)
                        <div class="text-center mt-4 md:mt-6">
                            <a href="/news" class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 md:px-8 py-2 md:py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-semibold shadow-lg transform hover:scale-105 text-sm md:text-base">
                                Lihat Semua Berita →
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="space-y-4 md:space-y-6">
                {{-- AGENDA KEGIATAN --}}
                <div class="bg-white rounded-lg shadow-md p-4 md:p-5 border-t-4 border-blue-600">
                    <h4 class="font-bold text-base md:text-lg mb-3 md:mb-4 flex items-center gap-2 text-blue-800">
                        <i class="far fa-calendar-alt text-yellow-600"></i>
                        Agenda Kegiatan
                    </h4>
                    <ul class="space-y-2 md:space-y-3">
                        @forelse($agendas ?? [] as $agenda)
                            <li class="border-l-4 border-yellow-500 pl-2 md:pl-3 py-2 hover:bg-blue-50 transition rounded-r">
                                <div class="flex items-start gap-2">
                                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded px-2 py-1 text-center min-w-[45px] md:min-w-[50px] shadow">
                                        <div class="text-xs">{{ $agenda->date->format('M') }}</div>
                                        <div class="text-lg md:text-xl font-bold">{{ $agenda->date->format('d') }}</div>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-semibold text-xs md:text-sm line-clamp-2">{{ $agenda->title }}</h5>
                                        @if($agenda->location)
                                            <p class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                                <i class="fas fa-map-marker-alt text-orange-500"></i>
                                                <span class="line-clamp-1">{{ $agenda->location }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="text-xs md:text-sm text-gray-500 text-center py-4">Belum ada agenda</li>
                        @endforelse
                    </ul>
                    <a href="/agenda" class="block text-center text-blue-600 hover:text-blue-800 font-semibold text-xs md:text-sm mt-3 md:mt-4 hover:underline">
                        Lihat Semua Agenda →
                    </a>
                </div>

                {{-- VIDEO --}}
                <div class="bg-white rounded-lg shadow-md p-4 md:p-5 border-t-4 border-orange-500">
                    <h4 class="font-bold text-base md:text-lg mb-3 md:mb-4 flex items-center gap-2 text-blue-800">
                        <i class="fab fa-youtube text-red-600"></i>
                        Video Terbaru
                    </h4>
                    <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg overflow-hidden shadow-inner">
                        <iframe width="100%"
                                height="100%"
                                src="..."
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                class="rounded-lg"
                                title="Video profil Pramuka UIN Suna">
                        </iframe>
                    </div>
                </div>

                {{-- TRENDING TAGS --}}
                @if(isset($tags) && count($tags) > 0)
                    <div class="bg-gradient-to-br from-blue-50 to-yellow-50 rounded-lg shadow-md p-4 md:p-5 border-t-4 border-yellow-500">
                        <h4 class="font-bold text-base md:text-lg mb-3 md:mb-4 flex items-center gap-2 text-blue-800">
                            <i class="fas fa-tags text-yellow-600"></i>
                            Trending Tags
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                                <a href="/news?tag={{ $tag }}" class="px-2 md:px-3 py-1 bg-white text-blue-700 border border-blue-300 rounded-full text-xs hover:bg-blue-600 hover:text-white hover:border-blue-600 transition shadow-sm">
                                    #{{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- SOCIAL MEDIA --}}
                <div class="bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 rounded-lg shadow-lg p-4 md:p-5 text-white">
                    <h4 class="font-bold text-base md:text-lg mb-3 md:mb-4 flex items-center gap-2">
                        <i class="fas fa-share-alt"></i>
                        Terhubung dengan Kami
                    </h4>
                    <div class="grid grid-cols-2 gap-2 md:gap-3">
                        <a href="#" aria-label="Ikuti kami di Facebook" class="bg-white/20 hover:bg-white/30 backdrop-blur rounded-lg p-2 md:p-3 text-center transition transform hover:scale-105">
                            <i class="fab fa-facebook-f text-xl md:text-2xl mb-1 md:mb-2" aria-hidden="true"></i>
                            <p class="text-xs">Facebook</p>
                        </a>
                        <a href="#" aria-label="Ikuti kami di Twitter" class="bg-white/20 hover:bg-white/30 backdrop-blur rounded-lg p-2 md:p-3 text-center transition transform hover:scale-105">
                            <i class="fab fa-twitter text-xl md:text-2xl mb-1 md:mb-2" aria-hidden="true"></i>
                            <p class="text-xs">Twitter</p>
                        </a>
                        <a href="#" aria-label="Ikuti kami di Instagram" class="bg-white/20 hover:bg-white/30 backdrop-blur rounded-lg p-2 md:p-3 text-center transition transform hover:scale-105">
                            <i class="fab fa-instagram text-xl md:text-2xl mb-1 md:mb-2" aria-hidden="true"></i>
                            <p class="text-xs">Instagram</p>
                        </a>
                        <a href="#" aria-label="Tonton kami di YouTube" class="bg-white/20 hover:bg-white/30 backdrop-blur rounded-lg p-2 md:p-3 text-center transition transform hover:scale-105">
                            <i class="fab fa-youtube text-xl md:text-2xl mb-1 md:mb-2" aria-hidden="true"></i>
                            <p class="text-xs">YouTube</p>
                        </a>
                    </div>
                </div>

                {{-- NOMOR PRAMUKA STANDAR --}}
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg shadow-md p-4 md:p-5 border-t-4 border-green-600">
                    <h4 class="font-bold text-base md:text-lg mb-3 md:mb-4 flex items-center gap-2 text-green-800">
                        <i class="fas fa-phone text-green-600"></i>
                        Nomor Pramuka Standar
                    </h4>
                    <div class="text-center bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <i class="fas fa-phone-alt text-3xl md:text-4xl text-green-600 mb-2"></i>
                        <p class="text-2xl md:text-3xl font-bold text-green-700">14021</p>
                        <p class="text-xs text-gray-600 mt-2">Layanan Informasi Pramuka</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
