(function () {
    const MAX_PHOTOS = 5;
    const MAX_FILE_BYTES = 10 * 1024 * 1024;
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];

    const form = document.querySelector('[data-portfolio-form]');
    const input = document.getElementById('photos-input');
    const uploadZone = document.getElementById('photo-upload-zone');
    const previewGrid = document.getElementById('photo-preview-grid');
    const countEl = document.getElementById('photo-count');
    const errorEl = document.getElementById('photo-upload-error');
    const existingInputs = document.getElementById('existing-photo-inputs');
    const removedInputs = document.getElementById('removed-photo-inputs');
    const submitButton = document.querySelector('[data-submit-button]');
    const submitLabel = document.querySelector('[data-submit-label]');

    if (!form || !input || !previewGrid || !countEl || !errorEl) return;

    let items = (window.portfolioInitialPhotos || []).map((photo) => ({
        type: 'existing',
        id: photo.id,
        url: photo.url,
        path: photo.path,
    }));

    let removedIds = [];

    function showError(message) {
        errorEl.textContent = message;
        errorEl.classList.remove('hidden');
        if (typeof window.showAdminToast === 'function') {
            window.showAdminToast(message, 'error');
        }
    }

    function clearError() {
        errorEl.textContent = '';
        errorEl.classList.add('hidden');
    }

    function fileExtension(file) {
        return (file.name.split('.').pop() || '').toLowerCase();
    }

    function validateFiles(files) {
        if (items.length + files.length > MAX_PHOTOS) {
            return 'Maksimal upload 5 foto.';
        }

        for (const file of files) {
            if (!ALLOWED_TYPES.includes(file.type)) {
                return file.type.startsWith('image/')
                    ? 'Format gambar tidak didukung. Gunakan JPG, JPEG, PNG, atau WEBP.'
                    : 'Foto wajib berupa gambar.';
            }

            if (!ALLOWED_EXTENSIONS.includes(fileExtension(file))) {
                return 'Format gambar tidak didukung. Gunakan JPG, JPEG, PNG, atau WEBP.';
            }

            if (file.size > MAX_FILE_BYTES) {
                return 'Ada foto yang melebihi batas 10 MB.';
            }
        }

        return null;
    }

    function rebuildFileInput() {
        const dataTransfer = new DataTransfer();
        items
            .filter((item) => item.type === 'new')
            .forEach((item) => dataTransfer.items.add(item.file));
        input.files = dataTransfer.files;
    }

    function syncHiddenInputs() {
        if (existingInputs) {
            existingInputs.innerHTML = '';
            items
                .filter((item) => item.type === 'existing')
                .forEach((item) => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'existing_photos[]';
                    hidden.value = item.id;
                    existingInputs.appendChild(hidden);
                });
        }

        if (removedInputs) {
            removedInputs.innerHTML = '';
            removedIds.forEach((id) => {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'removed_photos[]';
                hidden.value = id;
                removedInputs.appendChild(hidden);
            });
        }
    }

    function removeItem(index) {
        const item = items[index];
        if (!item) return;

        if (item.type === 'new') {
            URL.revokeObjectURL(item.url);
        } else if (item.id) {
            removedIds.push(item.id);
        }

        items.splice(index, 1);
        render();
    }

    function render() {
        countEl.textContent = `${items.length} / ${MAX_PHOTOS}`;
        previewGrid.innerHTML = '';

        uploadZone?.classList.toggle('hidden', items.length >= MAX_PHOTOS);

        items.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'group relative overflow-hidden rounded-xl border border-white/10 bg-black/30';
            card.style.aspectRatio = '4 / 3';
            card.innerHTML = `
                <img src="${item.url}" alt="Preview foto ${index + 1}" class="h-full w-full object-cover" loading="lazy">
                <div class="absolute inset-x-0 bottom-0 flex items-center justify-between gap-2 bg-linear-to-t from-black/80 to-transparent p-2">
                    <span class="rounded-full bg-black/70 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-white">${index === 0 ? 'Cover' : 'Foto ' + (index + 1)}</span>
                    <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-red-500 text-white transition hover:bg-red-400" aria-label="Hapus foto">
                        <span class="material-symbols-outlined text-base">close</span>
                    </button>
                </div>
            `;
            card.querySelector('button').addEventListener('click', () => removeItem(index));
            previewGrid.appendChild(card);
        });

        rebuildFileInput();
        syncHiddenInputs();
    }

    input.addEventListener('change', () => {
        clearError();
        const files = Array.from(input.files || []);
        if (!files.length) return;

        const error = validateFiles(files);
        if (error) {
            showError(error);
            input.value = '';
            return;
        }

        files.forEach((file) => {
            items.push({
                type: 'new',
                file,
                url: URL.createObjectURL(file),
            });
        });

        render();
    });

    form.addEventListener('submit', (event) => {
        clearError();

        if (items.length < 1) {
            event.preventDefault();
            showError('Foto wajib berupa gambar.');
            return;
        }

        if (items.length > MAX_PHOTOS) {
            event.preventDefault();
            showError('Maksimal upload 5 foto.');
            return;
        }

        submitButton?.setAttribute('disabled', 'disabled');
        submitButton?.classList.add('opacity-70', 'cursor-not-allowed');
        if (submitLabel) submitLabel.textContent = 'Menyimpan...';
    });

    window.addEventListener('beforeunload', () => {
        items
            .filter((item) => item.type === 'new')
            .forEach((item) => URL.revokeObjectURL(item.url));
    });

    render();
})();
