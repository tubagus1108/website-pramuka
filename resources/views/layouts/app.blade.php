<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.partials.meta')

    <title>@yield('title', 'Pramuka UIN Sultanah Nahrasiyah - Racana Gerakan Pramuka')</title>

    <!-- Preconnect to external origins -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preload Font Awesome CSS for faster loading -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Load Font Awesome async with font-display swap -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          media="print"
          onload="this.media='all'; this.onload=null;">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </noscript>

    <!-- Inline critical CSS for above-the-fold -->
    <style>
        /* Critical CSS for initial render */
        body { margin: 0; font-family: system-ui, -apple-system, sans-serif; }
        .min-h-screen { min-height: 100vh; }
        .bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)); }
        .from-gray-50 { --tw-gradient-from: #f9fafb; --tw-gradient-to: rgb(249 250 251 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
        .via-blue-50 { --tw-gradient-to: rgb(239 246 255 / 0); --tw-gradient-stops: var(--tw-gradient-from), #eff6ff, var(--tw-gradient-to); }
        .to-yellow-50 { --tw-gradient-to: #fefce8; }
    </style>

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2579432280026048"
            crossorigin="anonymous"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-yellow-50 min-h-screen">
    @yield('content')
</body>
</html>
