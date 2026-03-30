
<div class="my-9 p-2 md:p-0">
    <div class="inline-flex items-center justify-center w-full">
        <hr class="w-full h-[4px] my-8 bg-gray-200 border-0 dark:bg-gray-700 rounded-lg">
        <span
            class="absolute px-3 font-semibold text-2xl text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white  dark:bg-zinc-900">{{ $cetagories }}</span>
    </div>
    <div class="flex flex-col lg:flex-row gap-6 my-4">
        <!-- Left column -->
        <div class="flex flex-col space-y-4 w-full lg:w-1/4">
            @foreach ($sportsLefts as $sportsLeft) 
                <a href="{{ route('post.view', ['slug' => $sportsLeft->slug]) }}" wire:navigate class="flex space-x-3 items-center" href="#">
                    <img alt="বাংলাদেশের ফেন টাইমআউট টার্গেট করেছিল তা জানেন না ম্যাথিউস"
                        class="max-w-30 h-auto object-cover flex-shrink-0" src="{{ asset('storage/' . $sportsLeft->featured_image) }}" alt="{{ $sportsLeft->title }}" />
                    <p class="text-sm  text-justify line-clamp-3 dark:text-gray-300">
                        {{ $sportsLeft->title }}
                    </p>
                </a>
                <hr class="border-gray-200 dark:border-zinc-700" />
            @endforeach
            
        </div>
        <!-- Center column -->
        <div class="w-full lg:w-1/2">
            @foreach ($sportsCenters as $sportsCenter) 
                <a href="{{ route('post.view', ['slug' => $sportsCenter->slug]) }}" wire:navigate>
                    <img src="{{ asset('storage/' . $sportsCenter->featured_image) }}" class="h-[83%] w-full object-cover"
                        alt="{{ $sportsCenter->title }}" />
                    <h3 class="mt-3 text-base font-semibold leading-tight text-justify dark:text-gray-300">
                        {{ $sportsCenter->title }}
                    </h3>
                    <article class="mt-1 text-sm text-gray-500 text-justify h-min overflow-hidden line-clamp-2">
                        {!! $sportsCenter->content !!}
                    </article>
                </a>
            @endforeach
        </div>

        <!-- Right column -->
        <div class="flex flex-col space-y-4 w-full lg:w-1/4">
            @foreach ($sportsRights as $sportsRight)
                <a class="flex space-x-3 items-center mb-[7px]" href="{{ route('post.view', ['slug' => $sportsRight->slug]) }}" wire:navigate>
                    <img alt="বাংলাদেশের ফেন টাইমআউট টার্গেট করেছিল তা জানেন না ম্যাথিউস"
                        class="max-w-30 h-auto object-cover flex-shrink-0" src="{{ asset('storage/' . $sportsRight->featured_image) }}" alt="{{ $sportsRight->title }}" />
                    <p class="text-sm text-justify line-clamp-3  dark:text-gray-300">
                        {{ $sportsRight->title }}
                    </p>
                </a>
                <hr class="border-gray-200 mb-[7px] dark:border-zinc-700" />
            @endforeach
            <div class="ads-aside" class="max-w-full h-auto">
                <livewire:ads.display-ad :locationKey="'home_cetagory'" />
            </div>
        </div>
    </div>
</div>