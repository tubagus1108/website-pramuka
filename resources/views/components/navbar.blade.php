<div class="bg-white shadow mb-4">
    <div class="flex flex-col md:flex-row items-center justify-between py-2">
        <div class="flex items-center gap-4">
            <img src="/logo.png" alt="Logo" class="h-16">
            <span class="font-bold text-xl text-blue-700">PRAMUKADIY</span>
        </div>
        <div class="flex gap-2 mt-2 md:mt-0">
            <a href="#" class="text-xs text-gray-600">#PramukaIstimewa</a>
            <a href="#" class="text-xs text-gray-600">Selamat Bertugas</a>
        </div>
    </div>
    <nav class="flex gap-6 border-t pt-2 text-sm font-semibold">
        <a href="/" class="text-blue-700">HOME</a>
        <!-- Menu Profile dengan dropdown submenu dinamis -->
        <div class="relative">
            <button type="button" class="hover:text-blue-700 flex items-center gap-1 focus:outline-none" onclick="document.getElementById('profile-dropdown').classList.toggle('hidden')">
                PROFIL
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
            @if(isset($profileMenus) && count($profileMenus))
                <div id="profile-dropdown" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden z-10">
                    @foreach($profileMenus as $submenu)
                        <a href="/profile/{{ $submenu->id }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">{{ $submenu->title }}</a>
                    @endforeach
                </div>
            @endif
        </div>
        @foreach (array_filter($menus, fn($m) => $m['label'] !== 'PROFIL') as $menu)
            <a href="{{ $menu['url'] }}" class="hover:text-blue-700">{{ $menu['label'] }}</a>
        @endforeach
        <a href="#" class="hover:text-blue-700">MATERI</a>
        <a href="#" class="hover:text-blue-700">DOKUMEN</a>
        <a href="#" class="hover:text-blue-700">TAUTAN</a>
    </nav>
</div>
