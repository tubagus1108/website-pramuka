@props(['src', 'alt' => '', 'class' => '', 'width' => null, 'height' => null, 'loading' => 'lazy', 'sizes' => null])

@php
    // Generate responsive image URLs if using Storage
    $isStorageUrl = str_starts_with($src, 'storage/') || str_starts_with($src, '/storage/');
    $srcset = '';
    
    if ($isStorageUrl) {
        // For storage images, we could generate different sizes
        // For now, just use the original
        $srcset = '';
    }
@endphp

<img 
    src="{{ $src }}" 
    alt="{{ $alt }}"
    @if($srcset) srcset="{{ $srcset }}" @endif
    @if($sizes) sizes="{{ $sizes }}" @endif
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
    loading="{{ $loading }}"
    decoding="async"
    class="{{ $class }}"
    {{ $attributes }}
>
