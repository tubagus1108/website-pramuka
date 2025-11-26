@extends('layouts.app')

@section('content')
    {{-- HEADER TOP BANNER --}}
    <div class="bg-gradient-to-r from-blue-800 via-blue-700 to-blue-900 border-b-4 border-yellow-400 shadow-lg">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between py-2 md:py-3 px-4">
            <div class="flex items-center gap-2 md:gap-3 mb-2 md:mb-0">
                <img src="/img/Logo-Pramuka.jpeg" alt="Logo Pramuka" class="h-12 md:h-16 w-auto drop-shadow-lg rounded">
                <div>
                    <h1 class="font-bold text-lg md:text-xl text-white drop-shadow">PRAMUKA UIN</h1>
                    <p class="text-xs text-yellow-200">Sultanah Nahrasiyah</p>
                </div>
            </div>
            <div class="flex items-center gap-2 md:gap-4">
                <img src="/img/Logo-Pramuka.jpeg" alt="Logo UIN" class="h-12 md:h-16 w-auto drop-shadow-lg hidden sm:block rounded">
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    @php
        $menus = [
            ['url' => '/', 'label' => 'HOME'],
            ['url' => '/profile', 'label' => 'PROFIL', 'dropdown' => true],
            ['url' => '/organization', 'label' => 'ORGANISASI', 'dropdown' => true],
            ['url' => '/agenda', 'label' => 'AGENDA'],
            ['url' => '/news', 'label' => 'BERITA'],
            ['url' => '/materials', 'label' => 'MATERI'],
            ['url' => '/buletin', 'label' => 'BULETIN'],
            ['url' => '/pesan-buper', 'label' => 'PESAN BUPER'],
            ['url' => '/kirim-berita', 'label' => 'KIRIM BERITA'],
            // ['url' => '#', 'label' => 'DOKUMEN'],
            // ['url' => '#', 'label' => 'GALERI'],
        ];
        $profileMenus = \App\Models\ProfileMenu::where('is_active', true)->get();
        $organizationMenus = \App\Models\OrganizationMenu::where('is_active', true)->get();
    @endphp
    @include('components.navbar', ['menus' => $menus, 'profileMenus' => $profileMenus, 'organizationMenus' => $organizationMenus])

    {{-- MAIN CONTENT --}}
    <div class="min-h-screen">
        @yield('main-content')
    </div>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-white mt-8 md:mt-12 py-6 md:py-8 border-t-4 border-yellow-400">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <div class="flex items-start gap-3 md:gap-4">
                    <img src="/img/Logo-Pramuka.jpeg" alt="Logo" class="h-16 md:h-20 w-auto drop-shadow-lg rounded">
                    <div>
                        <h3 class="font-bold text-base md:text-lg mb-2 text-yellow-400">PRAMUKA UIN</h3>
                        <p class="text-xs leading-relaxed">
                            Racana<br>
                            Gerakan Pramuka<br>
                            UIN Sultanah Nahrasiyah
                        </p>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-3 text-yellow-400 text-sm md:text-base">Sekretariat</h4>
                    <p class="text-xs md:text-sm leading-relaxed">
                        Kampus UIN Sultanah Nahrasiyah<br>
                        Jl. Syech Abdurrauf, Medan Mawang<br>
                        Samudera, Lhokseumawe, Aceh 24355<br>
                        <span class="text-yellow-200">Telp: (0645) 44373</span><br>
                        <span class="text-yellow-200">Email: pramuka@uinsu.ac.id</span>
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-3 text-yellow-400 text-sm md:text-base">Ikuti Kami</h4>
                    <div class="flex gap-2 md:gap-3 mb-4">
                        <a href="#" class="w-9 h-9 md:w-10 md:h-10 bg-white text-blue-900 rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                            <i class="fab fa-facebook-f text-sm md:text-base"></i>
                        </a>
                        <a href="#" class="w-9 h-9 md:w-10 md:h-10 bg-white text-blue-900 rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                            <i class="fab fa-twitter text-sm md:text-base"></i>
                        </a>
                        <a href="#" class="w-9 h-9 md:w-10 md:h-10 bg-white text-blue-900 rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                            <i class="fab fa-instagram text-sm md:text-base"></i>
                        </a>
                        <a href="#" class="w-9 h-9 md:w-10 md:h-10 bg-white text-blue-900 rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                            <i class="fab fa-youtube text-sm md:text-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-blue-700 mt-4 md:mt-6 pt-4 md:pt-6 text-center text-xs md:text-sm">
                &copy; {{ date('Y') }} Racana Gerakan Pramuka UIN Sultanah Nahrasiyah. All rights reserved.
            </div>
        </div>
    </footer>
@endsection
