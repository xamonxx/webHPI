(function () {
    const comboboxes = document.querySelectorAll('[data-category-combobox]');

    if (!comboboxes.length) return;

    function cleanValue(value) {
        return (value || '').replace(/\s+/g, ' ').trim();
    }

    function normalize(value) {
        return cleanValue(value).toLowerCase();
    }

    comboboxes.forEach((combobox) => {
        const input = combobox.querySelector('[data-category-input]');
        const hidden = combobox.querySelector('[data-category-hidden]');
        const toggle = combobox.querySelector('[data-category-toggle]');
        const panel = combobox.querySelector('[data-category-panel]');
        const newRow = combobox.querySelector('[data-category-new-row]');
        const newButton = combobox.querySelector('[data-category-new]');
        const newLabel = combobox.querySelector('[data-category-new-label]');
        const emptyState = combobox.querySelector('[data-category-empty]');
        const options = Array.from(combobox.querySelectorAll('[data-category-option]'));

        if (!input || !hidden || !toggle || !panel) return;

        function isOpen() {
            return !panel.classList.contains('hidden');
        }

        function openPanel() {
            panel.classList.remove('hidden');
            input.setAttribute('aria-expanded', 'true');
            filterOptions(input.value);
        }

        function closePanel() {
            panel.classList.add('hidden');
            input.setAttribute('aria-expanded', 'false');
        }

        function updateSelected(value) {
            const selected = normalize(value);

            options.forEach((option) => {
                const isSelected = normalize(option.dataset.categoryValue) === selected;
                const check = option.querySelector('[data-category-check]');

                option.classList.toggle('bg-primary/10', isSelected);
                option.classList.toggle('text-primary', isSelected);
                option.classList.toggle('text-gray-300', !isSelected);
                check?.classList.toggle('hidden', !isSelected);
            });
        }

        function setValue(value, closeAfterSelect = true) {
            const cleaned = cleanValue(value);

            input.value = cleaned;
            hidden.value = cleaned;
            updateSelected(cleaned);

            if (closeAfterSelect) {
                closePanel();
            }
        }

        function filterOptions(query) {
            const keyword = normalize(query);
            let visibleCount = 0;
            let exactMatch = false;

            options.forEach((option) => {
                const value = option.dataset.categoryValue || '';
                const label = normalize(value || option.textContent);
                const visible = !keyword || label.includes(keyword) || value === '';

                option.classList.toggle('hidden', !visible);

                if (visible) {
                    visibleCount += 1;
                }

                if (keyword && normalize(value) === keyword) {
                    exactMatch = true;
                }
            });

            const canCreate = Boolean(keyword && !exactMatch);

            if (newButton && newLabel) {
                newLabel.textContent = cleanValue(query);
                newRow?.classList.toggle('hidden', !canCreate);
            }

            emptyState?.classList.toggle('hidden', visibleCount > 1 || canCreate);
        }

        input.addEventListener('focus', openPanel);
        input.addEventListener('input', () => {
            const cleaned = cleanValue(input.value);

            hidden.value = cleaned;
            updateSelected(cleaned);
            openPanel();
            filterOptions(cleaned);
        });

        input.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closePanel();
                return;
            }

            if (event.key === 'Enter') {
                event.preventDefault();
                setValue(input.value);
            }
        });

        toggle.addEventListener('click', () => {
            if (isOpen()) {
                closePanel();
                return;
            }

            input.focus();
            openPanel();
        });

        options.forEach((option) => {
            option.addEventListener('click', () => {
                setValue(option.dataset.categoryValue || '');
            });
        });

        newButton?.addEventListener('click', () => {
            setValue(input.value);
        });

        document.addEventListener('click', (event) => {
            if (!combobox.contains(event.target)) {
                closePanel();
            }
        });

        updateSelected(hidden.value);
    });
})();
