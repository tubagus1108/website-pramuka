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
                        <a href="/agenda" class="text-gray-700 hover:text-blue-600">Agenda</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-green-700 font-semibold">{{ $agenda->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- MAIN CONTENT --}}
        <div class="max-w-4xl mx-auto">
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                {{-- HEADER --}}
                <div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-6 md:p-8">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 hidden md:block">
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4 text-center min-w-[80px]">
                                <div class="text-sm font-semibold">{{ $agenda->date->translatedFormat('M') }}</div>
                                <div class="text-4xl font-bold">{{ $agenda->date->format('d') }}</div>
                                <div class="text-sm">{{ $agenda->date->format('Y') }}</div>
                            </div>
                        </div>
                        
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-xs md:text-sm">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $agenda->date->translatedFormat('l, d F Y') }}
                                </span>
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold mb-3">{{ $agenda->title }}</h1>
                            
                            <div class="flex flex-wrap gap-3 text-sm">
                                @if($agenda->time)
                                    <span class="flex items-center gap-2 bg-white/20 backdrop-blur px-3 py-1.5 rounded-lg">
                                        <i class="fas fa-clock"></i>
                                        {{ $agenda->time }}
                                    </span>
                                @endif
                                
                                @if($agenda->location)
                                    <span class="flex items-center gap-2 bg-white/20 backdrop-blur px-3 py-1.5 rounded-lg">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $agenda->location }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="p-6 md:p-8">
                    @if($agenda->description)
                        <div class="prose prose-sm md:prose-lg max-w-none mb-6">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-info-circle text-green-600"></i>
                                Deskripsi Kegiatan
                            </h3>
                            <div class="text-gray-700 leading-relaxed">
                                {!! nl2br(e($agenda->description)) !!}
                            </div>
                        </div>
                    @endif

                    {{-- INFO BOXES --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border-l-4 border-green-600">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-600 text-white rounded-lg p-3">
                                    <i class="fas fa-calendar-day text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Tanggal</p>
                                    <p class="font-bold text-green-800">{{ $agenda->date->translatedFormat('d F Y') }}</p>
                                    <p class="text-sm text-gray-600">{{ $agenda->date->translatedFormat('l') }}</p>
                                </div>
                            </div>
                        </div>

                        @if($agenda->time)
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border-l-4 border-blue-600">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-600 text-white rounded-lg p-3">
                                        <i class="fas fa-clock text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">Waktu</p>
                                        <p class="font-bold text-blue-800">{{ $agenda->time }}</p>
                                        <p class="text-sm text-gray-600">WIB</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($agenda->location)
                            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-4 border-l-4 border-orange-600 {{ $agenda->time ? 'md:col-span-2' : '' }}">
                                <div class="flex items-center gap-3">
                                    <div class="bg-orange-600 text-white rounded-lg p-3">
                                        <i class="fas fa-map-marker-alt text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">Lokasi</p>
                                        <p class="font-bold text-orange-800">{{ $agenda->location }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- COUNTDOWN or STATUS --}}
                    @php
                        $now = now();
                        $agendaDate = $agenda->date;
                        $isPast = $agendaDate->isPast();
                        $isToday = $agendaDate->isToday();
                        $daysUntil = $now->diffInDays($agendaDate, false);
                    @endphp

                    @if($isToday)
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg p-4 mb-6 text-center">
                            <i class="fas fa-exclamation-circle text-3xl mb-2"></i>
                            <p class="font-bold text-lg">Kegiatan Hari Ini!</p>
                        </div>
                    @elseif($isPast)
                        <div class="bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg p-4 mb-6 text-center">
                            <i class="fas fa-check-circle text-3xl mb-2"></i>
                            <p class="font-bold text-lg">Kegiatan Telah Berlalu</p>
                        </div>
                    @else
                        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg p-4 mb-6 text-center">
                            <i class="fas fa-hourglass-half text-3xl mb-2"></i>
                            <p class="text-sm">Akan dimulai dalam</p>
                            <p class="font-bold text-2xl">{{ abs($daysUntil) }} Hari Lagi</p>
                        </div>
                    @endif

                    {{-- SHARE BUTTONS --}}
                    <div class="pt-6 border-t border-gray-200">
                        <h4 class="font-bold mb-3 flex items-center gap-2 text-gray-800">
                            <i class="fas fa-share-alt text-green-600"></i>
                            Bagikan Agenda Ini:
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               aria-label="Bagikan ke Facebook"
                               class="flex items-center gap-2 bg-blue-600 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                <span class="hidden sm:inline">Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($agenda->title) }}" 
                               target="_blank" 
                               aria-label="Bagikan ke Twitter"
                               class="flex items-center gap-2 bg-sky-500 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-sky-600 transition text-sm">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                                <span class="hidden sm:inline">Twitter</span>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($agenda->title . ' - ' . $agenda->date->translatedFormat('d F Y') . ' ' . request()->url()) }}" 
                               target="_blank" 
                               class="flex items-center gap-2 bg-green-600 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                <i class="fab fa-whatsapp"></i>
                                <span class="hidden sm:inline">WhatsApp</span>
                            </a>
                        </div>
                    </div>

                    {{-- BACK TO AGENDA --}}
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="/agenda" class="inline-flex items-center gap-2 text-green-600 hover:text-green-800 font-semibold text-sm transition">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Kalender Agenda
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>
@endsection
