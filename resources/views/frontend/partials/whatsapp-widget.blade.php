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
        class="pointer-events-none mb-3 w-[min(calc(100vw-1.5rem),340px)] origin-bottom-right overflow-hidden rounded-[22px] bg-[#efeae2] opacity-0 shadow-[0_24px_70px_rgba(0,0,0,0.42)] ring-1 ring-white/10 transition duration-300 ease-out translate-y-5 scale-95 sm:mb-4 sm:w-[340px]"
        role="dialog"
        aria-hidden="true"
        aria-label="Chat WhatsApp Home Putra Interior">
        <div class="flex h-[66px] items-center justify-between bg-[linear-gradient(135deg,#075e54_0%,#0a7b69_58%,#18b578_100%)] px-4 text-white shadow-[0_8px_24px_rgba(7,94,84,0.24)]">
            <div class="flex min-w-0 items-center gap-3">
                <span class="relative flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white/15 shadow-inner ring-1 ring-white/25">
                    <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-[#0a7b69] bg-[#34d399]"></span>
                    <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="truncate text-[15px] font-bold leading-tight text-white">Home Putra Interior</p>
                    <p class="mt-0.5 text-[11px] font-medium leading-tight text-emerald-50/85">Online - siap bantu konsultasi</p>
                </div>
            </div>
            <button type="button" id="whatsapp-collapse" class="rounded-full p-2 text-white/95 transition hover:bg-white/15" aria-label="Tutup panel WhatsApp">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="relative h-[318px] overflow-hidden bg-[#efeae2] px-4 py-5 sm:h-[338px] sm:px-5">
            <div class="pointer-events-none absolute inset-0 opacity-[0.13]" style="background-image: radial-gradient(circle at 1px 1px, #67766d 1px, transparent 0), radial-gradient(circle at 12px 10px, #67766d 0.7px, transparent 0); background-size: 24px 24px;"></div>
            <div class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/30 to-transparent"></div>
            <div class="relative ml-1 max-w-[260px] rounded-2xl rounded-tl-md bg-white px-4 py-3 text-[#1f2933] shadow-[0_10px_28px_rgba(35,45,38,0.12)] before:absolute before:left-[-8px] before:top-0 before:h-0 before:w-0 before:border-y-[8px] before:border-r-[10px] before:border-y-transparent before:border-r-white">
                <p class="text-[15px] leading-snug sm:text-base">Halo, ada yang bisa kami bantu? :)</p>
                <div class="mt-2 flex items-center justify-between gap-3">
                    <span id="whatsapp-time" class="block text-xs text-[#8b9aa4]">--:--</span>
                    <span class="text-[10px] font-semibold uppercase tracking-wide text-[#25d366]">Admin</span>
                </div>
            </div>

            <div class="absolute inset-x-4 bottom-[88px] flex flex-wrap gap-2 sm:inset-x-5 sm:bottom-[94px]">
                <button type="button" data-wa-preset="Saya ingin konsultasi desain interior." class="rounded-full border border-[#128c7e]/15 bg-white/80 px-3 py-1.5 text-[11px] font-semibold text-[#075e54] shadow-sm backdrop-blur transition hover:bg-white">
                    Konsultasi
                </button>
                <button type="button" data-wa-preset="Saya ingin tanya estimasi biaya." class="rounded-full border border-[#128c7e]/15 bg-white/80 px-3 py-1.5 text-[11px] font-semibold text-[#075e54] shadow-sm backdrop-blur transition hover:bg-white">
                    Estimasi biaya
                </button>
            </div>

            <form id="whatsapp-form" class="absolute inset-x-3 bottom-3 flex items-center gap-2 rounded-[30px] bg-white/35 p-2 shadow-[0_18px_40px_rgba(31,41,51,0.16)] backdrop-blur-md sm:inset-x-4 sm:bottom-4">
                <label for="whatsapp-message" class="sr-only">Pesan WhatsApp</label>
                <div class="flex min-w-0 flex-1 items-center rounded-full border border-white/70 bg-white px-4 py-3 shadow-inner shadow-black/[0.04]">
                    <input
                        id="whatsapp-message"
                        type="text"
                        autocomplete="off"
                        placeholder="Tulis pesan..."
                        class="min-w-0 flex-1 appearance-none border-0 bg-transparent p-0 text-[15px] font-medium text-[#1f2933] !outline-none !ring-0 placeholder:text-[#9aa8b2] focus:!border-0 focus:!outline-none focus:!ring-0 focus-visible:!outline-none focus-visible:!ring-0"
                        style="outline: none; box-shadow: none;">
                </div>
                <button type="submit" class="group flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[linear-gradient(135deg,#25d366_0%,#128c7e_100%)] text-white shadow-[0_12px_26px_rgba(18,140,126,0.34)] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_16px_34px_rgba(18,140,126,0.42)] sm:h-[52px] sm:w-[52px]" aria-label="Kirim pesan WhatsApp">
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
            class="relative flex h-[58px] w-[58px] items-center justify-center overflow-visible rounded-full bg-[#25D366] text-white shadow-[0_18px_45px_rgba(37,211,102,0.34)] transition duration-300 ease-out hover:scale-105 sm:h-[64px] sm:w-[64px]"
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
        const presetButtons = widget.querySelectorAll('[data-wa-preset]');

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
        presetButtons.forEach((button) => {
            button.addEventListener('click', () => {
                input.value = button.dataset.waPreset || '';
                input.focus();
            });
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
