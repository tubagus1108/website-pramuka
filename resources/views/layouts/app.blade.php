<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Pramuka</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header, Navbar, dsb bisa ditambahkan di sini -->
    @yield('content')
    <!-- Footer -->
    <footer class="mt-12 py-6 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} Website Pramuka
    </footer>
</body>
</html>
