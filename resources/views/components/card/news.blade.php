@php use Illuminate\Support\Facades\Storage; @endphp
@props(['item'])

<a href="/news/{{ $item->slug }}" class="bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1">
    <div class="relative overflow-hidden h-48 bg-gray-100">
        @if($item->image)
            <img src="{{ Storage::url($item->image) }}" 
                 alt="{{ $item->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                 width="400"
                 height="300"
                 loading="lazy"
                 decoding="async"
                 onerror="this.src='https://via.placeholder.com/400x300/1e40af/ffffff?text=Pramuka+UIN+SN'">
        @else
            <img src="https://via.placeholder.com/400x300/1e40af/ffffff?text=Pramuka+UIN+SN" 
                 alt="{{ $item->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                 width="400"
                 height="300"
                 loading="lazy"
                 decoding="async">
        @endif
        <div class="absolute top-3 left-3">
            <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-3 py-1 rounded-md text-xs font-bold shadow-lg">
                {{ $item->category ?? 'BERITA' }}
            </span>
        </div>
    </div>
    <div class="p-5">
        <h3 class="font-bold text-lg md:text-xl text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition">
            {{ $item->title }}
        </h3>
        @if($item->excerpt)
            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $item->excerpt }}</p>
        @endif
        <div class="flex items-center justify-between text-sm text-gray-500">
            <span class="flex items-center gap-1">
                <i class="fas fa-calendar-alt"></i>
                {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
            </span>
            <span class="flex items-center gap-1">
                <i class="fas fa-eye"></i>
                {{ $item->views ?? 0 }}
            </span>
        </div>
    </div>
</a>
