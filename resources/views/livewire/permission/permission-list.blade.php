<div>
    <div class="py-4">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
 
             <div class="mb-4">
                <input wire:model.live="search" type="text" placeholder="Search permissions..."
                   class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600">
             </div>
 
             <div class="mb-4">
                <form wire:submit="create" class="space-y-4">
                   <div>
                      <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                      <input wire:model="name" type="text" id="name"
                         class="mt-1 block w-full rounded-md dark:bg-zinc-700 dark:border-zinc-600 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                   </div>
 
                   <div>
                      <label for="guard_name" class="block text-sm font-medium text-gray-700">Guard Name</label>
                      <input wire:model="guard_name" type="text" id="guard_name"
                         class="mt-1 block w-full rounded-mddark:bg-zinc-700 dark:border-zinc-600 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      @error('guard_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                   </div>
 
                   {{-- <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                      Create Permission
                   </button> --}}
                   <flux:button type="submit"
                                variant="primary"
                                icon="plus"
                   >
                   Create Permission
                   </flux:button>
                </form>
             </div>
 
             <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                   <thead class="bg-gray-50 dark:bg-zinc-700 ">
                      <tr>
                         <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                         </th>
                         <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guard
                         </th>
                         <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                      </tr>
                   </thead>
                   <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-600 dark:border-zinc-600">
                      @foreach($permissions as $permission)
                      <tr>
                         <td class="px-6 py-4 whitespace-nowrap">
                            @if($editingPermissionId === $permission->id)
                            <input wire:model="name" type="text" class="w-full px-2 py-1 border rounded">
                            @else
                            {{ $permission->name }}
                            @endif
                         </td>
                         <td class="px-6 py-4 whitespace-nowrap">
                            @if($editingPermissionId === $permission->id)
                            <input wire:model="guard_name" type="text" class="w-full px-2 py-1 border rounded">
                            @else
                            {{ $permission->guard_name }}
                            @endif
                         </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($editingPermissionId === $permission->id)
                            <button wire:click="update" class="text-indigo-600 hover:text-indigo-900 mr-3">Save</button>
                            <button wire:click="$set('editingPermissionId', null)"
                               class="text-gray-600 hover:text-gray-900">Cancel</button>
                            @else
                            <button wire:click="edit({{ $permission->id }})"
                               class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $permission->id }})" class="text-red-600 hover:text-red-900"
                               onclick="return confirm('Are you sure?')">Delete</button>
                            @endif
                         </td>
                      </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>
 
             <div class="mt-4">
                {{ $permissions->links() }}
             </div>
          </div>
       </div>
    </div>
</div>