@props(['title', 'subtitle', 'icon', 'color' => 'blue'])

<div class="bg-gradient-to-r from-{{ $color }}-600 to-{{ $color }}-800 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
    <div class="flex items-center gap-4">
        @if($icon ?? false)
            <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                <i class="{{ $icon }} text-4xl md:text-5xl"></i>
            </div>
        @endif
        <div>
            <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $title }}</h1>
            @if($subtitle ?? false)
                <p class="text-sm md:text-base text-{{ $color }}-100">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
</div>
