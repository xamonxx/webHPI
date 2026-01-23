{{-- Footer - Premium Responsive Design --}}

<footer class="bg-background-dark pt-12 sm:pt-16 pb-6 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Main Footer Content --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 mb-10 sm:mb-12">

            {{-- Brand --}}
            <div class="sm:col-span-2 lg:col-span-1" data-aos="fade-up">
                <a href="{{ route('home') }}" class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 flex items-center justify-center rounded-2xl bg-primary/20">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-10 h-auto object-contain" width="40" height="40">
                    </div>
                    <span class="text-xl font-bold text-white">
                        Home Putra <span class="text-primary italic">Interior</span>
                    </span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed mb-6 max-w-xs">
                    Menciptakan ruang yang mencerminkan kepribadian dan aspirasi unik klien kami dengan sentuhan premium.
                </p>
                {{-- Social Links --}}
                <div class="flex items-center gap-3">
                    @if(!empty($settings['instagram_url']))
                    <a href="{{ $settings['instagram_url'] }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white/5 hover:bg-primary/20 text-gray-400 hover:text-primary transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    @endif
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281809939681' }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white/5 hover:bg-green-500/20 text-gray-400 hover:text-green-400 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                    </a>
                    @if(!empty($settings['facebook_url']))
                    <a href="{{ $settings['facebook_url'] }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white/5 hover:bg-blue-500/20 text-gray-400 hover:text-blue-400 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div data-aos="fade-up" data-aos-delay="100">
                <h5 class="text-white text-sm font-bold uppercase tracking-widest mb-4">Jelajahi</h5>
                <nav class="flex flex-col gap-3">
                    <a href="{{ route('home') }}#portfolio" class="text-gray-500 hover:text-primary text-sm transition-colors">Portfolio</a>
                    <a href="{{ route('home') }}#services" class="text-gray-500 hover:text-primary text-sm transition-colors">Layanan</a>
                    <a href="{{ route('home') }}#calculator" class="text-gray-500 hover:text-primary text-sm transition-colors">Kalkulator</a>
                    <a href="{{ route('home') }}#testimonials" class="text-gray-500 hover:text-primary text-sm transition-colors">Testimoni</a>
                </nav>
            </div>

            {{-- Company --}}
            <div data-aos="fade-up" data-aos-delay="200">
                <h5 class="text-white text-sm font-bold uppercase tracking-widest mb-4">Perusahaan</h5>
                <nav class="flex flex-col gap-3">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary text-sm transition-colors">Tentang Kami</a>
                    <a href="{{ route('home') }}#contact" class="text-gray-500 hover:text-primary text-sm transition-colors">Hubungi Kami</a>
                    <a href="#" class="text-gray-500 hover:text-primary text-sm transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-500 hover:text-primary text-sm transition-colors">Syarat & Ketentuan</a>
                </nav>
            </div>

            {{-- Contact Info --}}
            <div data-aos="fade-up" data-aos-delay="300">
                <h5 class="text-white text-sm font-bold uppercase tracking-widest mb-4">Kontak</h5>
                <div class="flex flex-col gap-3">
                    <div class="flex items-start gap-3 text-gray-500 text-sm">
                        <span class="material-symbols-outlined text-primary text-lg shrink-0 mt-0.5">location_on</span>
                        <span>{{ $settings['contact_address'] ?? 'Jl. Desain No. 123, Jakarta' }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-500 text-sm">
                        <span class="material-symbols-outlined text-primary text-lg shrink-0">mail</span>
                        <span>{{ $settings['contact_email'] ?? 'hello@homeputra.com' }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-500 text-sm">
                        <span class="material-symbols-outlined text-primary text-lg shrink-0">phone</span>
                        <span>{{ $settings['contact_phone'] ?? '+62 812 3456 7890' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="pt-6 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
            <p class="text-xs text-gray-600">
                © {{ date('Y') }} Home Putra Interior. Hak Cipta Dilindungi.
            </p>
            <p class="text-xs text-gray-600">
                Designed with <span class="text-primary">♥</span> for Interior Excellence
            </p>
        </div>
    </div>
</footer>



{{-- Back to Top Button --}}
<button id="back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-4 sm:bottom-6 left-4 sm:left-6 z-50 w-10 h-10 sm:w-12 sm:h-12 bg-white/5 hover:bg-primary border border-white/10 hover:border-primary rounded-full flex items-center justify-center text-gray-400 hover:text-black transition-all duration-300 opacity-0 invisible" aria-label="Back to top">
    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
    </svg>
</button>

<script>
    // Back to top visibility
    document.addEventListener('scroll', function() {
        const backToTop = document.getElementById('back-to-top');
        if (window.scrollY > 500) {
            backToTop.classList.remove('opacity-0', 'invisible');
            backToTop.classList.add('opacity-100', 'visible');
        } else {
            backToTop.classList.add('opacity-0', 'invisible');
            backToTop.classList.remove('opacity-100', 'visible');
        }
    }, {
        passive: true
    });
</script>