<div class="grid grid-cols-2 md:grid-cols-4 gap-2 p-2 mb-3">
    {{-- s4 --}}
    @foreach ($section4 as $s4)
    <div x-data="{ ready: false }" x-init="setTimeout(() => ready = true, 500)">

        {{-- Placeholder Skeleton --}}
        <template x-if="!ready">
            <div class="p-1 sm:p-2">
                <div class="bg-white border border-gray-200 rounded shadow animate-pulse">
                    <div class=" h-40 bg-gray-300 rounded-t"></div>
                    <div class="px-2 py-1 space-y-2">
                        <div class="h-4 bg-gray-300 rounded w-11/12"></div>
                        <div class="h-4 bg-gray-300 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-300 rounded w-2/3"></div>
                    </div>
                </div>
            </div>
        </template>

        {{-- Actual Post --}}
        <template x-if="ready">


            <div class="p-1">
                <div
                    class="bg-white border border-gray-200 rounded shadow-md hover:bg-gray-100 dark:bg-zinc-800 dark:border-zinc-700 dark:hover:bg-zinc-700">
                    <a href="{{ route('post.view', ['slug' => $s4->slug]) }}" wire:navigate>
                        <div class="h-[50%]">
                            <img src="{{ asset('storage/' . $s4->featured_image) }}" alt="" class="w-full h-auto ">
                        </div>
                        <div class="px-2 py-1">
                            <p class="line-clamp-2 dark:text-gray-300">{{ $s4->title }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </template>
    </div>
    @endforeach
</div>