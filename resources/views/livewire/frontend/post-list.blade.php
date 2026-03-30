<div class="min-h-screen">
   <!-- Post Content -->
   <div class="container mx-auto flex flex-col lg:flex-row gap-4">
       <div class="md:w-[70%]">
         <div class="w-full min-h-screen mb-5 px-3 py-3 rounded-xl border bg-gray-50 dark:bg-zinc-800 dark:border-zinc-700 shadow-md">
            <h2 class="text-xl font-bold mb-4">Search results for "{{ $searchQuery }}"</h2>
            <div class="mb-3">
                <livewire:ads.display-ads-banner :locationKey="'category_banner'" />
            </div>
               <div class="grid grid-cols-2 md:grid-cols-3 w-full gap-2 p-2 mb-3">   
                  @forelse ($posts as $post)
                  <div 
                      x-data="{ ready: false }" 
                      x-init="setTimeout(() => ready = true, 1000)">
                      
                      {{-- Placeholder Skeleton --}}
                      <template x-if="!ready">
                          <div class="p-1 sm:p-2">
                              <div class="bg-white border border-gray-200 rounded shadow animate-pulse">
                                  <div class=" h-40 flex items-center justify-center bg-gray-300 rounded-t">
                                    <svg class="w-12 h-12 text-gray-200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512">
                                        <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z"></path>
                                    </svg>
                                  </div>
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
                          <div class="p-1 sm:p-2">
                              <div class="bg-white border border-gray-200 rounded hover:bg-zinc-100 hover:bg-zinc-100 dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-gray-600">
                                  <a href="{{ route('post.view', ['slug' => $post->slug]) }}" wire:navigate>
                                      <div class="h-[50%]">
                                          <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-t">
                                      </div>
                                      <div class="px-2 py-1">
                                          <p class="line-clamp-3 dark:text-gray-300">{{ $post->title }}</p>
                                      </div>
                                  </a>
                              </div>
                          </div>
                      </template>
              
                  </div>
              @empty
                  <p>No posts found.</p>
              @endforelse
               </div>
               @if ($hasMore)
                   <div class="max-w-40 mx-auto">
                       <flux:button wire:click="loadMore" wire:loading.attr="disabled" type="button" variant="filled" class="w-full border">
                           Load More
                       </flux:button>
                   </div>
               @endif
         </div>
       </div>

       <livewire:frontend.layouts.aside />
   </div>
</div>