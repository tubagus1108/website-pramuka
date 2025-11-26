<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Gerakan Pramuka UIN Sultanah Nahrasiyah - Racana Garuda Aceh. Membentuk generasi muda yang berkarakter, berakhlak mulia, dan berprestasi.')">
    <meta name="theme-color" content="#1e40af">
    
    <title>@yield('title', 'Pramuka UIN Sultanah Nahrasiyah - Racana Gerakan Pramuka')</title>
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Preload critical assets -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome with font-display swap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'; this.onload=null;">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>
    
    <!-- Inline critical CSS for above-the-fold content -->
    <style>
        /* Critical CSS for initial render */
        body { margin: 0; font-family: system-ui, -apple-system, sans-serif; }
        .min-h-screen { min-height: 100vh; }
        .bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)); }
        .from-gray-50 { --tw-gradient-from: #f9fafb; --tw-gradient-to: rgb(249 250 251 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
        .via-blue-50 { --tw-gradient-to: rgb(239 246 255 / 0); --tw-gradient-stops: var(--tw-gradient-from), #eff6ff, var(--tw-gradient-to); }
        .to-yellow-50 { --tw-gradient-to: #fefce8; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-yellow-50 min-h-screen">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-blue-600 focus:text-white">
        Skip to main content
    </a>
    
    <main id="main-content">
        @yield('content')
    </main>
</body>
</html>
