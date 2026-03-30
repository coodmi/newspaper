<div class="grid grid-cols-1pt-2 sm:pt-0 lg:w-4/12 max-w-full max-h-full">
    @foreach ($section1 as $s1)
    <div 
        x-data="{ ready: false }" 
        x-init="setTimeout(() => ready = true, 1000)"
        class=" min-w-full border-b-1 dark:border-zinc-700"
        >
        {{-- Placeholder Skeleton --}}
        <template x-if="!ready" class="min-w-full">
            <div class="flex justify-between items-center gap-2 border-b-1 max-h-min min-w- m-0 p-1 sm:p-2 animate-pulse">
                <div class="flex-3/4 space-y-2">
                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                    <div class="h-4 bg-gray-300 rounded w-5/6"></div>
                </div>
                <div class="w-[150px] h-[75px] flex items-center justify-center bg-gray-300 rounded">
                    <svg class="w-12 h-12 text-gray-200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512">
                        <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z"></path>
                    </svg>
                </div>
            </div>
        </template>

        {{-- Actual Post --}}
        <template x-if="ready">
            <a href="{{ route('post.view', ['slug' => $s1->slug]) }}" wire:navigate 
                class="flex justify-between items-center gap-2 max-h-min mt-[8px]">
                <h5
                    class="mb-2 w-50 leading-[24px] flex-3/4 text-base line-clamp-3 tracking-tight text-gray-900  dark:text-gray-400 overflow-hidden max-h-[70px]">
                    {{ $s1->title }}
                </h5>
                <img src="{{ asset('storage/' . $s1->featured_image) }}" alt="{{ $s1->title }}"
                    class="mb-2 max-w-30 max-h-[75px] border rounded-sm">
            </a>
        </template>
    </div>
    @endforeach
</div>