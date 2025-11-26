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
                        <span class="text-green-700 font-semibold">Agenda</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- PAGE HEADER --}}
        <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                        <i class="fas fa-calendar-alt text-4xl md:text-5xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-4xl font-bold mb-2">Agenda Kegiatan</h1>
                        <p class="text-sm md:text-base text-green-100">Kalender Kegiatan Pramuka UIN Sultanah Nahrasiyah</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CALENDAR NAVIGATION --}}
        <div class="bg-white rounded-lg shadow-md p-4 md:p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <a href="?year={{ $currentDate->copy()->subMonth()->year }}&month={{ $currentDate->copy()->subMonth()->month }}" 
                   class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-chevron-left"></i>
                    <span class="hidden sm:inline">Bulan Sebelumnya</span>
                </a>
                
                <h2 class="text-xl md:text-2xl font-bold text-green-800">
                    {{ $currentDate->translatedFormat('F Y') }}
                </h2>
                
                <a href="?year={{ $currentDate->copy()->addMonth()->year }}&month={{ $currentDate->copy()->addMonth()->month }}" 
                   class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <span class="hidden sm:inline">Bulan Berikutnya</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>

            {{-- CALENDAR GRID --}}
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                {{-- Day Headers --}}
                <div class="grid grid-cols-7 bg-gradient-to-r from-green-600 to-green-700 text-white">
                    <div class="p-2 md:p-3 text-center text-xs md:text-sm font-semibold border-r border-green-500 last:border-0">Minggu</div>
                    <div class="p-2 md:p-3 text-center text-xs md:text-sm font-semibold border-r border-green-500 last:border-0">Senin</div>
                    <div class="p-2 md:p-3 text-center text-xs md:text-sm font-semibold border-r border-green-500 last:border-0">Selasa</div>
                    <div class="p-2 md:p-3 text-center text-xs md:text-sm font-semibold border-r border-green-500 last:border-0">Rabu</div>
                    <div class="p-2 md:p-3 text-center text-xs md:text-sm font-semibold border-r border-green-500 last:border-0">Kamis</div>
                    <div class="p-2 md:p-3 text-center text-xs md:text-sm font-semibold border-r border-green-500 last:border-0">Jumat</div>
                    <div class="p-2 md:p-3 text-center text-xs md:text-sm font-semibold">Sabtu</div>
                </div>

                {{-- Calendar Days --}}
                <div class="grid grid-cols-7">
                    @php
                        $startOfMonth = $currentDate->copy()->startOfMonth();
                        $endOfMonth = $currentDate->copy()->endOfMonth();
                        $startDay = $startOfMonth->dayOfWeek; // 0 = Sunday
                        $daysInMonth = $endOfMonth->day;
                        
                        // Add empty cells for days before month starts
                        for ($i = 0; $i < $startDay; $i++) {
                            echo '<div class="min-h-[80px] md:min-h-[120px] p-1 md:p-2 bg-gray-50 border-b border-r border-gray-200"></div>';
                        }
                        
                        // Loop through all days in month
                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            $date = $currentDate->copy()->setDay($day);
                            $dateKey = $date->format('Y-m-d');
                            $hasAgenda = isset($agendaByDate[$dateKey]);
                            $isToday = $date->isToday();
                            $isPast = $date->isPast() && !$isToday;
                            
                            echo '<div class="min-h-[80px] md:min-h-[120px] p-1 md:p-2 border-b border-r border-gray-200 last:border-r-0 ' . 
                                 ($isToday ? 'bg-yellow-50' : ($isPast ? 'bg-gray-50' : 'bg-white')) . '">';
                            
                            echo '<div class="flex flex-col h-full">';
                            echo '<div class="flex items-center justify-between mb-1">';
                            echo '<span class="text-xs md:text-sm font-semibold ' . 
                                 ($isToday ? 'text-green-700' : ($isPast ? 'text-gray-400' : 'text-gray-700')) . '">' . $day . '</span>';
                            
                            if ($isToday) {
                                echo '<span class="text-[8px] md:text-xs bg-green-600 text-white px-1 md:px-2 py-0.5 rounded-full">Hari Ini</span>';
                            }
                            
                            echo '</div>';
                            
                            if ($hasAgenda) {
                                $dayAgendas = $agendaByDate[$dateKey];
                                foreach ($dayAgendas->take(2) as $agenda) {
                                    echo '<a href="/agenda/' . $agenda->id . '" class="block mb-1">';
                                    echo '<div class="bg-gradient-to-r from-green-500 to-green-600 text-white text-[9px] md:text-xs p-1 md:p-1.5 rounded hover:from-green-600 hover:to-green-700 transition">';
                                    echo '<div class="font-semibold truncate">' . ($agenda->time ? $agenda->time : '') . '</div>';
                                    echo '<div class="truncate">' . e($agenda->title) . '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }
                                
                                if ($dayAgendas->count() > 2) {
                                    echo '<div class="text-[9px] md:text-xs text-green-600 font-semibold">+' . ($dayAgendas->count() - 2) . ' lainnya</div>';
                                }
                            }
                            
                            echo '</div>';
                            echo '</div>';
                        }
                        
                        // Add empty cells to complete the grid
                        $totalCells = $startDay + $daysInMonth;
                        $remainingCells = (7 - ($totalCells % 7)) % 7;
                        for ($i = 0; $i < $remainingCells; $i++) {
                            echo '<div class="min-h-[80px] md:min-h-[120px] p-1 md:p-2 bg-gray-50 border-b border-r border-gray-200 last:border-r-0"></div>';
                        }
                    @endphp
                </div>
            </div>
        </div>

        {{-- UPCOMING AGENDAS LIST --}}
        @if($upcomingAgendas->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-5 md:p-6">
                <h3 class="text-xl md:text-2xl font-bold text-green-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-calendar-check text-green-600"></i>
                    Agenda Mendatang
                </h3>
                
                <div class="space-y-3">
                    @foreach($upcomingAgendas as $agenda)
                        <a href="/agenda/{{ $agenda->id }}" class="block">
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 hover:shadow-md transition">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="bg-gradient-to-br from-green-600 to-green-700 text-white rounded-lg p-3 text-center min-w-[60px]">
                                            <div class="text-xs font-semibold">{{ $agenda->date->translatedFormat('M') }}</div>
                                            <div class="text-2xl font-bold">{{ $agenda->date->format('d') }}</div>
                                            <div class="text-xs">{{ $agenda->date->format('Y') }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-gray-800 mb-1 text-sm md:text-base">{{ $agenda->title }}</h4>
                                        
                                        <div class="flex flex-wrap gap-3 text-xs md:text-sm text-gray-600 mb-2">
                                            @if($agenda->time)
                                                <span class="flex items-center gap-1">
                                                    <i class="fas fa-clock text-green-600"></i>
                                                    {{ $agenda->time }}
                                                </span>
                                            @endif
                                            
                                            @if($agenda->location)
                                                <span class="flex items-center gap-1">
                                                    <i class="fas fa-map-marker-alt text-green-600"></i>
                                                    {{ $agenda->location }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if($agenda->description)
                                            <p class="text-xs md:text-sm text-gray-600 line-clamp-2">{{ $agenda->description }}</p>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-shrink-0 flex items-center">
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- LEGEND --}}
        <div class="mt-6 bg-white rounded-lg shadow-md p-4">
            <div class="flex flex-wrap gap-4 text-xs md:text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-yellow-50 border border-yellow-200 rounded"></div>
                    <span class="text-gray-600">Hari Ini</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-50 border border-gray-200 rounded"></div>
                    <span class="text-gray-600">Hari Lalu</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gradient-to-r from-green-500 to-green-600 rounded"></div>
                    <span class="text-gray-600">Ada Agenda</span>
                </div>
            </div>
        </div>
    </div>
@endsection
