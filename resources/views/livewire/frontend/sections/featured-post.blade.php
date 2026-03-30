<div class="lg:w-8/12 ">
    @if ($featuredPosts->isNotEmpty()) 
        @foreach ($featuredPosts as $featuredPost)
            <div 
                x-data="{ ready: false }" 
                x-init="setTimeout(() => ready = true, 1000)"
                class="flex flex-col-reverse sm:flex-row gap-2 w-full">
                
                {{-- Placeholder Skeleton --}}
                <template x-if="!ready">
                    <div class="flex flex-col-reverse sm:flex-row gap-2 lg:w-11/12 mb-1.5 p-2 animate-pulse border-b">
                        <div class="w-full md:w-2/5 flex flex-col justify-between gap-3">
                            <div class="h-6 bg-gray-300 rounded w-11/12"></div>
                            <div class="h-6 bg-gray-300 rounded w-11/12"></div>
                            <div class="h-5 bg-gray-300 rounded w-3/4"></div>
                            <div class="h-6 bg-gray-300 rounded w-11/12"></div>
                            <div class="h-5 bg-gray-300 rounded w-10/12"></div>
                            <div class="h-5 bg-gray-300 rounded w-3/4"></div>
                            <div class="h-6 bg-gray-300 rounded w-11/12"></div>
                            <div class="h-5 bg-gray-300 rounded w-3/4"></div>
                        </div>
                        <div class="w-full flex items-center justify-center md:w-[600px] h-[273px] bg-gray-300 rounded">
                            <svg class="w-12 h-12 text-gray-200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512">
                                <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z">
                                    </path>
                            </svg>
                        </div>
                    </div>
                </template>

                {{-- Actual Post --}}
                <template x-if="ready">
                    <a href="{{ route('post.view', ['slug' => $featuredPost->slug]) }}" wire:navigate
                        class="flex flex-col-reverse sm:flex-row gap-2">
                        <div class="w-full md:w-2/5 flex flex-col justify-between gap-2">
                            <h2 class="line-clamp-4 text-2xl text-blue-500 dark:text-blue-400">
                                {{ $featuredPost->title }}
                            </h2>
                            {{-- <h1 class="line-clamp-3 text-2xl">
                                {{ $featuredPost->summary }}
                            </h1> --}}
                            <p class="line-clamp-6 text-1xl dark:text-gray-400">
                                {{ $featuredPost->content }}
                            </p>
                        </div>
                        <div>
                            <img src="{{ asset('storage/' . $featuredPost->featured_image) }}"
                                alt="{{ $featuredPost->title }}" class="w-[600px] max-h-[273px] min-h-full object-cover rounded-lg">
                        </div>
                    </a>
                </template>
            </div>
        @endforeach
    @else
        <p class="text-center text-2xl font-bold">No posts found.</p>
    @endif
</div>