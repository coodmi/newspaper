<div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-10">
    @foreach ($section2 as $s2)
    <div 
        x-data="{ ready: false }" 
        x-init="setTimeout(() => ready = true, 1000)"
        class="">
        
        {{-- Placeholder Skeleton --}}
        <template x-if="!ready">
            <div class="p-1.5 bg-white border border-gray-200 rounded-lg shadow-sm animate-pulse">
                <div class="w-full h-[120px] flex items-center justify-center bg-gray-300 rounded mb-2">
                    <svg class="w-12 h-12 text-gray-200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512">
                        <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z">
                            </path>
                    </svg>
                </div>
                <div class="h-4 bg-gray-300 rounded w-5/6 mb-1"></div>
                <div class="h-4 bg-gray-300 rounded w-4/6"></div>
            </div>
        </template>

        {{-- Actual Post --}}
        <template x-if="ready">
            <a href="{{ route('post.view', ['slug' => $s2->slug]) }}" wire:navigate
                class=" block p-1.5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-zinc-800 dark:border-zinc-700 dark:hover:bg-zinc-700">
                <img src="{{ asset('storage/' . $s2->featured_image) }}" alt="{{  $s2->title }}" class="rounded mb-1">
                <h5 class="mt-1.5 text-base line-clamp-2 tracking-tight text-gray-900  dark:text-gray-300">
                    {{ $s2->title }}
                </h5>
            </a>
        </template>
    </div>
    @endforeach
</div>
