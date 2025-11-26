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
                        <span class="text-blue-700 font-semibold">Profil</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- PAGE HEADER --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-900 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                    <i class="fas fa-user-circle text-4xl md:text-5xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold mb-2">Profil Pramuka UIN Sultanah Nahrasiyah</h1>
                    <p class="text-sm md:text-base text-blue-100">Racana Gerakan Pramuka Perguruan Tinggi</p>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- MENU LIST --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-20">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 md:px-5 py-3 md:py-4">
                        <h3 class="font-bold text-base md:text-lg flex items-center gap-2">
                            <i class="fas fa-list"></i>
                            Menu Profil
                        </h3>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @forelse($menus as $menu)
                            <li>
                                <a href="/profile/{{ $menu->slug }}" class="block px-4 md:px-5 py-3 md:py-4 hover:bg-blue-50 transition group">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 group-hover:text-blue-700 text-sm md:text-base">
                                            {{ $menu->title }}
                                        </span>
                                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-700 text-xs"></i>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="px-4 md:px-5 py-8 text-center text-gray-500 text-sm">
                                <i class="fas fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                <p>Belum ada menu profil</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- INTRODUCTION CONTENT --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-5 md:p-8">
                    <div class="mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-blue-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-600"></i>
                            Selamat Datang
                        </h2>
                        <div class="prose prose-sm md:prose-base max-w-none">
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Kwartir Daerah Gerakan Pramuka Daerah Istimewa Yogyakarta merupakan organisasi kepramukaan tingkat daerah yang bertugas membina dan mengembangkan Gerakan Pramuka di wilayah Daerah Istimewa Yogyakarta.
                            </p>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Silakan pilih menu di samping untuk melihat informasi lebih detail mengenai profil Pramuka DIY.
                            </p>
                        </div>
                    </div>

                    {{-- QUICK STATS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 md:p-5 border-l-4 border-blue-600">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-600 text-white rounded-lg p-3">
                                    <i class="fas fa-users text-xl md:text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Total Anggota</p>
                                    <p class="text-xl md:text-2xl font-bold text-blue-800">{{ number_format(15000) }}+</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-yellow-50 to-orange-100 rounded-lg p-4 md:p-5 border-l-4 border-orange-500">
                            <div class="flex items-center gap-3">
                                <div class="bg-orange-500 text-white rounded-lg p-3">
                                    <i class="fas fa-campground text-xl md:text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Gugus Depan</p>
                                    <p class="text-xl md:text-2xl font-bold text-orange-800">{{ number_format(500) }}+</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 md:p-5 border-l-4 border-green-600">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-600 text-white rounded-lg p-3">
                                    <i class="fas fa-award text-xl md:text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Pembina</p>
                                    <p class="text-xl md:text-2xl font-bold text-green-800">{{ number_format(2500) }}+</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 md:p-5 border-l-4 border-purple-600">
                            <div class="flex items-center gap-3">
                                <div class="bg-purple-600 text-white rounded-lg p-3">
                                    <i class="fas fa-calendar-check text-xl md:text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Kegiatan/Tahun</p>
                                    <p class="text-xl md:text-2xl font-bold text-purple-800">{{ number_format(150) }}+</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FEATURED IMAGE --}}
                    <div class="mt-8">
                        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800&h=400&fit=crop" 
                             alt="Pramuka DIY" 
                             class="w-full h-48 md:h-64 object-cover rounded-lg shadow-md"
                             onerror="this.src='https://via.placeholder.com/800x400/1e40af/ffffff?text=Pramuka+DIY'">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
