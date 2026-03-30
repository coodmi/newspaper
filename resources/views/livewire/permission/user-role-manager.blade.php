<div>
   <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white dark:bg-zinc-700 border dark:border-zinc-600 overflow-hidden shadow-xl sm:rounded-lg p-6">
            @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
               role="alert">
               <span class="block sm:inline">{{ session('message') }}</span>
            </div>
            @endif

            <div class="mb-4">
               <input wire:model.live="search" type="text" placeholder="Search users..."
                  class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-600 dark:border-zinc-600">
            </div>

            <div class="overflow-x-auto rounded-lg">
               <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                  <thead class="bg-gray-50 dark:bg-zinc-600">
                     <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Actions</th>
                     </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-800 dark:divide-zinc-700">
                     @foreach($users as $user)
                     <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                           @if($editingUserId === $user->id)
                           <div class="grid grid-cols-2 gap-2">
                              @foreach($roles as $role)
                              <div class="flex items-center">
                                 <input wire:model="selectedRoles" type="checkbox" id="{{ $role->id }}" value="{{ $role->id }}"
                                    class="h-4 w-4 dark:text-gray-400 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                 <label class="ml-2 block text-sm text-gray-900 dark:text-gray-300" for="{{ $role->id }}">
                                    {{ $role->name }}
                                 </label>
                              </div>
                              @endforeach
                           </div>
                           @else
                           <div class="flex flex-wrap gap-1">
                              @foreach($user->roles as $role)
                              {{-- <span
                                 class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                 {{ $role->name }}
                              </span> --}}
                              <flux:badge color="lime">{{ $role->name }}</flux:badge>
                              @endforeach
                           </div>
                           @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                           @if($editingUserId === $user->id)
                           <button wire:click="update" class="text-indigo-600 hover:text-indigo-900 mr-3">Save</button>
                           <button wire:click="cancel" class="text-gray-600 hover:text-gray-900">Cancel</button>
                           @else
                           {{-- <button wire:click="edit({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">Edit
                              Roles</button> --}}

                              <flux:button wire:click="edit({{ $user->id }})"
                                 icon="pencil-square"
                                 wire:navigate
                                 class="mr-2"
                    >
                    </flux:button>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>

            <div class="mt-4">
               {{ $users->links() }}
            </div>
         </div>
      </div>
   </div>
</div>