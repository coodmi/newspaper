<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    <script>
        (function() {
            try {
                function applyTheme() {
                    var currentTheme = localStorage.getItem('theme');
                    if (!currentTheme) {
                        currentTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                    }
        
                    const hasDarkClass = document.documentElement.classList.contains('dark');
        
                    if (currentTheme === 'dark' && !hasDarkClass) {
                        document.documentElement.classList.add('dark');
                    } else if (currentTheme !== 'dark' && hasDarkClass) {
                        document.documentElement.classList.remove('dark');
                    }
                }
        
                // Initial
                applyTheme();
        
                // Watch for className tampering
                new MutationObserver(function() {
                    applyTheme();
                }).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        
                // Watch for localStorage changes (from other tabs)
                window.addEventListener('storage', function(e) {
                    if (e.key === 'theme') {
                        applyTheme();
                    }
                });
            } catch (e) {}
        })();
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @stack('cdns')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom styles */
        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
        }
    </style>
</head>

<body>
    
    <x-layouts.app.sidebar :title="$title ?? null">
        {{-- <h1>hi</h1> --}}
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>

    @stack('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                dark: false,
                toggle() {
                    this.dark = !this.dark;
                    this.apply();
                },
                apply() {
                    if (this.dark) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    }
                },
                init() {
                    this.dark = localStorage.getItem('theme') === 'dark' ||
                        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    this.apply();
                }
            });

            Alpine.store('theme').init();
        });

        document.addEventListener('livewire:navigated', () => {
            if (Alpine && Alpine.store) {
                Alpine.store('theme').init();
            }
        });

        document.addEventListener('livewire:load', () => {
            Alpine.store('theme').init();
        });
    </script>
</body>

</html>