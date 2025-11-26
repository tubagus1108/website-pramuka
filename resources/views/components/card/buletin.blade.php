@php use Illuminate\Support\Facades\Storage; @endphp
@props(['buletin'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
    @if($buletin->cover_image)
        <img src="{{ Storage::url($buletin->cover_image) }}" alt="{{ $buletin->title }}" class="w-full h-48 object-cover">
    @else
        <div class="w-full h-48 bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center">
            <i class="fas fa-newspaper text-white text-6xl"></i>
        </div>
    @endif
    <div class="p-6">
        <div class="flex items-center gap-2 text-sm text-indigo-600 mb-2">
            <i class="fas fa-calendar"></i>
            <span>{{ $buletin->edition }} - {{ ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$buletin->month] }} {{ $buletin->year }}</span>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $buletin->title }}</h3>
        @if($buletin->description)
            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $buletin->description }}</p>
        @endif
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">
                <i class="fas fa-eye mr-1"></i>{{ $buletin->views }} views
            </span>
            @if($buletin->file_pdf)
                <a href="{{ Storage::url($buletin->file_pdf) }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm inline-flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    Download
                </a>
            @endif
        </div>
    </div>
</div>
