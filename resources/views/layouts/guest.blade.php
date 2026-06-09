<!DOCTYPE html>
<html lang="en" class="h-full dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkelin - Auth</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    {{-- Force dark mode permanently --}}
    <script>document.documentElement.classList.add('dark');</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Hide all scrollbars globally */
        *::-webkit-scrollbar {
            display: none !important;
        }
        * {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        .font-bengkel { font-family: 'Bebas Neue', sans-serif; tracking-wide; }
        body { font-family: 'Inter', sans-serif; }

        /* Prevent browser autofill from changing font styles, sizes, and colors */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #27272a inset !important; /* zinc-800 */
            -webkit-text-fill-color: #ffffff !important;
            font-size: 0.875rem !important; /* text-sm */
            font-family: 'Inter', sans-serif !important;
        }

        /* Toast animation */
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .animate-toast {
            animation: slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
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
    @include('partials.toast')
</body>
</html>