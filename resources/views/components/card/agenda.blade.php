@props(['agenda'])

<a href="/agenda/{{ $agenda->slug }}" class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
    <div class="flex">
        <div class="bg-gradient-to-br from-green-600 to-green-700 text-white p-4 flex flex-col items-center justify-center min-w-[80px]">
            <span class="text-3xl font-bold">{{ $agenda->event_date->format('d') }}</span>
            <span class="text-xs uppercase">{{ $agenda->event_date->format('M') }}</span>
        </div>
        <div class="flex-1 p-4">
            <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-green-600 transition line-clamp-1">
                {{ $agenda->title }}
            </h3>
            @if($agenda->location)
                <p class="text-sm text-gray-600 mb-2 flex items-center gap-1">
                    <i class="fas fa-map-marker-alt text-green-600"></i>
                    {{ $agenda->location }}
                </p>
            @endif
            <div class="flex items-center gap-3 text-xs text-gray-500">
                <span class="flex items-center gap-1">
                    <i class="fas fa-clock"></i>
                    {{ $agenda->event_date->format('H:i') }}
                </span>
                @if($agenda->organizer)
                    <span class="flex items-center gap-1">
                        <i class="fas fa-users"></i>
                        {{ $agenda->organizer }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</a>
