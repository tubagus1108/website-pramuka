@props([
    'src',
    'alt' => '',
    'class' => '',
    'width' => null,
    'height' => null,
    'loading' => 'lazy',
    'fetchpriority' => null,
    'eager' => false
])

@php
    $loadingAttr = $eager ? 'eager' : $loading;
    $priorityAttr = $fetchpriority ?? ($eager ? 'high' : null);
@endphp

<img 
    src="{{ $src }}" 
    alt="{{ $alt }}"
    class="{{ $class }}"
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
    loading="{{ $loadingAttr }}"
    @if($priorityAttr) fetchpriority="{{ $priorityAttr }}" @endif
    decoding="async"
    {{ $attributes }}
>