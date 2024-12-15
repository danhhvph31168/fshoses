
const PATH_ROOT = "{{ url('/') }}"; // Khai báo trước


if (typeof PATH_ROOT === 'undefined') {
    console.error('PATH_ROOT is not defined');
} else {
    // Chèn script
    const loadScript = (src) => {
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = src;
        document.head.appendChild(script);
    };

    if (
        document.querySelector("[toast-list]") ||
        document.querySelector("[data-choices]") ||
        document.querySelector("[data-provider]")
    ) {
        loadScript('https://cdn.jsdelivr.net/npm/toastify-js');
        loadScript(`${PATH_ROOT}/assets/libs/choices.js/public/assets/scripts/choices.min.js`);
        loadScript(`${PATH_ROOT}/assets/libs/flatpickr/flatpickr.min.js`);
    }
}