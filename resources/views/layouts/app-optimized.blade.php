<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1e40af">
    
    {{-- Critical inline CSS for above-the-fold content --}}
    <style>
        /* Critical CSS - Loads immediately */
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(to bottom right, #f9fafb, #dbeafe, #fef3c7);
            min-height: 100vh;
        }
        
        /* Hero slider critical styles */
        #heroSlider {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            height: 300px;
        }
        
        #heroSlider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Prevent layout shift */
        .container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        @media (min-width: 640px) {
            .container {
                max-width: 640px;
            }
        }
        
        @media (min-width: 768px) {
            .container {
                max-width: 768px;
            }
        }
        
        @media (min-width: 1024px) {
            .container {
                max-width: 1024px;
            }
        }
        
        @media (min-width: 1280px) {
            .container {
                max-width: 1280px;
            }
        }
    </style>
    
    {{-- Preconnect to external domains --}}
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://images.unsplash.com">
    
    {{-- Preload hero image if available --}}
    @if(isset($heroImage) && $heroImage)
        <link rel="preload" as="image" href="{{ $heroImage }}" fetchpriority="high">
    @endif
    
    <title>@yield('title', 'Pramuka UIN Sultanah Nahrasiyah - Racana Gerakan Pramuka')</title>
    
    {{-- Vite Assets - deferred for non-critical CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome with async loading --}}
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-yellow-50 min-h-screen">
    @yield('content')
</body>
</html>