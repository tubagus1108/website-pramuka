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
                        <span class="text-blue-700 font-semibold">Berita</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- PAGE HEADER --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                        <i class="fas fa-newspaper text-4xl md:text-5xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-4xl font-bold mb-2">Berita Pramuka DIY</h1>
                        <p class="text-sm md:text-base text-blue-100">Update Terkini Kegiatan Kepramukaan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER & SEARCH --}}
        <div class="bg-white rounded-lg shadow-md p-4 md:p-6 mb-6">
            <form method="GET" action="/news" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- SEARCH --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-search mr-1"></i>
                        Cari Berita
                    </label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Ketik judul atau kata kunci..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                {{-- CATEGORY FILTER --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-folder mr-1"></i>
                        Kategori
                    </label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- SUBMIT --}}
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-semibold">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                </div>
            </form>

            {{-- ACTIVE FILTERS --}}
            @if(request()->hasAny(['search', 'category', 'tag']))
                <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-200">
                    <span class="text-sm text-gray-600 font-semibold">Filter Aktif:</span>
                    
                    @if(request('search'))
                        <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-search text-xs"></i>
                            {{ request('search') }}
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-1 hover:text-blue-600">
                                <i class="fas fa-times text-xs"></i>
                            </a>
                        </span>
                    @endif
                    
                    @if(request('category'))
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-folder text-xs"></i>
                            {{ request('category') }}
                            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ml-1 hover:text-green-600">
                                <i class="fas fa-times text-xs"></i>
                            </a>
                        </span>
                    @endif
                    
                    @if(request('tag'))
                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">
                            <i class="fas fa-tag text-xs"></i>
                            {{ request('tag') }}
                            <a href="{{ request()->fullUrlWithQuery(['tag' => null]) }}" class="ml-1 hover:text-orange-600">
                                <i class="fas fa-times text-xs"></i>
                            </a>
                        </span>
                    @endif

                    <a href="/news" class="inline-flex items-center gap-1 text-red-600 hover:text-red-700 px-3 py-1 text-sm font-semibold">
                        <i class="fas fa-times-circle"></i>
                        Hapus Semua Filter
                    </a>
                </div>
            @endif
        </div>

        {{-- RESULTS COUNT --}}
        <div class="mb-4 flex items-center justify-between">
            <p class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold text-gray-800">{{ $news->count() }}</span> dari 
                <span class="font-semibold text-gray-800">{{ $news->total() }}</span> berita
            </p>
            
            @if(request()->hasAny(['search', 'category', 'tag']))
                <p class="text-sm text-blue-600">
                    <i class="fas fa-filter mr-1"></i>
                    Filter diterapkan
                </p>
            @endif
        </div>

        {{-- NEWS GRID --}}
        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($news as $item)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                        <a href="/news/{{ $item->slug }}" class="block">
                            {{-- IMAGE --}}
                            <div class="relative overflow-hidden aspect-video bg-gray-200">
                                @if($item->image)
                                    <img src="{{ $item->image }}" 
                                         alt="{{ $item->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                         onerror="this.src='https://via.placeholder.com/600x400/1e40af/ffffff?text=Pramuka+DIY'">
                                @else
                                    <img src="https://via.placeholder.com/600x400/1e40af/ffffff?text=Pramuka+DIY" 
                                         alt="{{ $item->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @endif
                                
                                {{-- CATEGORY BADGE --}}
                                @if($item->category)
                                    <span class="absolute top-3 left-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                        {{ $item->category }}
                                    </span>
                                @endif
                            </div>

                            {{-- CONTENT --}}
                            <div class="p-4 md:p-5">
                                {{-- META --}}
                                <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-calendar text-blue-600"></i>
                                        {{ $item->published_at->translatedFormat('d M Y') }}
                                    </span>
                                    @if($item->author)
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-user text-blue-600"></i>
                                            {{ $item->author }}
                                        </span>
                                    @endif
                                </div>

                                {{-- TITLE --}}
                                <h3 class="font-bold text-gray-800 mb-2 text-base md:text-lg group-hover:text-blue-700 transition line-clamp-2">
                                    {{ $item->title }}
                                </h3>

                                {{-- EXCERPT --}}
                                @if($item->excerpt)
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ $item->excerpt }}</p>
                                @endif

                                {{-- TAGS --}}
                                @if($item->tags)
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @foreach(explode(',', $item->tags) as $tag)
                                            <a href="/news?tag={{ trim($tag) }}" 
                                               class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs hover:bg-blue-100 hover:text-blue-700 transition"
                                               onclick="event.stopPropagation();">
                                                #{{ trim($tag) }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- READ MORE --}}
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                    <span class="text-blue-600 font-semibold text-sm group-hover:text-blue-700 flex items-center gap-2">
                                        Baca Selengkapnya
                                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="bg-white rounded-lg shadow-md p-4">
                {{ $news->links() }}
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak Ada Berita Ditemukan</h3>
                <p class="text-gray-500 mb-4">
                    @if(request()->hasAny(['search', 'category', 'tag']))
                        Coba ubah filter atau kata kunci pencarian Anda.
                    @else
                        Belum ada berita yang dipublikasikan.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'category', 'tag']))
                    <a href="/news" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-redo"></i>
                        Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
@endsection
