<div>
   <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-5">

            <div class="mb-4">
               <input wire:model.live="search" type="text" placeholder="Search roles..."
                  class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-600 dark:border-zinc-600">
            </div>

            <div class="mb-4">
               <form wire:submit="create" class="space-y-4">
                  <div>
                     <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role Name</label>
                     <input wire:model="name" type="text" id="name"
                        class="mt-1 block w-full rounded-md dark:bg-zinc-600 dark:border-zinc-600  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                     @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                  </div>

                  <div>
                     <label for="guard_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guard Name</label>
                     <input wire:model="guard_name" type="text" id="guard_name"
                        class="mt-1 block w-full rounded-md dark:bg-zinc-600 dark:border-zinc-600 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                     @error('guard_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                  </div>

                  <div>
                     <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Permissions</label>
                     <div class="mt-2 flex gap-5 flex-wrap">
                        @foreach($permissions as $permission)
                        <div class="flex items-center">
                           <input wire:model="selectedPermissions" type="checkbox" id="{{ $permission->id }}" value="{{ $permission->id }}"
                              class="h-4 w-4 dark:text-gray-400 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                           <label class="ml-2 block text-sm text-gray-900 dark:text-gray-300" for="{{ $permission->id }}">
                              {{ $permission->name }}
                           </label>
                        </div>
                        @endforeach
                     </div>
                     @error('selectedPermissions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                  </div>

                  {{-- <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                     Create Role
                  </button> --}}
                  <flux:button type="submit"
                               variant="primary"
                               icon="plus"
                  >
                     Create Role
                  </flux:button>
               </form>
            </div>

         </div>
         
         <div class="bg-white  dark:bg-zinc-700 dark:border-zinc-600 overflow-hidden shadow-xl sm:rounded-lg p-6">

            <div class="overflow-x-auto">
               <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                  <thead class="bg-gray-50 dark:bg-zinc-600">
                     <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Guard
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                           Permissions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                           Actions</th>
                     </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-800 dark:divide-zinc-700">
                     @foreach($roles as $role)
                     <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                           @if($editingRoleId === $role->id)
                           <input wire:model="name" type="text" class="w-full px-2 py-1 border rounded">
                           @else
                           {{ $role->name }}
                           @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           @if($editingRoleId === $role->id)
                           <input wire:model="guard_name" type="text" class="w-full px-2 py-1 border rounded">
                           @else
                           {{ $role->guard_name }}
                           @endif
                        </td>
                        <td class="px-6 py-4">
                           @if($editingRoleId === $role->id)
                           <div class="grid grid-cols-2 gap-2">
                              @foreach($permissions as $permission)
                              <div class="flex items-center">
                                 <input wire:model="selectedPermissions" id="{{ $permission->id }}-2" type="checkbox" value="{{ $permission->id }}"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                 <label class="ml-2 block text-sm text-gray-900" for="{{ $permission->id }}-2">
                                    {{ $permission->name }}
                                 </label>
                              </div>
                              @endforeach
                           </div>
                           @else
                           <div class="flex flex-wrap gap-1">
                              @foreach($role->permissions as $permission)
                              {{-- <span
                                 class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                 {{ $permission->name }}
                              </span> --}}
                              <flux:badge color="lime">{{ $permission->name }}</flux:badge>
                              @endforeach
                           </div>
                           @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                           @if($editingRoleId === $role->id)
                           <button wire:click="update" class="text-indigo-600 hover:text-indigo-900 mr-3">Save</button>
                           <button wire:click="$set('editingRoleId', null)"
                              class="text-gray-600 hover:text-gray-900">Cancel</button>
                           @else
                           <button wire:click="edit({{ $role->id }})"
                              class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                           <button wire:click="delete({{ $role->id }})" class="text-red-600 hover:text-red-900"
                              onclick="return confirm('Are you sure?')">Delete</button>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>

            <div class="mt-4">
               {{ $roles->links() }}
            </div>
         </div>
      </div>
   </div>
</div>