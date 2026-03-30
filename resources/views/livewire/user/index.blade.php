<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold">Users</h2>
            <div class="flex gap-2">
                {{-- <button wire:click="showCreateForm"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add User
                </button> --}}
                
                <flux:button wire:click="showCreateForm"
                             variant="primary"
                             icon="plus"
                             wire:navigate
                >
                    Add User
                </flux:button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-zinc-800 rounded-lg border dark:border-zinc-700 mb-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-800 dark:divide-zinc-700">
                    @foreach($users as $index => $u)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $u->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $u->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $u->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                {{-- <button wire:click="editUser({{ $u->id }})"
                                    class="text-yellow-500 hover:text-yellow-700">Edit</button> --}}
                                    <flux:button wire:click="editUser({{ $u->id }})"
                                         icon="pencil-square"
                                         class="mr-2"
                            >
                            </flux:button>
                                {{-- <button wire:click="deleteUser({{ $u->id }})"
                                    class="text-red-600 hover:text-red-800">Delete</button> --}}
                                    <flux:button variant="danger"
                                                 icon="trash"
                                                 wire:click="deleteUser({{ $u->id }})"
                                                 wire:confirm="Are you sure you want to delete this post?"
                                    >
                                    </flux:button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    @if($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-50  flex items-center justify-center z-50">
            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $user ? 'Edit User' : 'Add New User' }}
                </h2>

                <form wire:submit.prevent="{{ $user ? 'updateUser' : 'createUser' }}">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1 dark:text-gray-300">Name</label>
                            <input type="text" wire:model="name" class="w-full rounded border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-gray-300">
                            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        @if(!$user)
                        <div>
                            <label class="block text-sm font-medium mb-1 dark:text-gray-300">Username</label>
                            <input type="text" wire:model="username" class="w-full rounded border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-gray-300">
                            @error('username') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium mb-1 dark:text-gray-300">Email</label>
                            <input type="email" wire:model="email" class="w-full rounded border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-gray-300">
                            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1 dark:text-gray-300">Password</label>
                            <input type="password" wire:model="password" class="w-full rounded border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-gray-300">
                            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1 dark:text-gray-300">Confirm Password</label>
                            <input type="password" wire:model="password_confirmation" class="w-full rounded border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-gray-300">
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            {{-- <button type="button" wire:click="$set('showEditModal', false)"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button> --}}
                                <flux:button variant="filled"
                                             type="button" 
                                             wire:click="$set('showEditModal', false)"
                                             >
                                             Cencel
                                </flux:button>
                                
                            {{-- <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                {{ $user ? 'Update' : 'Create' }}
                            </button> --}}
                            <flux:button type="submit"
                                         variant="primary"
                            >
                            {{ $user ? 'Update' : 'Create' }}
                            </flux:button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
