<div>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           {{ $adSlot->exists ? 'Edit Ad Slot' : 'Create New Ad Slot' }}
       </h2>
   </x-slot>

   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                   <form wire:submit="save">
                       <div class="grid grid-cols-1 gap-6">
                           <div>
                               <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Name</label>
                               <input type="text" id="name" wire:model="name" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                               @error('name') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                           </div>

                           <div>
                               <label for="location_key" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Location Key</label>
                               <input type="text" id="location_key" wire:model="location_key" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                               <p class="text-xs text-gray-500 mt-1">Use only lowercase letters, numbers, and underscores (e.g., home_sidebar_ad).</p>
                               @error('location_key') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                           </div>

                           <div>
                               <label for="ad_type" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ad Type</label>
                               <select id="ad_type" wire:model.live="ad_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                   <option value="google">Google Ad</option>
                                   <option value="personal">Personal Ad</option>
                               </select>
                               @error('ad_type') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                           </div>

                           @if ($ad_type === 'google')
                               <div wire:key="google-ad-code-wrapper">
                                   <label for="google_ad_code" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Google Ad Code</label>
                                   <textarea id="google_ad_code" wire:model="google_ad_code" rows="6" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                   @error('google_ad_code') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                               </div>
                           @endif

                           <div class="block">
                               <label for="is_active" class="flex items-center">
                                   <input id="is_active" type="checkbox" wire:model="is_active" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                   <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
                               </label>
                           </div>
                       </div>

                       <div class="flex items-center justify-end mt-6">
                           <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                               Save
                           </button>
                       </div>
                   </form>

               </div>
           </div>
       </div>
   </div>
</div>