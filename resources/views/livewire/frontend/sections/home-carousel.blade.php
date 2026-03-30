<section>
    @if ($HomeCarousels->isNotEmpty())

        {{-- <div class="swiper home-autoplay-carousel swiper-hidden px-4 py-1 rounded bg-[#e8f1ff] dark:bg-gray-900">

            <div class="swiper-wrapper">
                @foreach ($HomeCarousels as $HomeCarousel)
                <div class="swiper-slide p-2">
                    <div
                        class="bg-white border border-gray-200 rounded hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <a href="{{ route('post.view', ['slug' => $HomeCarousel->slug]) }}" wire:navigate
                            onclick="window.Livewire.navigate(this.href); return false;">
                            <div class="h-[50%] border-b">
                                <img src="{{ asset('storage/' . $HomeCarousel->featured_image) }}"
                                    alt="{{ $HomeCarousel->title }}" class="w-full h-auto">
                            </div>
                            <div class="px-2 py-1">
                                <p class="line-clamp-2 dark:text-gray-300">
                                    {{ $HomeCarousel->title }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div> --}}
        <div
            class="swiper swiper-hidden home-autoplay-carousel relative px-4 py-1 rounded bg-[#e8f1ff] dark:bg-gray-900 group">

            <div class="swiper-wrapper">
                @foreach ($HomeCarousels as $HomeCarousel)
                    <div class="swiper-slide p-2">
                        <div class="p-1.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100
                                   dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <a href="{{ route('post.view', ['slug' => $HomeCarousel->slug]) }}" wire:navigate
                                onclick="window.Livewire.navigate(this.href); return false;">
                                <div class="h-[50%] border-b">
                                    <img src="{{ asset('storage/' . $HomeCarousel->featured_image) }}"
                                        alt="{{ $HomeCarousel->title }}" class="w-full h-auto rounded">
                                </div>
                                <div class="px-2 py-1">
                                    <p class="line-clamp-2 dark:text-gray-300">
                                        {{ $HomeCarousel->title }}
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

    @else
        <div>

        </div>
    @endif
</section>