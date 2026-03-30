<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <div class="flex items-center gap-4 w-auto">
                <h2 class="text-2xl font-bold">Posts</h2>
            </div>
            <div class="flex items-center gap-4 max-w-1/2 w-auto sm:w-full">
                <div class="relative flex-1 sm:w-full">
                    <flux:input wire:model.live="search" icon="magnifying-glass" placeholder="Search posts" />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:button href="{{ route('posts.create') }}" variant="primary" icon="plus" wire:navigate>
                    Add New Post
                </flux:button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-zinc-800 dark:border-zinc-700 rounded-lg border mb-2.5">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-700">
                    <tr>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Category</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Order</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Published At</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-800 dark:divide-zinc-700">
                    @if($posts->isNotEmpty()) 
                        @foreach($posts as $post)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $this->convertToBengaliNumbers($post->id) }}</td>
                                <td class="px-6 py-2 whitespace-nowrap">{{ Str::limit($post->title, 40, '...') }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $post->category?->name ?? 'Uncategorized' }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $this->convertToBengaliNumbers($post->section) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($post->status === 'published') bg-green-100 text-green-800
                                        @elseif($post->status === 'draft') bg-gray-100 text-gray-800
                                        @elseif($post->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $this->getBengaliTimeAgo($post->published_at) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <flux:button href="{{ route('posts.edit', $post->id) }}" icon="pencil-square" wire:navigate
                                        class="mr-2">
                                    </flux:button>
                                    <flux:button variant="danger" icon="trash" wire:click="delete({{ $post->id }})"
                                        wire:confirm="Are you sure you want to delete this post?">
                                    </flux:button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">
                                No posts found.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{ $posts->links("pagination::tailwind") }}
    </div>
</div>