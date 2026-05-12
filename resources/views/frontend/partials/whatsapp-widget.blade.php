@php
    $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
    $waDefaultMessage = 'Halo Home Putra Interior, saya tertarik dengan layanan desain interior Anda.';
@endphp

@if($waNumber)
<div
    id="whatsapp-widget"
    class="theme-keep-dark fixed bottom-5 right-3 sm:bottom-6 sm:right-6 z-[1000] font-sans"
    data-wa-number="{{ $waNumber }}"
    data-wa-default-message="{{ e($waDefaultMessage) }}">
    <div
        id="whatsapp-panel"
        class="pointer-events-none mb-3 w-[min(calc(100vw-1.5rem),320px)] origin-bottom-right overflow-hidden rounded-xl bg-[#efeae2] opacity-0 shadow-2xl ring-1 ring-black/10 transition duration-300 ease-out translate-y-5 scale-95 sm:mb-4 sm:w-[320px]"
        role="dialog"
        aria-hidden="true"
        aria-label="Chat WhatsApp Home Putra Interior">
        <div class="flex h-[58px] items-center justify-between bg-[#075e54] px-4 text-white">
            <div class="flex min-w-0 items-center gap-3">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/15 ring-1 ring-white/25">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold leading-tight text-white">Home Putra Interior</p>
                    <p class="text-[11px] leading-tight text-white/75">Online</p>
                </div>
            </div>
            <button type="button" id="whatsapp-collapse" class="rounded-full p-2 text-white/95 transition hover:bg-white/10" aria-label="Tutup panel WhatsApp">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="relative h-[300px] bg-[#efeae2] px-4 py-5 sm:h-[318px] sm:px-5">
            <div class="pointer-events-none absolute inset-0 opacity-[0.12]" style="background-image: radial-gradient(circle at 1px 1px, #6b7a70 1px, transparent 0), radial-gradient(circle at 9px 10px, #6b7a70 0.7px, transparent 0); background-size: 22px 22px;"></div>
            <div class="relative ml-1 max-w-[245px] rounded-lg rounded-tl-sm bg-white px-4 py-3 text-[#1f2933] shadow-[0_1px_1px_rgba(0,0,0,0.12)] before:absolute before:left-[-7px] before:top-0 before:h-0 before:w-0 before:border-y-[7px] before:border-r-[8px] before:border-y-transparent before:border-r-white">
                <p class="text-[15px] leading-snug sm:text-base">Halo, ada yang bisa kami bantu? :)</p>
                <span id="whatsapp-time" class="mt-1 block text-xs text-[#91a0a8]">--:--</span>
            </div>

            <form id="whatsapp-form" class="absolute inset-x-4 bottom-4 flex items-center gap-2 sm:inset-x-5 sm:bottom-5 sm:gap-3">
                <label for="whatsapp-message" class="sr-only">Pesan WhatsApp</label>
                <div class="flex min-w-0 flex-1 items-center rounded-full bg-white px-4 py-3 shadow-[0_1px_2px_rgba(0,0,0,0.12)]">
                    <input
                        id="whatsapp-message"
                        type="text"
                        autocomplete="off"
                        placeholder="Write your message..."
                        class="min-w-0 flex-1 appearance-none border-0 bg-transparent p-0 text-[15px] text-[#1f2933] !outline-none !ring-0 placeholder:text-[#c8d4dd] focus:!border-0 focus:!outline-none focus:!ring-0 focus-visible:!outline-none focus-visible:!ring-0"
                        style="outline: none; box-shadow: none;">
                </div>
                <button type="submit" class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#d9edf7] text-white transition duration-200 hover:bg-[#25d366] sm:h-[52px] sm:w-[52px]" aria-label="Kirim pesan WhatsApp">
                    <svg class="h-6 w-6 translate-x-0.5 sm:h-7 sm:w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M2.5 20.5 22 12 2.5 3.5v6.7L16 12 2.5 13.8v6.7Z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <div class="flex items-center justify-end">
        <button
            type="button"
            id="whatsapp-toggle"
            class="relative flex h-[58px] w-[58px] items-center justify-center overflow-visible rounded-full bg-[#25D366] text-white shadow-xl shadow-green-500/30 transition duration-300 ease-out hover:scale-105 sm:h-[64px] sm:w-[64px]"
            aria-label="Buka chat WhatsApp"
            aria-expanded="false"
            aria-controls="whatsapp-panel">
            <span class="pointer-events-none absolute inset-0 rounded-full bg-[#25D366] opacity-60 whatsapp-pulse-ring"></span>
            <span class="pointer-events-none absolute inset-0 rounded-full bg-[#25D366] opacity-40 whatsapp-pulse-ring whatsapp-pulse-ring--delay"></span>
            <svg id="whatsapp-open-icon" class="relative h-9 w-9 rotate-0 transition duration-300 ease-out sm:h-10 sm:w-10" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
            </svg>
            <svg id="whatsapp-close-icon" class="absolute h-9 w-9 -rotate-90 opacity-0 transition duration-300 ease-out" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M6 18 18 6M6 6l12 12" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</div>

<style>
    #whatsapp-toggle .whatsapp-pulse-ring {
        animation: whatsappHeartbeat 2.2s ease-out infinite;
    }

    #whatsapp-toggle .whatsapp-pulse-ring--delay {
        animation-delay: .65s;
    }

    #whatsapp-toggle[aria-expanded="true"] .whatsapp-pulse-ring {
        animation-play-state: paused;
        opacity: 0;
    }

    @keyframes whatsappHeartbeat {
        0% {
            opacity: .42;
            transform: scale(.92);
        }
        14% {
            opacity: .58;
            transform: scale(1.1);
        }
        28% {
            opacity: .38;
            transform: scale(.98);
        }
        62% {
            opacity: 0;
            transform: scale(1.62);
        }
        100% {
            opacity: 0;
            transform: scale(1.62);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        #whatsapp-toggle .whatsapp-pulse-ring {
            animation: none;
        }
    }
</style>

<script>
    (() => {
        const widget = document.getElementById('whatsapp-widget');
        if (!widget) return;

        const panel = document.getElementById('whatsapp-panel');
        const toggle = document.getElementById('whatsapp-toggle');
        const collapse = document.getElementById('whatsapp-collapse');
        const openIcon = document.getElementById('whatsapp-open-icon');
        const closeIcon = document.getElementById('whatsapp-close-icon');
        const form = document.getElementById('whatsapp-form');
        const input = document.getElementById('whatsapp-message');
        const time = document.getElementById('whatsapp-time');

        const setOpen = (isOpen) => {
            panel.classList.toggle('pointer-events-none', !isOpen);
            panel.classList.toggle('opacity-0', !isOpen);
            panel.classList.toggle('translate-y-5', !isOpen);
            panel.classList.toggle('scale-95', !isOpen);
            panel.classList.toggle('pointer-events-auto', isOpen);
            panel.classList.toggle('opacity-100', isOpen);
            panel.classList.toggle('translate-y-0', isOpen);
            panel.classList.toggle('scale-100', isOpen);
            panel.setAttribute('aria-hidden', String(!isOpen));
            openIcon.classList.toggle('opacity-0', isOpen);
            openIcon.classList.toggle('rotate-90', isOpen);
            closeIcon.classList.toggle('opacity-0', !isOpen);
            closeIcon.classList.toggle('-rotate-90', !isOpen);
            closeIcon.classList.toggle('rotate-0', isOpen);
            toggle.classList.toggle('bg-[#25D366]', !isOpen);
            toggle.classList.toggle('bg-[#ff5b5f]', isOpen);
            toggle.setAttribute('aria-expanded', String(isOpen));
            toggle.setAttribute('aria-label', isOpen ? 'Tutup chat WhatsApp' : 'Buka chat WhatsApp');

            if (isOpen) {
                time.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                window.setTimeout(() => input.focus(), 80);
            }
        };

        toggle.addEventListener('click', () => {
            const isOpen = toggle.getAttribute('aria-expanded') === 'true';
            setOpen(!isOpen);
        });
        collapse.addEventListener('click', () => setOpen(false));
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') setOpen(false);
        });

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const customMessage = input.value.trim();
            const message = customMessage
                ? `Halo Home Putra Interior, saya mau konsultasi:\n\n${customMessage}`
                : widget.dataset.waDefaultMessage;

            window.open(`https://wa.me/${widget.dataset.waNumber}?text=${encodeURIComponent(message)}`, '_blank', 'noopener,noreferrer');
            input.value = '';
            setOpen(false);
        });
    })();
</script>
@endif
