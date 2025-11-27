@extends('layouts.app')

@section('content')
    @include('layouts.partials.header')
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:bg-white focus:text-blue-700 focus:px-3 focus:py-2 focus:rounded">Skip to content</a>

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
        ];
        $profileMenus = \App\Models\ProfileMenu::where('is_active', true)->get();
        $organizationMenus = \App\Models\OrganizationMenu::where('is_active', true)->get();
    @endphp
    @include('components.navbar', ['menus' => $menus, 'profileMenus' => $profileMenus, 'organizationMenus' => $organizationMenus])

    {{-- MAIN CONTENT --}}
    <main id="main-content" class="min-h-screen">
        @yield('main-content')
    </main>

    @include('layouts.partials.footer')
@endsection
