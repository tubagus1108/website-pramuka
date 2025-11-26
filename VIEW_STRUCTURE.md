# View Structure Documentation

## 📁 Struktur Folder Views

```
resources/views/
├── layouts/
│   ├── app.blade.php              # Base layout untuk authenticated users
│   ├── main.blade.php             # Public layout (extends app.blade.php)
│   └── partials/                  # Shared layout components
│       ├── header.blade.php       # Top banner dengan logo
│       ├── footer.blade.php       # Footer dengan info kontak & sosial media
│       └── meta.blade.php         # SEO meta tags (title, description, OG)
│
├── components/                    # Reusable Blade components
│   ├── navbar.blade.php           # Main navigation
│   ├── breadcrumb.blade.php       # Breadcrumb navigation
│   ├── page-header.blade.php      # Page header dengan gradient
│   └── card/                      # Card components untuk berbagai content
│       ├── news.blade.php         # News card component
│       ├── agenda.blade.php       # Agenda card component
│       └── buletin.blade.php      # Buletin card component
│
├── pages/                         # Main application pages
│   ├── home.blade.php            # Homepage
│   │
│   ├── profile/
│   │   ├── index.blade.php       # List profile menu
│   │   └── show.blade.php        # Detail profil
│   │
│   ├── organization/
│   │   ├── index.blade.php       # List organization menu
│   │   └── show.blade.php        # Detail organisasi
│   │
│   ├── news/
│   │   ├── index.blade.php       # List berita dengan filter
│   │   └── show.blade.php        # Detail berita
│   │
│   ├── agenda/
│   │   ├── index.blade.php       # Kalender & list agenda
│   │   └── show.blade.php        # Detail agenda
│   │
│   ├── materials/
│   │   ├── index.blade.php       # List materi dengan filter
│   │   └── show.blade.php        # Detail materi
│   │
│   ├── buletin/
│   │   └── index.blade.php       # List buletin dengan download
│   │
│   ├── pesan-buper/
│   │   └── index.blade.php       # Pesan dari ketua umum
│   │
│   └── kirim-berita/
│       └── index.blade.php       # Form submit berita
│
└── welcome.blade.php              # Laravel default welcome page
```

## 🔧 Penggunaan Components

### Breadcrumb Component
```blade
<x-breadcrumb :items="[
    ['label' => 'Berita', 'url' => '/news'],
    ['label' => $news->title, 'color' => 'blue']
]" />
```

### Page Header Component
```blade
<x-page-header 
    title="Berita Terkini"
    subtitle="Informasi dan Kegiatan Pramuka"
    icon="fas fa-newspaper"
    color="blue"
/>
```

### News Card Component
```blade
<x-card.news :item="$newsItem" />
```

### Agenda Card Component
```blade
<x-card.agenda :agenda="$agendaItem" />
```

### Buletin Card Component
```blade
<x-card.buletin :buletin="$buletinItem" />
```

## 📝 Naming Convention

- **index.blade.php** - List/index page (e.g., list of news, agendas)
- **show.blade.php** - Detail page (e.g., news detail, agenda detail)
- **Component files** - Singular, lowercase with kebab-case
- **Folders** - Lowercase with kebab-case

## 🎯 Benefits

1. **Separation of Concerns** - Setiap section terorganisir dalam folder sendiri
2. **Reusability** - Components dapat digunakan ulang di berbagai halaman
3. **Maintainability** - Mudah menemukan dan update file
4. **Scalability** - Mudah menambah fitur baru
5. **Consistency** - Penamaan yang konsisten sesuai Laravel convention
6. **SEO-Friendly** - Meta tags terpisah untuk setiap halaman

## 🚀 Controller Mapping

| Controller | Method | View Path |
|-----------|--------|-----------|
| HomeController | index() | pages.home |
| ProfileController | index() | pages.profile.index |
| ProfileController | show() | pages.profile.show |
| OrganizationController | index() | pages.organization.index |
| OrganizationController | show() | pages.organization.show |
| NewsController | index() | pages.news.index |
| NewsController | show() | pages.news.show |
| AgendaController | index() | pages.agenda.index |
| AgendaController | show() | pages.agenda.show |
| MaterialController | index() | pages.materials.index |
| MaterialController | show() | pages.materials.show |
| BuletinController | index() | pages.buletin.index |
| PesanBuperController | index() | pages.pesan-buper.index |
| KirimBeritaController | index() | pages.kirim-berita.index |
