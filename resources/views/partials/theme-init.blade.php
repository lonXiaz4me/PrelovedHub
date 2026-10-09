{{-- Applies the saved theme before the page paints. "system" follows the device setting. --}}
<script>
    (function () {
        var media = window.matchMedia('(prefers-color-scheme: dark)');

        function apply() {
            var saved = 'system';
            try { saved = localStorage.getItem('theme') || 'system'; } catch (e) {}
            document.documentElement.classList.toggle('dark', saved === 'dark' || (saved === 'system' && media.matches));
        }

        window.applyTheme = apply;
        apply();
        media.addEventListener('change', apply);
    })();
</script>
