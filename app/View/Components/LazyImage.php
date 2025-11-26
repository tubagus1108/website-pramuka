<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LazyImage extends Component
{
    public string $src;
    public string $alt;
    public ?string $class;
    public ?int $width;
    public ?int $height;
    public string $loading;
    public ?string $sizes;

    public function __construct(
        string $src,
        string $alt = '',
        ?string $class = '',
        ?int $width = null,
        ?int $height = null,
        string $loading = 'lazy',
        ?string $sizes = null
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
        $this->width = $width;
        $this->height = $height;
        $this->loading = $loading;
        $this->sizes = $sizes;
    }

    public function render()
    {
        return view('components.lazy-image');
    }
}
