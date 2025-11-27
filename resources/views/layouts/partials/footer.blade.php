{{-- FOOTER --}}
<footer class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-white mt-8 md:mt-12 py-6 md:py-8 border-t-4 border-yellow-400">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 bg-blue-900/80 rounded-xl shadow-xl p-6 md:p-8">
            <div class="flex items-start gap-3 md:gap-4">
                <img src="/img/Logo-Pramuka-small.jpeg"
                     alt="Logo Pramuka UIN Sultanah Nahrasiyah"
                     class="h-16 md:h-20 w-auto drop-shadow-lg rounded"
                     width="80"
                     height="80"
                     loading="lazy"
                     decoding="async">
                <div>
                    <h3 class="font-bold text-base md:text-lg mb-2 text-yellow-400">PRAMUKA UIN</h3>
                    <p class="text-xs leading-relaxed">
                        Racana<br>
                        Gerakan Pramuka<br>
                        UIN Sultanah Nahrasiyah
                    </p>
                </div>
            </div>
            <div>
                <h4 class="font-bold mb-3 text-yellow-400 text-sm md:text-base">Sekretariat</h4>
                <p class="text-xs md:text-sm leading-relaxed">
                    Kampus UIN Sultanah Nahrasiyah<br>
                    Jl. Syech Abdurrauf, Medan Mawang<br>
                    Samudera, Lhokseumawe, Aceh 24355<br>
                    <span class="text-yellow-200">Telp: (0645) 44373</span><br>
                    <span class="text-yellow-200">Email: pramuka@uinsu.ac.id</span>
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-3 text-yellow-400 text-sm md:text-base">Ikuti Kami</h4>
                <div class="flex gap-2 md:gap-3 mb-4">
                    <a href="#" aria-label="Ikuti kami di Facebook" class="w-9 h-9 md:w-10 md:h-10 bg-blue-900 text-white rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                        <i class="fab fa-facebook-f text-sm md:text-base" aria-hidden="true"></i>
                    </a>
                    <a href="#" aria-label="Ikuti kami di Twitter" class="w-9 h-9 md:w-10 md:h-10 bg-blue-900 text-white rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                        <i class="fab fa-twitter text-sm md:text-base" aria-hidden="true"></i>
                    </a>
                    <a href="#" aria-label="Ikuti kami di Instagram" class="w-9 h-9 md:w-10 md:h-10 bg-blue-900 text-white rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                        <i class="fab fa-instagram text-sm md:text-base" aria-hidden="true"></i>
                    </a>
                    <a href="#" aria-label="Tonton kami di YouTube" class="w-9 h-9 md:w-10 md:h-10 bg-blue-900 text-white rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-blue-900 transition transform hover:scale-110 shadow-md">
                        <i class="fab fa-youtube text-sm md:text-base" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-blue-700 mt-4 md:mt-6 pt-4 md:pt-6 text-center text-xs md:text-sm">
            &copy; {{ date('Y') }} Racana Gerakan Pramuka UIN Sultanah Nahrasiyah. All rights reserved.
        </div>
    </div>
</footer>

@once
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(reg) {
                    console.log('ServiceWorker registration successful with scope: ', reg.scope);
                }).catch(function(err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
@endonce
