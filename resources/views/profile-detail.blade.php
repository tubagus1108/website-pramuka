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

        <section class="py-8">
            <div class="bg-white rounded shadow p-6">
                <h1 class="text-2xl font-bold mb-4">{{ $menu->title }}</h1>
                <div class="prose max-w-none">
                    {!! $menu->content !!}
                </div>
            </div>
        </section>
    </div>
@endsection
