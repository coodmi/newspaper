<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
@php
    $website = \App\Models\Website::first();
@endphp

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        .swiper-hidden {
            opacity: 0;
            visibility: hidden;
        }

        .swiper-ready {
            opacity: 1;
            visibility: visible;
            transition: opacity .3s ease;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-family: swiper-icons;
            font-size: 18px;
            font-weight: bolder;
            letter-spacing: 0;
            font-variant: initial;
            line-height: 1;
        }
    </style>
    <script>
        (function () {
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
                new MutationObserver(function () {
                    applyTheme();
                }).observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

                // Watch for localStorage changes (from other tabs)
                window.addEventListener('storage', function (e) {
                    if (e.key === 'theme') {
                        applyTheme();
                    }
                });
            } catch (e) { }
        })();
    </script>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if ($website && $website->favicon)
        <link rel="icon" href="{{ asset('storage/' . $website->favicon) }}" type="image/x-icon">
    @else
        <link rel="icon"
            href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAjRJREFUaEPtlkurwkAMhVPFB6KCD0QEETdu/P//wq0bNyKCiOhKEUW0l1NISaftdWouyIUUumjpJHO+k2QaLBaLkP7xFZiAL7tnDnzZADIHzAElASshJUD1cnNAjVAZwBxQAlQvNwfUCJUBfnVgMplQr9ej/X5Pu90uTjWbzajVasXPx+ORNpvNx1uZz+dULpdpvV7T+XwulCdXADY+Ho+pVColBLii8Nzv9+lTEbz+8XgkBPjmyRUAKvV6ncIwjAWA+nQ6pefzScvlMiaFb3HJdz52MCTQlwKK5MkUAPWdToculwu12+1CAri8pCNMGeWxWq1SwvFClpBKAFO5Xq90v99TPeBjrazparUalSIIS4dkHMBye8AnD4SnHABBlA4aqtvtZjbxaDSi4XBIQRAkSozRSgiVSoVwb7dbOp1O0SdM+Ha7RY7kNfG7PCkBWDAYDOhwOERTJ2sKIZncECdBucnykJPKbXAJCWWVJcA3T+yASwXqXAG8WZCUYxMbajQaCcrswuv1SkwXFxLyuAKK5IkFSLuyJghIgbJ0iL/LcwqliEs2r3uGyFw88fDON0+hgyyPDE8trnN5NtRqNWo2m6nDUG7c1wE3T2YTy8Cf9IA7AvkZcd2TlnP9SQ9klY3vr4QsEWwG1OXvBzuHsZx12Pn+SrjnyFsHfE7Tb39jv9PmgJKAlZASoHq5OaBGqAxgDigBqpebA2qEygDmgBKgerk5oEaoDGAOKAGql5sDaoTKAD8vM7LfeSkSsAAAAABJRU5ErkJggg=="
            type="image/x-icon">
    @endif

    @if (!trim($__env->yieldPushContent('post-head')))
        <title>{{ $website ? $website->title : 'My Website' }}</title>
        <meta name="description" content="{{ $website ? $website->meta_description : 'Default description' }}">
        <meta name="keywords" content="{{ $website ? $website->meta_tags : 'default, tags' }}">
        <meta property="og:title" content="{{ $website ? $website->title : 'My Website' }}">
        <meta property="og:description" content="{{ $website ? $website->meta_description : 'Default description' }}">
        <meta property="og:image"
            content="{{ $website && $website->logo ? asset('storage/' . $website->logo) : asset('storage/website/defoultlogo.png') }}">
        <meta property="og:url" content="{{ url('/') }}">
        <meta name="author" content="{{ $website ? $website->title : 'My Website' }}">
    @else
        @stack('post-head')
    @endif

    <!-- Add the slick-theme.css if you want default styling -->
    {{--
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">
    @fluxAppearance
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        html {
            overflow-x: hidden;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
        }
    </style>
    @stack('styles')
    {{-- @livewireStyles --}}

    @if($website && $website->adsense_publisher_id)
        <script async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $website->adsense_publisher_id }}"
            crossorigin="anonymous"></script>
    @endif
</head>

<body class=" bg-white dark:bg-zinc-900" style="overflow-x: hidden;
            max-width: 100vw;">
    <div>
        <!-- Facebook SDK -->
        <div id="fb-root"></div>
        @if ($website && $website->facebook_app_id)
            <script async crossorigin="anonymous"
                src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0&appId={{ $website->facebook_app_id }}&autoLogAppEvents=1"
                nonce="abc123">
                </script>
        @else
            <script async crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0"
                nonce="abc123"></script>
        @endif


        <livewire:frontend.layouts.header />
        <livewire:frontend.layouts.nav />

        <main class="min-h-screen max-w-7xl mx-auto py-4">
            {{ $slot }}
        </main>

        <livewire:frontend.layouts.footer />
    </div>


    <!-- Footer Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" defer></script>
    @fluxScripts
    <script>

        let homeSwiper;

        function initSwiperCarousel() {
            // Destroy old swiper if exists
            const el = document.querySelector('.post-view-autoplay-carousel');
            // if (!el) return;
            if (homeSwiper) {
                homeSwiper.destroy(true, true);
            }

            homeSwiper = new Swiper('.home-autoplay-carousel', {
                loop: true,
                slidesPerView: 6,
                spaceBetween: 16,

                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },

                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                breakpoints: {
                    0: {
                        slidesPerView: 2,
                    },
                    480: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 6,
                    },
                },
                on: {
                    init() {
                        document
                            .querySelector('.home-autoplay-carousel')
                            .classList.add('swiper-ready');
                    }
                }

            });
            el.addEventListener('mouseenter', () => postViewSwiper.autoplay.stop());
            el.addEventListener('mouseleave', () => postViewSwiper.autoplay.start());
        }

        document.addEventListener('DOMContentLoaded', initSwiperCarousel);
        document.addEventListener('livewire:load', initSwiperCarousel);
        document.addEventListener('livewire:updated', initSwiperCarousel);
        document.addEventListener('livewire:navigated', initSwiperCarousel);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.initFlowbite) {
                window.initFlowbite();
            }
        });

        document.addEventListener('livewire:navigated', () => {
            if (window.initFlowbite) {
                window.initFlowbite();
            }
        });

    </script>
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


    @stack('scripts')
    {{-- @livewireStyles --}}
</body>

</html>