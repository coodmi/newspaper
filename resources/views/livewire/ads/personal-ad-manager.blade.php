<div>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           {{ __('Manage Personal Ads for: ') }} <span class="text-indigo-500">{{ $adSlot->name }}</span>
       </h2>
   </x-slot>

   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
           
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900 dark:text-gray-100">
                   <h3 class="text-lg font-medium mb-4">Upload New Personal Ad</h3>
                   <form wire:submit="save">
                       <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                           <div>
                               <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ad Title</label>
                               <input type="text" id="title" wire:model="title" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                               @error('title') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                           </div>

                           <div>
                               <label for="target_link" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Target Link (URL)</label>
                               <input type="url" id="target_link" wire:model="target_link" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                               @error('target_link') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                           </div>

                           <div class="col-span-2">
                               <label for="ad_image" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ad Image</label>
                               <small>
                                       Banner ad size: <span class="font-semibold">970x90</span> pixels
                                       or
                                       Normal ad size: <span class="font-semibold">300x250</span> pixels
                               </small>
                               {{-- <input type="file" id="ad_image" wire:model="ad_image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-200 dark:file:bg-gray-700 file:text-gray-700 dark:file:text-gray-200 hover:file:bg-gray-300"> --}}
                               <flux:input type="file" wire:model="ad_image" id="ad_image"/>
                               
                               <div wire:loading wire:target="ad_image" class="text-sm text-gray-500 mt-2">Uploading...</div>

                               @if ($ad_image)
                                   <div class="mt-4">
                                       <p class="text-sm font-medium">Image Preview:</p>
                                       <img src="{{ $ad_image->temporaryUrl() }}" class="mt-2 h-24 w-auto border rounded">
                                   </div>
                               @endif
                               @error('ad_image') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                           </div>
                       </div>

                       <div class="flex items-center justify-end mt-6">
                           <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                               Upload & Save Ad
                           </button>
                       </div>
                   </form>
               </div>
           </div>

           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900 dark:text-gray-100">
                   <h3 class="text-lg font-medium mb-4">Existing Ads for this Slot</h3>
                   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                       @forelse ($personalAds as $ad)
                           <div class="border dark:border-gray-700 rounded-lg p-4">
                               <img src="{{ asset('storage/' . $ad->ad_image) }}" alt="{{ $ad->title }}" class="w-full h-auto rounded-md mb-4">
                               <h4 class="font-semibold">{{ $ad->title }}</h4>
                               <p class="text-xs text-gray-500 truncate mb-4">Link: {{ $ad->target_link }}</p>
                               <button
                                   wire:click="delete({{ $ad->id }})"
                                   wire:confirm="Are you sure you want to delete this ad?"
                                   class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                   Delete
                               </button>
                           </div>
                       @empty
                           <p class="col-span-full text-center text-gray-500">No personal ads found for this slot.</p>
                       @endforelse
                   </div>
               </div>
           </div>

       </div>
   </div>
</div>