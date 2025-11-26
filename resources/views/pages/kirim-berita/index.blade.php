@extends('layouts.main')

@section('main-content')
    <div class="container mx-auto px-4 py-6 md:py-8">
        {{-- BREADCRUMB --}}
        <nav class="flex mb-4 md:mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="/" class="text-gray-700 hover:text-blue-600 inline-flex items-center">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-teal-700 font-semibold">Kirim Berita</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- PAGE HEADER --}}
        <div class="bg-gradient-to-r from-teal-600 to-teal-800 rounded-xl shadow-lg p-6 md:p-8 mb-6 md:mb-8 text-white">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur rounded-lg p-4 hidden md:block">
                    <i class="fas fa-paper-plane text-4xl md:text-5xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold mb-2">Kirim Berita</h1>
                    <p class="text-sm md:text-base text-teal-100">Berbagi Informasi dan Kegiatan Pramuka Anda</p>
                </div>
            </div>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-2xl mr-3"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- FORM --}}
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
            <form action="/kirim-berita" method="POST" enctype="multipart/form-data" id="newsForm">
                @csrf
                
                {{-- Anti-spam: Honeypot field (hidden from users, bots will fill it) --}}
                <input type="text" name="website" value="" style="display:none !important" tabindex="-1" autocomplete="off">
                
                {{-- Anti-spam: Timestamp to track form fill time --}}
                <input type="hidden" name="form_start_time" id="formStartTime" value="">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- NAMA --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- PHONE --}}
                <div class="mb-6">
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                        No. Telepon / WhatsApp
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           placeholder="08xxxxxxxxxx"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- JUDUL BERITA --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           placeholder="Contoh: Kegiatan Perkemahan di Basecamp..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ISI BERITA --}}
                <div class="mb-6">
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Isi Berita <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="8" required
                              placeholder="Tuliskan detail berita atau kegiatan yang ingin Anda bagikan..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- GAMBAR --}}
                <div class="mb-6">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar (Opsional)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-teal-500 transition">
                        <input type="file" id="image" name="image" accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        <label for="image" class="cursor-pointer">
                            <div id="preview-container" class="hidden mb-4">
                                <img id="preview" class="mx-auto max-h-64 rounded-lg">
                            </div>
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600 mb-1">Klik untuk upload gambar</p>
                            <p class="text-sm text-gray-400">Maksimal 2MB (JPG, PNG, GIF)</p>
                        </label>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SUBMIT --}}
                <div class="flex gap-4">
                    <button type="submit" id="submitBtn" class="flex-1 md:flex-initial bg-gradient-to-r from-teal-600 to-teal-700 text-white px-8 py-3 rounded-lg hover:from-teal-700 hover:to-teal-800 transition font-semibold flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-paper-plane" id="submitIcon"></i>
                        <span id="submitText">Kirim Berita</span>
                    </button>
                    <button type="reset" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition font-semibold" onclick="resetFormTime()">
                        Reset
                    </button>
                </div>

                <p class="text-sm text-gray-500 mt-4">
                    <i class="fas fa-info-circle mr-1"></i>
                    Berita yang Anda kirimkan akan ditinjau terlebih dahulu oleh admin sebelum dipublikasikan.
                </p>
            </form>
        </div>
    </div>

    <script>
        // Set form start timestamp when page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('formStartTime').value = Math.floor(Date.now() / 1000);
        });

        // Reset timestamp when form is reset
        function resetFormTime() {
            setTimeout(function() {
                document.getElementById('formStartTime').value = Math.floor(Date.now() / 1000);
                document.getElementById('preview-container').classList.add('hidden');
            }, 100);
        }

        // Image preview
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Form submission handler
        document.getElementById('newsForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitIcon = document.getElementById('submitIcon');
            const submitText = document.getElementById('submitText');
            
            // Disable submit button
            submitBtn.disabled = true;
            submitIcon.className = 'fas fa-spinner fa-spin';
            submitText.textContent = 'Mengirim...';
            
            // Re-enable after 5 seconds (in case of error)
            setTimeout(function() {
                submitBtn.disabled = false;
                submitIcon.className = 'fas fa-paper-plane';
                submitText.textContent = 'Kirim Berita';
            }, 5000);
        });
    </script>
@endsection
