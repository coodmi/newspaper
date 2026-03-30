<div>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           {{ __('Ad Slot Management') }}
       </h2>
   </x-slot>

   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                   <div class="flex justify-end mb-4">
                       <a href="{{ route('admin.ads.slots.create') }}" wire:navigate class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                           Create New Ad Slot
                       </a>
                   </div>

                   <div class="overflow-x-auto">
                       <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                           <thead class="bg-gray-50 dark:bg-gray-700">
                               <tr>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location Key</th>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                   <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                               </tr>
                           </thead>
                           <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                               @forelse ($adSlots as $slot)
                                   <tr>
                                       <td class="px-6 py-4 whitespace-nowrap">{{ $slot->name }}</td>
                                       <td class="px-6 py-4 whitespace-nowrap font-mono text-sm">{{ $slot->location_key }}</td>
                                       <td class="px-6 py-4 whitespace-nowrap">
                                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $slot->ad_type == 'google' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                               {{ ucfirst($slot->ad_type) }}
                                           </span>
                                       </td>
                                       <td class="px-6 py-4 whitespace-nowrap">
                                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $slot->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                               {{ $slot->is_active ? 'Active' : 'Inactive' }}
                                           </span>
                                       </td>
                                       <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                           @if ($slot->ad_type == 'personal')
                                               {{-- <a href="{{ route('admin.ads.slots.personal-ads', $slot) }}" wire:navigate class="text-indigo-600 hover:text-indigo-900 mr-4">Manage Ads</a> --}}
                                               <flux:button href="{{ route('admin.ads.slots.personal-ads', $slot) }}" 
                                                            icon="pencil-square"
                                                            wire:navigate
                                                            class="mr-2">
                                                    Manage Ads
                                                </flux:button>
                                           @endif
                                           {{-- <a href="{{ route('admin.ads.slots.edit', $slot) }}" wire:navigate class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                           <flux:button href="{{ route('admin.ads.slots.edit', $slot) }}" 
                                                            icon="pencil-square"
                                                            wire:navigate
                                                            class="mr-2">
                                                    Edit
                                            </flux:button>
                                       </td>
                                   </tr>
                               @empty
                                   <tr>
                                       <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center">No Ad Slots found.</td>
                                   </tr>
                               @endforelse
                           </tbody>
                       </table>
                   </div>

               </div>
           </div>
       </div>
   </div>
</div>