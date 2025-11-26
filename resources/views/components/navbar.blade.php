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
                <button type="button" class="p-2 hover:bg-yellow-100 rounded-full transition text-blue-700 hidden md:block">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
