<aside class="md:w-[30%] lg:sticky lg:top-[50px] h-screen overflow-y-auto scrollbar-hidden rounded-xl border bg-[#e8f1ff] dark:bg-zinc-800 dark:border-zinc-700 p-3 mb-3">
    <div class="ads-aside" class="w-full h-auto">
        <livewire:ads.display-ad :locationKey="'home_sidebar'" />
    </div>
    @if ($AsideCarousels->isNotEmpty()) 
        <div wire:ignore id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-[200px] overflow-hidden rounded-lg">
                <!-- Item 1 -->
                @foreach ($AsideCarousels as $AsideCarousel) 
                    <a href="{{ route('post.view', ['slug' => $AsideCarousel->slug]) }}" wire:navigate
                        class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/' . $AsideCarousel->featured_image) }}" alt="$AsideCarousel->title"
                             class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    </a>
                @endforeach
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 dark:bg-gray-800/30 group-hover:bg-gray-800/60 dark:group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 dark:bg-gray-800/30 group-hover:bg-gray-800/60 dark:group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    @endif

    <div wire:ignore class="border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-between text-gray-500 dark:text-gray-400"
            id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button
                    class="inline-flex items-center justify-center p-4 border-b-2 border-blue-600 rounded-t-lg active hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                    id="latestPosts-tab" data-tabs-target="#latestPosts" type="button" role="tab"
                    aria-controls="latestPosts" aria-selected="true">
                    সর্বশেষ
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-flex items-center justify-center p-4 border-b-2 border-blue-600 rounded-t-lg active hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500 group"
                    id="todayBest-tab" data-tabs-target="#todayBest" type="button" role="tab"
                    aria-controls="todayBest" aria-selected="false">
                    দিনের সেরা
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-flex items-center justify-center p-4 border-b-2 border-blue-600 rounded-t-lg active hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500 group"
                    id="weekBest-tab" data-tabs-target="#weekBest" type="button" role="tab"
                    aria-controls="weekBest" aria-selected="false">
                    সপ্তাহের সেরা
                </button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content" class="overflow-y-auto" wire:ignore>
        <div class="hidden p-4 my-1 border border-gray-300 rounded-lg bg-gray-50 dark:bg-zinc-900 dark:border-zinc-700"
            id="latestPosts" role="tabpanel" aria-labelledby="latestPosts-tab">
            <ul class="space-y-3 text-[13px] leading-snug text-[#333] max-h-[400px] overflow-y-auto">
                @if ($letetstPosts->isNotEmpty()) 
                    @foreach ($letetstPosts as $letetstPost)
                        <li class="flex items-start border-b-1 dark:border-zinc-700 py-2 space-x-2 rtl:space-x-reverse">
                            <i class="fas fa-play text-[#d00] mt-1"></i>
                            <a href="{{ route('post.view', ['slug' => $letetstPost->slug]) }}" wire:navigate>
                                <p class="line-clamp-2 max-h-min mb-1 dark:text-gray-300">
                                    {{ $letetstPost->title }}
                                </p>
                                <p class="text-[11px] dark:text-gray-400">
                                    <i class="far fa-clock text-gray-500"></i>
                                    {{ $this->getBengaliTimeAgo($letetstPost->published_at) }} | <span
                                        class="text-[#d00]">{{ $letetstPost->category?->name ?? 'Uncategorized'
                                        }}</span>
                                </p>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="text-center text-gray-500">কোনো পোস্ট নেই</li>
                @endif
            </ul>
        </div>
        <div class="hidden p-4 my-1 border border-gray-300 rounded-lg bg-gray-50 dark:bg-zinc-900 dark:border-zinc-700"
            id="todayBest" role="tabpanel" aria-labelledby="todayBest-tab">
            <ul class="space-y-3 text-[13px] leading-snug text-[#333] max-h-[400px] overflow-y-auto">
                @if ($todayBestPosts->isNotEmpty()) 
                    @foreach ($todayBestPosts as $todayBestPost)
                        <li class="flex items-start border-b-1 dark:border-zinc-700 py-2 space-x-2 rtl:space-x-reverse">
                            <i class="fas fa-play text-[#d00] mt-1"></i>
                            <a href="{{ route('post.view', ['slug' => $todayBestPost->slug]) }}" wire:navigate>
                                <p class="line-clamp-2 max-h-min mb-1 dark:text-gray-300">
                                    {{ $todayBestPost->title }}
                                </p>
                                <p class="text-[11px] dark:text-gray-400">
                                    <i class="far fa-clock text-gray-500"></i>
                                    {{ $this->getBengaliTimeAgo($todayBestPost->published_at) }} | <span
                                        class="text-[#d00]">{{ $todayBestPost->category?->name ?? 'Uncategorized'
                                        }}</span>
                                </p>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="text-center text-gray-500">কোনো পোস্ট নেই</li>
                @endif
            </ul>
        </div>
        <div class="hidden p-4 my-1 border border-gray-300 rounded-lg bg-gray-50 dark:bg-zinc-900 dark:border-zinc-700"
            id="weekBest" role="tabpanel" aria-labelledby="weekBest-tab">
            <ul class="space-y-3 text-[13px] leading-snug text-[#333] max-h-[400px] overflow-y-auto dark:border-zinc-700">
                @if ($weekBestPosts->isNotEmpty()) 
                    @foreach ($weekBestPosts as $weekBestPost)
                        <li class="flex items-start border-b-1 dark:border-zinc-700 py-2 space-x-2 rtl:space-x-reverse">
                            <i class="fas fa-play text-[#d00] mt-1"></i>
                            <a href="{{ route('post.view', ['slug' => $weekBestPost->slug]) }}" wire:navigate>
                                <p class="line-clamp-2 max-h-min mb-1 dark:text-gray-300">
                                    {{ $weekBestPost->title }}
                                </p>
                                <p class="text-[11px] dark:text-gray-400">
                                    <i class="far fa-clock text-gray-500"></i>
                                    {{ $this->getBengaliTimeAgo($weekBestPost->published_at) }} | <span
                                        class="text-[#d00]">{{ $weekBestPost->category?->name ?? 'Uncategorized'
                                        }}</span>
                                </p>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="text-center text-gray-500">কোনো পোস্ট নেই</li>
                @endif
            </ul>
        </div>
    </div>
</aside>