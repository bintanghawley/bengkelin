<!DOCTYPE html>
<html lang="en" class="h-full dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkelin - Auth</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    {{-- Force dark mode permanently --}}
    <script>document.documentElement.classList.add('dark');</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-bengkel { font-family: 'Bebas Neue', sans-serif; tracking-wide; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full bg-zinc-950 text-white antialiased">

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
    </script>
</body>
</html>