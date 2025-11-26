@extends('layouts.app')

@section('content')
    @include('layouts.partials.header')

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
    <div class="min-h-screen">
        @yield('main-content')
    </div>

    @include('layouts.partials.footer')
@endsection
