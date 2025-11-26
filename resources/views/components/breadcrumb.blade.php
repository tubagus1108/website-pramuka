@props(['items'])

<nav class="flex mb-4 md:mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
        <li class="inline-flex items-center">
            <a href="/" class="text-gray-700 hover:text-blue-600 inline-flex items-center">
                <i class="fas fa-home mr-2"></i>
                Home
            </a>
        </li>
        @foreach($items as $item)
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                    @if(isset($item['url']))
                        <a href="{{ $item['url'] }}" class="text-gray-700 hover:text-blue-600">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-{{ $item['color'] ?? 'blue' }}-700 font-semibold">{{ $item['label'] }}</span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
