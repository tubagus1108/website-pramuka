<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $description ?? 'Racana Gerakan Pramuka UIN Sultanah Nahrasiyah - Lhokseumawe, Aceh' }}">
<meta name="keywords" content="{{ $keywords ?? 'pramuka, uinsu, lhokseumawe, aceh, gerakan pramuka, racana' }}">
<meta name="author" content="Pramuka UIN Sultanah Nahrasiyah">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $title ?? 'Pramuka UIN Sultanah Nahrasiyah' }}">
<meta property="og:description" content="{{ $description ?? 'Racana Gerakan Pramuka UIN Sultanah Nahrasiyah' }}">
<meta property="og:image" content="{{ $image ?? asset('img/Logo-Pramuka.jpeg') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $title ?? 'Pramuka UIN Sultanah Nahrasiyah' }}">
<meta property="twitter:description" content="{{ $description ?? 'Racana Gerakan Pramuka UIN Sultanah Nahrasiyah' }}">
<meta property="twitter:image" content="{{ $image ?? asset('img/Logo-Pramuka.jpeg') }}">
