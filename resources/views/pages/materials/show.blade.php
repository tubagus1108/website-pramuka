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
                        <a href="/materials" class="text-gray-700 hover:text-blue-600">Materi</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-purple-700 font-semibold">{{ $material->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- MAIN CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- MAIN ARTICLE --}}
            <div class="lg:col-span-2">
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    {{-- HEADER --}}
                    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-6 md:p-8">
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-users mr-1"></i>
                                {{ $material->category }}
                            </span>
                            @if($material->level)
                                <span class="bg-yellow-500 px-3 py-1 rounded-full text-sm font-semibold">
                                    <i class="fas fa-layer-group mr-1"></i>
                                    {{ $material->level }}
                                </span>
                            @endif
                            <span class="bg-white/20 backdrop-blur px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                {{ $material->views }} views
                            </span>
                        </div>
                        
                        <h1 class="text-2xl md:text-3xl font-bold mb-3">{{ $material->title }}</h1>
                        
                        @if($material->description)
                            <p class="text-purple-100 text-sm md:text-base">{{ $material->description }}</p>
                        @endif
                        
                        <div class="flex flex-wrap gap-3 text-sm mt-4">
                            @if($material->author)
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-user"></i>
                                    {{ $material->author }}
                                </span>
                            @endif
                            <span class="flex items-center gap-2">
                                <i class="fas fa-calendar"></i>
                                {{ $material->published_at->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6 md:p-8">
                        {{-- FILE ATTACHMENT --}}
                        @if($material->file_attachment)
                            <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 rounded-lg p-4 mb-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-green-500 text-white rounded-lg p-3">
                                            <i class="fas fa-file-pdf text-2xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">File Materi Tersedia</p>
                                            <p class="text-sm text-gray-600">Download file untuk pembelajaran offline</p>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($material->file_attachment) }}" 
                                       download
                                       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-semibold text-sm flex items-center gap-2">
                                        <i class="fas fa-download"></i>
                                        <span class="hidden sm:inline">Download</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- MAIN CONTENT --}}
                        <div class="prose prose-sm md:prose-lg max-w-none">
                            {!! $material->content !!}
                        </div>

                        {{-- TAGS --}}
                        @if($material->tags)
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h4 class="font-bold mb-3 text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-tags text-purple-600"></i>
                                    Tag Materi:
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $material->tags) as $tag)
                                        <a href="/materials?tag={{ trim($tag) }}" 
                                           class="inline-block bg-purple-100 text-purple-700 px-3 py-1.5 rounded-lg hover:bg-purple-200 transition text-sm font-semibold">
                                            #{{ trim($tag) }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- SHARE BUTTONS --}}
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-bold mb-3 flex items-center gap-2 text-gray-800">
                                <i class="fas fa-share-alt text-purple-600"></i>
                                Bagikan Materi Ini:
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                   target="_blank" 
                                   aria-label="Bagikan ke Facebook"
                                   class="flex items-center gap-2 bg-blue-600 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    <span class="hidden sm:inline">Facebook</span>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($material->title) }}" 
                                   target="_blank" 
                                   aria-label="Bagikan ke Twitter"
                                   class="flex items-center gap-2 bg-sky-500 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-sky-600 transition text-sm">
                                    <i class="fab fa-twitter" aria-hidden="true"></i>
                                    <span class="hidden sm:inline">Twitter</span>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($material->title . ' ' . request()->url()) }}" 
                                   target="_blank" 
                                   class="flex items-center gap-2 bg-green-600 text-white px-3 md:px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                    <i class="fab fa-whatsapp"></i>
                                    <span class="hidden sm:inline">WhatsApp</span>
                                </a>
                            </div>
                        </div>

                        {{-- BACK TO MATERIALS --}}
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="/materials" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-800 font-semibold text-sm transition">
                                <i class="fas fa-arrow-left"></i>
                                Kembali ke Daftar Materi
                            </a>
                        </div>
                    </div>
                </article>

                {{-- RELATED MATERIALS --}}
                @if($relatedMaterials->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-5 md:p-6 mt-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-book text-purple-600"></i>
                            Materi Terkait ({{ $material->category }})
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($relatedMaterials as $related)
                                <a href="/materials/{{ $related->slug }}" class="block border border-gray-200 rounded-lg p-4 hover:border-purple-500 hover:shadow-md transition">
                                    <div class="flex items-start gap-3">
                                        <div class="bg-purple-100 text-purple-600 rounded-lg p-2">
                                            <i class="fas fa-book-open text-xl"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-2 text-sm">{{ $related->title }}</h4>
                                            @if($related->level)
                                                <span class="text-xs text-gray-500">{{ $related->level }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <div class="lg:col-span-1">
                {{-- POPULAR MATERIALS --}}
                @if($popularMaterials->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-5 mb-6 sticky top-20">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-fire text-orange-500"></i>
                            Materi Populer
                        </h3>
                        
                        <div class="space-y-3">
                            @foreach($popularMaterials as $popular)
                                <a href="/materials/{{ $popular->slug }}" class="block group">
                                    <div class="border border-gray-200 rounded-lg p-3 hover:border-purple-500 hover:shadow-md transition">
                                        <div class="flex items-start gap-2">
                                            <span class="bg-purple-100 text-purple-600 rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 text-sm font-bold">
                                                {{ $loop->iteration }}
                                            </span>
                                            <div class="flex-grow">
                                                <h4 class="font-semibold text-gray-800 group-hover:text-purple-700 line-clamp-2 text-sm mb-1">
                                                    {{ $popular->title }}
                                                </h4>
                                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                                    <span class="flex items-center gap-1">
                                                        <i class="fas fa-eye"></i>
                                                        {{ $popular->views }}
                                                    </span>
                                                    <span>•</span>
                                                    <span>{{ $popular->category }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
