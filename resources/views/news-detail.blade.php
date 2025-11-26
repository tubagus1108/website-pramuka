@extends('layouts.main')

@section('title', $news->title . ' - Pramuka DIY')

@section('main-content')
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            {{-- MAIN CONTENT --}}
            <div class="lg:col-span-3">
                <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                    {{-- Featured Image --}}
                    <div class="relative h-96 overflow-hidden">
                        <img src="{{ $news->image ?? 'https://via.placeholder.com/1200x600?text=Pramuka+DIY' }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold">{{ $news->category ?? 'BERITA' }}</span>
                        </div>
                    </div>

                    {{-- Article Content --}}
                    <div class="p-8">
                        {{-- Meta Info --}}
                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-4 pb-4 border-b">
                            <span class="flex items-center gap-2">
                                <i class="far fa-calendar-alt text-blue-600"></i>
                                {{ $news->published_at->format('d F Y') }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="far fa-user text-blue-600"></i>
                                {{ $news->author ?? 'Admin' }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="far fa-eye text-blue-600"></i>
                                {{ rand(100, 1000) }} views
                            </span>
                        </div>

                        {{-- Title --}}
                        <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-800">{{ $news->title }}</h1>

                        {{-- Excerpt --}}
                        @if($news->excerpt)
                            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-6">
                                <p class="text-lg text-gray-700 italic">{{ $news->excerpt }}</p>
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($news->content)) !!}
                        </div>

                        {{-- Tags --}}
                        @if($news->tags)
                            <div class="mt-8 pt-6 border-t">
                                <h3 class="font-bold mb-3 flex items-center gap-2">
                                    <i class="fas fa-tags text-blue-600"></i>
                                    Tags:
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(array_map('trim', explode(',', $news->tags)) as $tag)
                                        <a href="/news?tag={{ $tag }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-600 hover:text-white transition">
                                            #{{ $tag }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Share Buttons --}}
                        <div class="mt-8 pt-6 border-t">
                            <h3 class="font-bold mb-3 flex items-center gap-2">
                                <i class="fas fa-share-alt text-blue-600"></i>
                                Bagikan:
                            </h3>
                            <div class="flex gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fab fa-facebook-f"></i>
                                    Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" target="_blank" class="flex items-center gap-2 bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition">
                                    <i class="fab fa-twitter"></i>
                                    Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" target="_blank" class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    <i class="fab fa-whatsapp"></i>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Related News --}}
                @if(isset($relatedNews) && count($relatedNews) > 0)
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold mb-4">Berita Terkait</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($relatedNews as $related)
                                <a href="/news/{{ $related->slug }}" class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">
                                    <div class="relative overflow-hidden h-40">
                                        <img src="{{ $related->image ?? 'https://via.placeholder.com/400x300?text=Pramuka+DIY' }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-sm mb-2 line-clamp-2 group-hover:text-blue-600">{{ $related->title }}</h3>
                                        <span class="text-xs text-gray-500">{{ $related->published_at->format('d M Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-6">
                {{-- Latest News --}}
                <div class="bg-white rounded-lg shadow p-5">
                    <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="far fa-newspaper text-blue-600"></i>
                        Berita Terbaru
                    </h4>
                    <ul class="space-y-4">
                        @foreach($latestNews ?? [] as $latest)
                            <li class="border-b pb-3 last:border-0">
                                <a href="/news/{{ $latest->slug }}" class="group">
                                    <div class="flex gap-3">
                                        <img src="{{ $latest->image ?? 'https://via.placeholder.com/100x100?text=News' }}" alt="{{ $latest->title }}" class="w-20 h-20 object-cover rounded">
                                        <div class="flex-1">
                                            <h5 class="font-semibold text-sm line-clamp-2 group-hover:text-blue-600 mb-1">{{ $latest->title }}</h5>
                                            <span class="text-xs text-gray-500">{{ $latest->published_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- AGENDA --}}
                <div class="bg-white rounded-lg shadow p-5">
                    <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="far fa-calendar-alt text-blue-600"></i>
                        Agenda Kegiatan
                    </h4>
                    <ul class="space-y-3">
                        @foreach($agendas ?? [] as $agenda)
                            <li class="border-l-4 border-blue-600 pl-3 py-2 hover:bg-blue-50 transition">
                                <div class="flex items-start gap-2">
                                    <div class="bg-blue-600 text-white rounded px-2 py-1 text-center min-w-[50px]">
                                        <div class="text-xs">{{ $agenda->date->format('M') }}</div>
                                        <div class="text-lg font-bold">{{ $agenda->date->format('d') }}</div>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-semibold text-sm">{{ $agenda->title }}</h5>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Categories --}}
                <div class="bg-white rounded-lg shadow p-5">
                    <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-list text-blue-600"></i>
                        Kategori
                    </h4>
                    <ul class="space-y-2">
                        @foreach(['BERITA', 'ARTIKEL', 'PENGUMUMAN', 'KEGIATAN'] as $cat)
                            <li>
                                <a href="/news?category={{ $cat }}" class="flex items-center justify-between py-2 px-3 hover:bg-blue-50 rounded transition">
                                    <span>{{ $cat }}</span>
                                    <i class="fas fa-chevron-right text-blue-600 text-xs"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
