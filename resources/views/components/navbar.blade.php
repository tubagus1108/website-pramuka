<nav class="bg-white shadow-md sticky top-0 z-50 border-b-2 border-yellow-400">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <ul class="flex items-center gap-0 text-xs md:text-sm font-semibold overflow-x-auto">
                @foreach($menus as $menu)
                    @if(isset($menu['dropdown']) && $menu['dropdown'])
                        <li class="relative group">
                            <a href="{{ $menu['url'] }}" class="flex items-center gap-1 px-3 md:px-4 py-3 md:py-4 hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-700 hover:text-white transition whitespace-nowrap {{ request()->is(trim($menu['url'], '/')) ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white' : 'text-gray-700' }}">
                                {{ $menu['label'] }}
                                <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>
                            @if($menu['label'] === 'PROFIL' && isset($profileMenus) && count($profileMenus) > 0)
                                <div class="absolute left-0 mt-0 w-56 bg-white shadow-xl border-t-2 border-yellow-400 hidden group-hover:block rounded-b-lg overflow-hidden z-50">
                                    @foreach($profileMenus as $submenu)
                                        <a href="/profile/{{ $submenu->slug }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-yellow-50 hover:text-blue-700 border-b border-gray-100 last:border-0 transition">
                                            {{ $submenu->title }}
                                        </a>
                                    @endforeach
                                </div>
                            @elseif($menu['label'] === 'ORGANISASI' && isset($organizationMenus) && count($organizationMenus) > 0)
                                <div class="absolute left-0 mt-0 w-56 bg-white shadow-xl border-t-2 border-orange-400 hidden group-hover:block rounded-b-lg overflow-hidden z-50">
                                    @foreach($organizationMenus as $submenu)
                                        <a href="/organization/{{ $submenu->slug }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-orange-50 hover:to-yellow-50 hover:text-orange-700 border-b border-gray-100 last:border-0 transition">
                                            {{ $submenu->title }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @else
                        <li>
                            <a href="{{ $menu['url'] }}" class="block px-3 md:px-4 py-3 md:py-4 hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-700 hover:text-white transition whitespace-nowrap {{ request()->is(trim($menu['url'], '/')) || (trim($menu['url'], '/') === '' && request()->is('/')) ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white' : 'text-gray-700' }}">
                                {{ $menu['label'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="flex items-center gap-2">
                <button type="button" onclick="openSearchModal()" class="p-2 hover:bg-yellow-100 rounded-full transition text-blue-700 hidden md:block">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- SEARCH MODAL --}}
<div id="searchModal" class="fixed inset-0 bg-black bg-opacity-50 z-[100] hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[80vh] overflow-hidden" onclick="event.stopPropagation()">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-4 flex items-center justify-between">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Pencarian
            </h3>
            <button onclick="closeSearchModal()" class="text-white hover:bg-white/20 rounded-full p-2 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-4">
            <form action="/news" method="GET" class="mb-4">
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        id="searchInput"
                        placeholder="Cari berita, artikel, pengumuman..." 
                        class="w-full px-4 py-3 pl-12 border-2 border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        autofocus
                    >
                    <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="flex gap-2 mt-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-semibold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari
                    </button>
                    <a href="/news" class="px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition font-semibold">
                        Lihat Semua
                    </a>
                </div>
            </form>
            
            <div class="border-t pt-4">
                <p class="text-sm text-gray-500 mb-2 font-semibold">Pencarian Populer:</p>
                <div class="flex flex-wrap gap-2">
                    <a href="/news?search=pramuka" class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm hover:bg-blue-100 transition">
                        #pramuka
                    </a>
                    <a href="/news?search=kegiatan" class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-sm hover:bg-green-100 transition">
                        #kegiatan
                    </a>
                    <a href="/news?search=lomba" class="px-3 py-1 bg-orange-50 text-orange-700 rounded-full text-sm hover:bg-orange-100 transition">
                        #lomba
                    </a>
                    <a href="/news?search=pelatihan" class="px-3 py-1 bg-purple-50 text-purple-700 rounded-full text-sm hover:bg-purple-100 transition">
                        #pelatihan
                    </a>
                    <a href="/news?category=BERITA" class="px-3 py-1 bg-red-50 text-red-700 rounded-full text-sm hover:bg-red-100 transition">
                        #berita
                    </a>
                </div>
            </div>
            
            <div class="border-t mt-4 pt-4">
                <p class="text-xs text-gray-400 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tekan ESC untuk menutup
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function openSearchModal() {
    const modal = document.getElementById('searchModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('searchInput').focus();
    document.body.style.overflow = 'hidden';
}

function closeSearchModal() {
    const modal = document.getElementById('searchModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Close on click outside
document.getElementById('searchModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeSearchModal();
    }
});

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSearchModal();
    }
});
</script>
