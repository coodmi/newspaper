<div>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           {{ __('Google AdSense Settings') }}
       </h2>
   </x-slot>

   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900 dark:text-gray-100">

                   <form wire:submit="save">
                       <div>
                           <label for="publisher_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">AdSense Publisher ID</label>
                           <input type="text" id="publisher_id" wire:model="publisher_id" placeholder="ca-pub-xxxxxxxxxxxxxxxx" class="block mt-1 w-full md:w-1/2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                           <p class="text-xs text-gray-500 mt-1">Enter your full Google AdSense Publisher ID.</p>
                           @error('publisher_id') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                       </div>

                       <div class="flex items-center justify-start mt-6">
                           <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                               Save Settings
                           </button>
                       </div>
                   </form>

               </div>
           </div>
       </div>
   </div>
</div>