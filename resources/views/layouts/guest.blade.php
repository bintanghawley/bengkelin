<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkelin - Auth</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Script Deteksi Awal Mode Gelap (Mencegah Flash Putih) -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-bengkel { font-family: 'Bebas Neue', sans-serif; tracking-wide; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full bg-zinc-50 text-zinc-900 dark:bg-zinc-950 dark:text-white antialiased transition-colors duration-300">
    
    <!-- Tombol Toggle Dark/Light Mode Melayang -->
    <div class="fixed top-4 right-4 z-50">
        <button id="theme-toggle" type="button" class="text-zinc-500 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-zinc-200 dark:focus:ring-zinc-700 rounded-lg text-sm p-2.5 shadow-sm border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 transition-all duration-200">
            <!-- Ikon Bulan (Aktif jika sedang di Light Mode) -->
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <!-- Ikon Matahari (Aktif jika sedang di Dark Mode) -->
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.46 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    @yield('content')

    <script>
        // --- LOGIC PHONE INPUT ---
        const getPhoneDigits = (value) => value.replace(/\D/g, '').slice(0, 13);

        const formatPhoneValue = (value) => {
            const parts = getPhoneDigits(value).match(/.{1,4}/g);
            return parts ? parts.join('-') : '';
        };

        const bindPhoneInputs = () => {
            document.querySelectorAll('[data-phone-input]').forEach((input) => {
                const applyFormat = () => {
                    input.value = formatPhoneValue(input.value);
                };

                applyFormat();

                if (!input.dataset.phoneBound) {
                    input.dataset.phoneBound = 'true';
                    input.addEventListener('input', applyFormat);

                    const form = input.closest('form');
                    if (form && !form.dataset.phoneFormatBound) {
                        form.dataset.phoneFormatBound = 'true';
                        form.addEventListener('submit', () => {
                            form.querySelectorAll('[data-phone-input]').forEach((field) => {
                                const originalName = field.dataset.phoneOriginalName || field.name;
                                if (!originalName) {
                                    return;
                                }
                                const digits = getPhoneDigits(field.value);
                                let hidden = form.querySelector(`input[type="hidden"][data-phone-hidden="${originalName}"]`);
                                if (!hidden) {
                                    hidden = document.createElement('input');
                                    hidden.type = 'hidden';
                                    hidden.name = originalName;
                                    hidden.setAttribute('data-phone-hidden', originalName);
                                    form.appendChild(hidden);
                                }
                                hidden.value = digits;
                                field.dataset.phoneOriginalName = originalName;
                                field.name = `${originalName}_formatted`;
                            });
                        });
                    }
                }
            });
        };

        bindPhoneInputs();
        window.addEventListener('pageshow', bindPhoneInputs);
        window.addEventListener('load', () => setTimeout(bindPhoneInputs, 50));

        // --- LOGIC TOGGLE DARK/LIGHT MODE ---
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (themeToggleBtn && themeToggleDarkIcon && themeToggleLightIcon) {
            // Tampilkan ikon yang sesuai berdasarkan tema saat ini
            if (document.documentElement.classList.contains('dark')) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                // Bergantian ikon
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                // Toggle tema dan simpan preferensi ke localStorage
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            });
        }
    </script>
</body>
</html>