<section>
    @push('post-head')
        @php
            $website = \App\Models\Website::first();
        @endphp
        <title>{{ $website?->title}}-{{ $post?->title }} - {{ config('app.name') }}</title>
        <meta name="description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
        <meta name="keywords" content="{{ $post->keywords ?? $website->meta_tags }}">
        <meta property="og:title" content="{{ $post->title }}">
        <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
        <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $post->title }}">
        <meta name="twitter:description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
        <meta name="twitter:image" content="{{ asset('storage/' . $post->featured_image) }}">
        <meta name="author" content="{{ $post->user?->name ?? 'Unknown' }}">
        <link rel="canonical" href="{{ url()->current() }}">
        <link rel="alternate" href="{{ url()->current() }}" hreflang="en">
        <link rel="alternate" href="{{ url()->current() }}" hreflang="bn">
        <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">
    @endpush
    <!-- Breadcrumbs -->
    <div class="container mx-auto px-2 py-6 text-ellipsis whitespace-nowrap">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('home') }}">Home</flux:breadcrumbs.item>
            {{-- <flux:breadcrumbs.item>{{ $post->category?->name ?? 'Uncategorized' }}</flux:breadcrumbs.item> --}}
            @php
                $category = $post->category;
            @endphp

            @if ($category)
                <flux:breadcrumbs.item href="{{ route('search.category', ['searchQuery' => $category->slug]) }}"
                    wire:navigate>
                    {{ $category->name }}
                </flux:breadcrumbs.item>
            @else
                <flux:breadcrumbs.item>
                    Uncategorized
                </flux:breadcrumbs.item>
            @endif
            <flux:breadcrumbs.item>{{ Str::limit($post->title, 40, '...') }}</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="min-h-screen">
        <!-- Post Content -->
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-4">
            <div class="md:w-[70%]">
                <div
                    class=" mb-5 px-3 py-3 rounded-xl border bg-gray-50 dark:bg-zinc-800 dark:border-zinc-700 shadow-md">

                    @if ($post->featured_image && $post->video_url)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @else
                            <div class="grid grid-cols-1 gap-4">
                        @endif

                            @if ($post->featured_image)
                                <div class="mb-8">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="w-full h-auto object-cover rounded-lg shadow-lg">
                                </div>
                            @endif

                            @if ($post->video_url)
                                @php
                                    // ভিডিও লিঙ্ক থেকে শুধুমাত্র ভিডিও আইডি বের করার জন্য Regex
                                    preg_match('/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=|shorts\/)([^#&?]*).*/', $post->video_url, $matches);
                                    $videoId = $matches[2] ?? null;
                                @endphp

                                {{-- যদি একটি বৈধ ভিডিও আইডি পাওয়া যায়, তবেই iframe দেখানো হবে --}}
                                @if ($videoId)
                                    <div class="mb-8">
                                        <div
                                            class="relative w-full h-0 pb-[56.25%] rounded-lg overflow-hidden shadow-lg bg-black">
                                            <iframe {{-- এখানে শুধু $videoId ব্যবহার করা হয়েছে --}}
                                                src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&controls=1"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg">
                                            </iframe>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class=" mb-8">
                            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                                {{ $post->title }}
                            </h1>
                            <div
                                class="flex flex-col md:flex-row md:items-center md:justify-between flex-wrap space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                <div
                                    class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400 flex-wrap">
                                    <span class="whitespace-nowrap"><i class="far fa-calendar-alt mr-1"></i>
                                        {{ \App\Helpers\BanglaDateHelper::formattedLineThree($post->created_at) }}
                                    </span>
                                    <span class="flex items-center gap-1.5 flex-nowrap">
                                        <img src="{{ asset('storage/' . $post->user?->profile_image ?? 'Unknown') }}"
                                            alt="{{  $post->user?->name }}" class=" rounded-full w-6 h-6 mb-1">
                                        {{ $post->user?->name ?? 'Unknown' }}
                                    </span>
                                    <span class="whitespace-nowrap"><i
                                            class="far fa-eye mr-1"></i>{{ $this->convertToBengaliNumbers($post->view_count ?? 0) }}
                                        views</span>
                                </div>

                                <div class="flex items-start space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                    <!-- Modern Social Media Share -->
                                    <div class="flex md:flex-row-reverse items-center space-x-3">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Share</span>

                                        <!-- Facebook -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                            target="_blank"
                                            class="group relative border h-8 w-8 flex items-center justify-center bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Share on Facebook">
                                            <i
                                                class="fab fa-facebook-f text-blue-600 dark:text-blue-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Facebook
                                            </div>
                                        </a>

                                        <!-- Twitter/X -->
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                                            target="_blank"
                                            class="group relative border h-8 w-8 flex items-center justify-center bg-sky-50 hover:bg-sky-100 dark:bg-sky-900/20 dark:hover:bg-sky-900/30 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Share on Twitter">
                                            <i class="fab fa-twitter text-sky-500 dark:text-sky-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Twitter
                                            </div>
                                        </a>

                                        <!-- LinkedIn -->
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                            target="_blank"
                                            class="group relative border h-8 w-8 flex items-center justify-center bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Share on LinkedIn">
                                            <i
                                                class="fab fa-linkedin-in text-blue-700 dark:text-blue-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                LinkedIn
                                            </div>
                                        </a>

                                        <!-- WhatsApp -->
                                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                                            target="_blank"
                                            class="group relative border h-8 w-8 flex items-center justify-center bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:hover:bg-green-900/30 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Share on WhatsApp">
                                            <i
                                                class="fab fa-whatsapp text-green-600 dark:text-green-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                WhatsApp
                                            </div>
                                        </a>

                                        <!-- Telegram -->
                                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                                            target="_blank"
                                            class="group relative border h-8 w-8 flex items-center justify-center bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Share on Telegram">
                                            <i
                                                class="fab fa-telegram-plane text-blue-500 dark:text-blue-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Telegram
                                            </div>
                                        </a>

                                        <!-- Reddit -->
                                        <a href="https://reddit.com/submit?url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}"
                                            target="_blank"
                                            class="group relative border h-8 w-8 flex items-center justify-center bg-orange-50 hover:bg-orange-100 dark:bg-orange-900/20 dark:hover:bg-orange-900/30 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Share on Reddit">
                                            <i
                                                class="fab fa-reddit-alien text-orange-600 dark:text-orange-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Reddit
                                            </div>
                                        </a>

                                        <!-- Pinterest -->
                                        <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(asset('storage/' . $post->featured_image)) }}&description={{ urlencode($post->title) }}"
                                            target="_blank"
                                            class="group relative border h-8 w-8 flex items-center justify-center bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/30 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Share on Pinterest">
                                            <i
                                                class="fab fa-pinterest-p text-red-600 dark:text-red-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Pinterest
                                            </div>
                                        </a>

                                        <!-- Copy Link -->
                                        <button onclick="copyToClipboard('{{ url()->current() }}')"
                                            class="group mr-2.5 relative border h-8 w-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-full transition-all duration-200 hover:scale-110"
                                            title="Copy Link">
                                            <i class="fas fa-link text-gray-600 dark:text-gray-400 text-[16px]"></i>
                                            <div
                                                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Copy Link
                                            </div>
                                        </button>
                                    </div>

                                    <script>
                                        function copyToClipboard(text) {
                                            navigator.clipboard.writeText(text).then(function () {
                                                // Modern toast notification
                                                const toast = document.createElement('div');
                                                toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full';
                                                toast.textContent = 'Link copied to clipboard!';
                                                document.body.appendChild(toast);

                                                setTimeout(() => {
                                                    toast.classList.remove('translate-x-full');
                                                }, 100);

                                                setTimeout(() => {
                                                    toast.classList.add('translate-x-full');
                                                    setTimeout(() => {
                                                        document.body.removeChild(toast);
                                                    }, 300);
                                                }, 2000);
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        {{-- Mid-article ad --}}
                        <div class="my-4">
                            <livewire:ads.display-ads-banner :locationKey="'post_mid_banner'" />
                        </div>

                        <article
                            class=" text-[20.4px] md:text-[18px] md:leading-[1.66] leading-[1.85] prose prose-lg max-w-none dark:prose-invert my-12 dark:text-gray-300"
                            style="word-spacing: 3.3px">
                            {!! $post->content !!}
                        </article>

                        {{-- Post bottom ad --}}
                        <div class="my-4">
                            <livewire:ads.display-ads-banner :locationKey="'post_bottom_banner'" />
                        </div>
                    </div>

                    @if ($poll)
                        <div
                            class="mb-6 px-6 py-6 rounded-xl border border-gray-300  bg-white dark:bg-zinc-800 dark:border-zinc-700 shadow-md">
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">{{ $poll->question }}</h2>

                            @php
                                $totalVotes = $poll->options->sum('votes');
                                $colors = [
                                    'bg-green-500 text-white',
                                    'bg-yellow-400 text-gray-700',
                                    'bg-red-500 text-white',
                                    'bg-blue-500 text-white',
                                    'bg-purple-600 text-white',
                                    'bg-pink-500 text-white',
                                    'bg-teal-500 text-white',
                                    'bg-orange-500 text-white',
                                    'bg-gray-500 text-white',
                                    'bg-indigo-500 text-white',
                                    'bg-lime-500 text-white',
                                    'bg-emerald-500 text-white',
                                    'bg-cyan-500 text-white',
                                ];
                            @endphp

                            <div class="space-y-5">
                                @foreach ($poll->options as $option)
                                    @php
                                        $rawPercent = $totalVotes > 0 ? ($option->votes / $totalVotes) * 100 : 0;
                                        $percent = $rawPercent > 0 ? round($rawPercent) : 5;

                                        $isVoted = $votedOptionId !== null;
                                        $isSelected = $votedOptionId === $option->id;
                                        $disabled = $isVoted && !$isSelected;

                                        $color = $colors[$loop->index % count($colors)];
                                        $barOpacity = $disabled ? 'opacity-40 cursor-not-allowed' : 'opacity-100';
                                        $textColor = explode(' ', $color)[1];
                                    @endphp

                                    <button wire:click="vote({{ $option->id }})" type="button" class="w-full focus:outline-none"
                                        @if($disabled) disabled @endif>
                                        <div class="mb-1 text-sm font-medium text-gray-800 dark:text-gray-200 text-left">
                                            {{ $option->option_text }}
                                        </div>
                                        <div
                                            class="relative w-full bg-gray-200 dark:bg-zinc-900 rounded-full h-6 overflow-hidden cursor-pointer {{ $disabled ? 'cursor-not-allowed' : 'hover:opacity-90' }}">
                                            <div class="{{ $color }} h-6 rounded-full flex items-center justify-center font-semibold text-sm transition-all duration-500 {{ $barOpacity }}"
                                                style="width: {{ $percent }}%; min-width: 60px;"
                                                aria-label="{{ $option->option_text }} votes progress bar" role="progressbar"
                                                aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                                                <span class="px-4 select-none truncate" style="color: inherit;">
                                                    {{ $rawPercent > 0 ? $percent . '%' : '0%' }}
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>

                            {{-- Total Votes --}}
                            <div class="mt-4 text-right">
                                <small class="text-gray-600 dark:text-gray-400">মোট ভোট:
                                    {{ $this->convertToBengaliNumbers($totalVotes) }}</small>
                            </div>
                        </div>
                    @endif

                    <div
                        class=" mb-3 px-3 py-3 rounded-xl border bg-gray-50 dark:bg-zinc-800 dark:border-zinc-700 shadow-md">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Comments</h2>

                            <!-- Comment Form -->
                            <div wire:ignore class="fb-comments" data-href="{{ url()->current() }}" data-width="100%"
                                data-numposts="5">
                            </div>
                        </div>
                    </div>
                </div>

                <livewire:frontend.layouts.aside />
            </div>
        </div>

        <div>
            @if ($relatedPosts->count())
                <div class="bg-[#e8f1ff] border rounded-xl dark:bg-zinc-800 dark:border-zinc-700">
                    <div class="container mx-auto px-2 pb-2 pt-3 text-center">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">সম্পর্কিত পোস্ট</h2>
                    </div>

                    <div wire:ignore class="swiper swiper-hidden post-view-autoplay-carousel relative">
                        <div class="swiper-wrapper">
                            @foreach ($relatedPosts as $relatedPost)
                                <div class="swiper-slide p-2">
                                    <div
                                        class="p-1.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100
                                                                                     dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600">
                                        <a href="{{ route('post.view', ['slug' => $relatedPost->slug]) }}" wire:navigate
                                            onclick="window.Livewire.navigate(this.href); return false;">
                                            <div class="h-[50%]">
                                                <img src="{{ asset('storage/' . $relatedPost->featured_image) }}"
                                                    alt="{{ $relatedPost->title }}" class="w-full h-auto rounded">
                                            </div>
                                            <div class="px-2 py-1">
                                                <p class="line-clamp-2 dark:text-gray-300">
                                                    {{ $relatedPost->title }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation arrows -->
                        <div class="swiper-button-prev text-md bg-white text-black rounded"
                            style="height: 40px !important; width: 40px !important; color:black"></div>
                        <div class="swiper-button-next text-md bg-white text-black rounded"
                            style="height: 40px !important; width: 40px !important; color:black"></div>

                    </div>
            @endif
            </div>

            @push('scripts')
                <script>
                    let postViewSwiper;
                    function reinitializeAll() {
                        // Flowbite re-init
                        if (window.initFlowbite) {
                            window.initFlowbite();
                        }

                        // Facebook comment plugin
                        if (typeof FB !== 'undefined' && FB.XFBML) {
                            FB.XFBML.parse();
                        }

                        const el = document.querySelector('.post-view-autoplay-carousel');
                        if (!el) return;

                        // destroy old swiper
                        if (postViewSwiper) {
                            postViewSwiper.destroy(true, true);
                        }

                        postViewSwiper = new Swiper(el, {
                            loop: true,
                            slidesPerView: 5,
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
                                    slidesPerView: 4,
                                },
                            },
                            on: {
                                init() {
                                    document
                                        .querySelector('.post-view-autoplay-carousel')
                                        .classList.add('swiper-ready');
                                }
                            }
                        });
                        el.addEventListener('mouseenter', () => postViewSwiper.autoplay.stop());
                        el.addEventListener('mouseleave', () => postViewSwiper.autoplay.start());

                    }

                    // Fire on initial load
                    document.addEventListener('DOMContentLoaded', () => {
                        reinitializeAll();
                    });

                    // Fire on Livewire navigation
                    document.addEventListener('livewire:navigated', () => {
                        reinitializeAll();
                    });

                    // Fire after DOM update (e.g., polling, event, action)
                    document.addEventListener('livewire:updated', () => {
                        reinitializeAll();
                    });
                    console.log(" Livewire DOM updated – reinitializing"); </script>
            @endpush
</section>