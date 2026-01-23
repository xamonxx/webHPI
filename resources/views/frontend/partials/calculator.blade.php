{{--
    QUICK CALCULATOR - Mini Calculator on Homepage
    Features: Real-time price estimation, Product/Material selection, API integration
--}}

<section class="py-24 bg-background-dark relative" id="calculator">
    {{-- Background elements --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,var(--tw-gradient-stops))] from-primary/5 via-background-dark to-background-dark overflow-hidden"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16 px-2">
            <div data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/5 border border-white/10 rounded-full mb-4 backdrop-blur-sm">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Estimasi Biaya</span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl text-white font-serif leading-tight">
                    Hitung <span class="text-transparent bg-clip-text bg-linear-to-r from-primary to-yellow-500 italic">Anggaran</span>
                </h2>
                <p class="text-gray-400 mt-4 max-w-lg font-light">Dapatkan perkiraan biaya awal untuk proyek interior Anda dalam waktu kurang dari 1 menit.</p>
            </div>

            <a href="{{ route('calculator') }}" class="group hidden md:flex items-center gap-3 text-white hover:text-primary transition-colors pb-2" data-aos="fade-left">
                <span class="text-sm font-bold uppercase tracking-widest">Kalkulator Pro</span>
                <div class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center group-hover:border-primary/50 group-hover:bg-primary/10 transition-all">
                    <span class="material-symbols-outlined text-lg group-hover:-rotate-45 transition-transform">arrow_forward</span>
                </div>
            </a>
        </div>

        {{-- Main Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12 items-start relative">

            {{-- Left Column: Form --}}
            <div class="lg:col-span-3 space-y-8 order-2 lg:order-1" data-aos="fade-up">



                {{-- Product Selection --}}
                <div class="space-y-4">
                    <label class="text-sm font-bold text-gray-300 uppercase tracking-wider block">Pilih Kategori Produk</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4" id="quickProductGrid">
                        {{-- Products loaded dynamically --}}
                        <div class="animate-pulse">
                            <div class="h-24 bg-white/5 rounded-xl"></div>
                        </div>
                        <div class="animate-pulse">
                            <div class="h-24 bg-white/5 rounded-xl"></div>
                        </div>
                        <div class="animate-pulse">
                            <div class="h-24 bg-white/5 rounded-xl"></div>
                        </div>
                        <div class="animate-pulse">
                            <div class="h-24 bg-white/5 rounded-xl"></div>
                        </div>
                    </div>
                </div>

                {{-- Dimensions --}}
                <div class="space-y-4">
                    <label for="quickLengthInput" class="text-sm font-bold text-gray-300 uppercase tracking-wider block">Ukuran (Meter Lari)</label>
                    <div class="flex items-center gap-4">
                        <button type="button" aria-label="Kurangi panjang" onclick="quickAdjustLength(-0.5)" class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 text-white text-xl font-bold hover:bg-primary hover:text-black hover:border-primary transition-all shrink-0">−</button>
                        <div class="flex-1 relative">
                            <input type="number" id="quickLengthInput" min="0.5" max="20" step="0.5" value="3" class="w-full bg-[#151515] border border-white/10 rounded-xl px-4 py-4 text-white text-center text-2xl font-bold focus:outline-none focus:border-primary transition-colors">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">meter</span>
                        </div>
                        <button type="button" aria-label="Tambah panjang" onclick="quickAdjustLength(0.5)" class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 text-white text-xl font-bold hover:bg-primary hover:text-black hover:border-primary transition-all shrink-0">+</button>
                    </div>
                    <input type="range" id="quickLengthSlider" aria-label="Geser untuk mengatur panjang" min="0.5" max="20" step="0.5" value="3" class="w-full h-2 bg-gray-700 rounded-full appearance-none cursor-pointer accent-primary">
                </div>

                {{-- Material Selection --}}
                <div class="space-y-4">
                    <label class="text-sm font-bold text-gray-300 uppercase tracking-wider block">Bahan Material</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="quickMaterialGrid">
                        {{-- Materials loaded dynamically --}}
                        <div class="animate-pulse">
                            <div class="h-16 bg-white/5 rounded-xl"></div>
                        </div>
                        <div class="animate-pulse">
                            <div class="h-16 bg-white/5 rounded-xl"></div>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="bg-primary/5 border border-primary/10 rounded-xl p-6">
                    <h4 class="text-primary font-bold mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">info</span> Catatan
                    </h4>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Harga ini adalah estimasi kasar berdasarkan ukuran standar. Biaya akhir dapat bervariasi tergantung pada kerumitan desain, aksesoris tambahan, dan lokasi pemasangan.
                    </p>
                </div>

            </div>

            {{-- Right Column: Widget --}}
            <div class="lg:col-span-2 order-1 lg:order-2">
                <div class="lg:sticky lg:top-28 transition-all duration-300">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-linear-to-br from-primary/30 to-purple-600/30 rounded-2xl blur-lg opacity-50"></div>
                        <div class="relative bg-[#111] rounded-2xl border border-white/10 p-6 shadow-2xl overflow-hidden">
                            <div class="flex items-center justify-between mb-6 pb-6 border-b border-white/5">
                                <h3 class="text-white font-serif italic text-xl">Preview Estimasi</h3>
                                <span class="px-2 py-1 bg-green-500/20 text-green-400 text-[10px] font-bold uppercase rounded tracking-widest">Live Update</span>
                            </div>

                            {{-- Selected Product Display --}}
                            <div class="mb-6 p-4 bg-white/5 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary text-2xl" id="quickSelectedIcon">countertops</span>
                                    </div>
                                    <div>
                                        <div class="text-white font-semibold" id="quickSelectedProduct">Kitchen Set</div>
                                        <div class="text-gray-500 text-xs" id="quickSelectedMaterial">Pilih material...</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Price Display --}}
                            <div class="text-center py-6">
                                <div class="text-gray-400 text-xs uppercase tracking-widest mb-2">Total Perkiraan</div>
                                <div class="flex items-start justify-center gap-1">
                                    <span class="text-lg text-primary font-bold mt-2">Rp</span>
                                    <span class="text-5xl font-bold text-white tracking-tight" id="quickTotalPrice">0</span>
                                </div>
                                <div class="text-[10px] text-gray-400 mt-2">*Harga belum termasuk aksesoris & ongkir</div>
                            </div>

                            {{-- Details --}}
                            <div class="space-y-3 mt-4 bg-white/5 rounded-xl p-4">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-400">Panjang</span>
                                    <span class="text-white font-medium" id="quickDisplayLength">3 meter</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-400">Harga/meter</span>
                                    <span class="text-white font-medium" id="quickPricePerMeter">Rp 0</span>
                                </div>
                                <div class="h-px bg-white/10 my-2"></div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-400">Subtotal</span>
                                    <span class="text-primary font-bold" id="quickSubtotal">Rp 0</span>
                                </div>
                            </div>

                            {{-- CTA Button --}}
                            <button type="button" onclick="quickCalculatorSubmit()" class="cursor-pointer block w-full py-4 mt-6 bg-primary text-black font-bold text-center uppercase tracking-widest rounded-xl hover:bg-white transition-colors duration-300 shadow-[0_0_20px_rgba(255,178,4,0.3)]">
                                Lanjutkan ke Kalkulator Pro
                            </button>

                            <div class="flex justify-center gap-6 mt-6">
                                <div class="flex items-center gap-1 text-[10px] text-gray-400 uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-sm text-green-500">verified</span> Garansi 2 Tahun
                                </div>
                                <div class="flex items-center gap-1 text-[10px] text-gray-400 uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-sm text-green-500">local_shipping</span> Gratis Ongkir*
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- TOAST NOTIFICATION CONTAINER --}}
<div id="quickToastContainer" class="fixed top-24 right-6 z-99999 flex flex-col gap-4 pointer-events-none"></div>

<style>
    /* Shake Animation for Input Error */
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        75% {
            transform: translateX(5px);
        }
    }

    .animate-shake {
        animation: shake 0.3s ease-in-out;
        border-color: #ffb204 !important;
    }

    /* Range slider styling */
    #quickLengthSlider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffb204, #e6a003);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(255, 178, 4, 0.4);
    }
</style>

<script>
    // Quick Calculator State
    const quickCalcState = {
        product: null,
        productName: '',
        material: null,
        materialName: '',
        length: 3,
        pricePerMeter: 0,
        data: {
            products: [],
            materials: []
        }
    };

    const productIcons = {
        'kitchen-set': 'countertops',
        'wardrobe': 'door_sliding',
        'backdrop-tv': 'tv',
        'wallpanel': 'dashboard'
    };

    // Initialize Quick Calculator
    async function initQuickCalculator() {
        try {
            const response = await fetch('{{ url("/api/calculator/init") }}');
            const result = await response.json();
            if (result.success) {
                quickCalcState.data.products = result.data.products || [];
                renderQuickProducts();
                if (quickCalcState.data.products.length > 0) {
                    selectQuickProduct(quickCalcState.data.products[0]);
                }
            }
        } catch (error) {
            console.error('Failed to initialize quick calculator:', error);
        }
    }

    // Render Products
    function renderQuickProducts() {
        const grid = document.getElementById('quickProductGrid');
        if (!grid) return;

        grid.innerHTML = quickCalcState.data.products.map((p, i) => `
            <label class="quick-product-option cursor-pointer group" data-id="${p.id}" data-slug="${p.slug}" data-name="${p.name}" onclick="selectQuickProduct(${JSON.stringify(p).replace(/"/g, '&quot;')})">
                <input type="radio" name="quick_product" value="${p.id}" class="hidden" ${i === 0 ? 'checked' : ''}>
                <div class="border-2 ${i === 0 ? 'border-primary bg-primary/10' : 'border-white/10 bg-white/[0.02]'} rounded-xl p-4 text-center transition-all group-hover:border-primary/50 h-full flex flex-col items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-3xl ${i === 0 ? 'text-primary' : 'text-gray-400'}">${productIcons[p.slug] || 'category'}</span>
                    <span class="text-white text-sm font-medium">${p.name}</span>
                </div>
            </label>
        `).join('');
    }

    // Select Product
    async function selectQuickProduct(product) {
        quickCalcState.product = product.id;
        quickCalcState.productName = product.name;

        // Update UI
        document.querySelectorAll('.quick-product-option > div').forEach(d => {
            d.classList.remove('border-primary', 'bg-primary/10');
            d.classList.add('border-white/10', 'bg-white/[0.02]');
            d.querySelector('.material-symbols-outlined').classList.remove('text-primary');
            d.querySelector('.material-symbols-outlined').classList.add('text-gray-400');
        });

        const selected = document.querySelector(`.quick-product-option[data-id="${product.id}"] > div`);
        if (selected) {
            selected.classList.add('border-primary', 'bg-primary/10');
            selected.classList.remove('border-white/10', 'bg-white/[0.02]');
            selected.querySelector('.material-symbols-outlined').classList.add('text-primary');
            selected.querySelector('.material-symbols-outlined').classList.remove('text-gray-400');
        }

        // Update preview
        document.getElementById('quickSelectedProduct').textContent = product.name;
        document.getElementById('quickSelectedIcon').textContent = productIcons[product.slug] || 'category';

        // Load materials for this product
        await loadQuickMaterials(product.id);
    }

    // Load Materials
    async function loadQuickMaterials(productId) {
        try {
            const response = await fetch(`{{ url("/api/calculator/materials") }}?product_id=${productId}`);
            const result = await response.json();
            if (result.success) {
                quickCalcState.data.materials = result.data;
                renderQuickMaterials();
                if (quickCalcState.data.materials.length > 0) {
                    selectQuickMaterial(quickCalcState.data.materials[0]);
                }
            }
        } catch (error) {
            console.error('Failed to load materials:', error);
        }
    }

    // Render Materials
    function renderQuickMaterials() {
        const grid = document.getElementById('quickMaterialGrid');
        if (!grid) return;

        const gradeColors = {
            'A': 'bg-green-500/20 text-green-400',
            'B': 'bg-blue-500/20 text-blue-400'
        };

        grid.innerHTML = quickCalcState.data.materials.map((m, i) => `
            <label class="quick-material-option cursor-pointer group" data-id="${m.id}" onclick="selectQuickMaterial(${JSON.stringify(m).replace(/"/g, '&quot;')})">
                <input type="radio" name="quick_material" value="${m.id}" class="hidden" ${i === 0 ? 'checked' : ''}>
                <div class="border-2 ${i === 0 ? 'border-primary bg-primary/10' : 'border-white/10 bg-white/[0.02]'} rounded-xl p-4 transition-all group-hover:border-primary/50">
                    <div class="flex items-center justify-between">
                        <span class="text-white text-sm font-medium">${m.name}</span>
                        <span class="text-[10px] ${gradeColors[m.grade]} font-bold px-2 py-1 rounded">Grade ${m.grade}</span>
                    </div>
                </div>
            </label>
        `).join('');
    }

    // Select Material
    function selectQuickMaterial(material) {
        quickCalcState.material = material.id;
        quickCalcState.materialName = material.name;
        quickCalcState.pricePerMeter = material.base_price;

        // Update UI
        document.querySelectorAll('.quick-material-option > div').forEach(d => {
            d.classList.remove('border-primary', 'bg-primary/10');
            d.classList.add('border-white/10', 'bg-white/[0.02]');
        });

        const selected = document.querySelector(`.quick-material-option[data-id="${material.id}"] > div`);
        if (selected) {
            selected.classList.add('border-primary', 'bg-primary/10');
            selected.classList.remove('border-white/10', 'bg-white/[0.02]');
        }

        document.getElementById('quickSelectedMaterial').textContent = material.name;

        // Update price
        updateQuickPrice();
    }

    // Update Price Display
    function updateQuickPrice() {
        const pricePerMeter = quickCalcState.pricePerMeter;
        const length = quickCalcState.length;
        const subtotal = pricePerMeter * length;

        document.getElementById('quickDisplayLength').textContent = `${length} meter`;
        document.getElementById('quickPricePerMeter').textContent = formatQuickCurrency(pricePerMeter);
        document.getElementById('quickSubtotal').textContent = formatQuickCurrency(subtotal);

        // Format total as shortened (e.g., 12.5 Jt)
        const totalInMillion = subtotal / 1000000;
        document.getElementById('quickTotalPrice').innerHTML = totalInMillion.toFixed(1) + '<span class="text-xl text-gray-400 font-bold ml-1">Jt</span>';
    }

    // Format Currency
    function formatQuickCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    }

    // Adjust Length
    function quickAdjustLength(delta) {
        let newVal = quickCalcState.length + delta;
        if (newVal < 0.5) newVal = 0.5;
        if (newVal > 20) newVal = 20;
        quickCalcState.length = newVal;

        document.getElementById('quickLengthInput').value = newVal;
        document.getElementById('quickLengthSlider').value = newVal;
        updateQuickPrice();
    }

    // Length Input Listeners
    document.addEventListener('DOMContentLoaded', function() {
        const lengthInput = document.getElementById('quickLengthInput');
        const lengthSlider = document.getElementById('quickLengthSlider');

        if (lengthInput) {
            lengthInput.addEventListener('input', function() {
                let val = parseFloat(this.value) || 0.5;
                if (val > 20) val = 20;
                if (val < 0.5) val = 0.5;
                quickCalcState.length = val;
                if (lengthSlider) lengthSlider.value = val;
                updateQuickPrice();
            });
        }

        if (lengthSlider) {
            lengthSlider.addEventListener('input', function() {
                quickCalcState.length = parseFloat(this.value);
                if (lengthInput) lengthInput.value = this.value;
                updateQuickPrice();
            });
        }

        // Initialize
        initQuickCalculator();
    });

    // Submit to Full Calculator
    function quickCalculatorSubmit() {
        // Build URL with parameters (name will be asked on full calculator page)
        const params = new URLSearchParams({
            product: quickCalcState.product || '',
            material: quickCalcState.material || '',
            length: quickCalcState.length
        });

        window.location.href = "{{ route('calculator') }}?" + params.toString();
    }

    // Toast Notification
    function showQuickToast(title, message) {
        const container = document.getElementById('quickToastContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = 'bg-[#1a1c22]/95 backdrop-blur-md border border-l-4 border-l-primary border-white/10 rounded-lg p-4 shadow-2xl flex items-start gap-3 w-80 pointer-events-auto transform translate-x-full transition-all duration-500 ease-out';
        toast.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary text-lg">priority_high</span>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm mb-1">${title}</h4>
                <p class="text-gray-400 text-xs leading-relaxed">${message}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-500 hover:text-white ml-auto">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        `;

        container.appendChild(toast);
        setTimeout(() => toast.classList.remove('translate-x-full'), 10);
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }
</script>