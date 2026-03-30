<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <div class="flex items-center gap-4 w-auto">
                <h2 class="text-2xl font-bold">Categories</h2>
            </div>
            <div class="flex items-center gap-4 max-w-1/2 w-auto sm:w-full">
                <div class="relative flex-1 sm:w-full">
                    <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Search orders"/>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('categories.create') }}"
                             variant="primary"
                             icon="plus"
                             wire:navigate
                >
                    Add New Category
                </flux:button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 dark:border-zinc-700 rounded-lg border mb-2.5">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50  dark:bg-zinc-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400  uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->slug }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $category->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                            <flux:button href="{{ route('categories.edit', $category->id) }}"
                                         {{-- variant="filled" --}}
                                         icon="pencil-square"
                                         wire:navigate
                                         class="mr-2"
                            >
                            </flux:button>
                            <flux:button variant="danger"
                                         icon="trash"
                                         wire:click="delete({{ $category->id }})"
                                         wire:confirm="Are you sure you want to delete this category?"
                            >
                            </flux:button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links("pagination::tailwind") }}
    </div>
</div>
