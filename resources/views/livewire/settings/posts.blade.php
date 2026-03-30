<section class="w-full">
    @include('partials.settings-heading')

    <div class="flex items-start max-md:flex-col">
        <div class="me-10 w-full pb-4 md:w-[220px]">
            <flux:navlist>
                <flux:navlist.item :href="route('settings.profile')" wire:navigate>{{ __('Profile') }}
                </flux:navlist.item>
                <flux:navlist.item :href="route('settings.posts')" wire:navigate>{{ __('My Posts') }}
                </flux:navlist.item>
                <flux:navlist.item :href="route('settings.password')" wire:navigate>{{ __('Password') }}
                </flux:navlist.item>
                <flux:navlist.item :href="route('settings.appearance')" wire:navigate>{{ __('Appearance') }}
                </flux:navlist.item>
            </flux:navlist>
        </div>

        <flux:separator class="md:hidden" />

        <div class="flex-1 self-stretch max-md:pt-6">
            <flux:heading>{{ $heading ?? '' }}</flux:heading>
            <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

            <div class="mt-1 w-full max-w-7xl">
                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- Dashboard Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                        <div>
                            {{-- <h1 class="text-3xl font-bold text-slate-900">ড্যাশবোর্ড</h1> --}}
                            <p class="mt-1 text-slate-500">আপনার সকল কার্যক্রমের সারসংক্ষেপ।</p>
                        </div>
                        <div class="mt-4 sm:mt-0 flex items-center gap-2">
                             <a href="{{ route('posts.create') }}" wire:navigate class="px-8 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 flex items-center gap-2">
                                <!-- Plus Icon SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <span>
                                    নতুন পোস্ট
                                </span>
                            </a>
                        </div>
                    </div>
            
                    <!-- Stats Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        
                        <!-- Card 1: Published Posts -->
                        <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-slate-500 dark:text-slate-200">প্রকাশিত পোস্ট</p>
                                    <p class="text-3xl font-bold text-slate-900 mt-1 dark:text-white">{{ $this->formatToBengali($publishedPosts) }}</p>
                                </div>
                                 <div class="bg-green-100 p-3 rounded-full">
                                    <!-- CheckCircle Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2: Drafts -->
                        <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-slate-500 dark:text-slate-200">অপেক্ষমাণ পোস্ট</p>
                                    <p class="text-3xl font-bold text-slate-900 mt-1 dark:text-white">{{ $this->formatToBengali($pendingPosts) }}</p>
                                </div>
                                 <div class="bg-blue-100 p-3 rounded-full">
                                     <!-- Edit3 Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3: Total Posts -->
                        <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-slate-500 dark:text-slate-200">ড্রাফট পোস্ট</p>
                                    <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $this->formatToBengali($draftPosts) }}</p>
                                </div>
                                <div class="bg-amber-100 p-3 rounded-full">
                                    <!-- FileText Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-600"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4: Visitors -->
                        <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-slate-500 dark:text-slate-200">মোট ভিউ</p>
                                    <p class="text-md font-bold text-slate-900 dark:text-white mt-1">{{ $this->formatToBengali($totalView) }}</p>
                                </div>
                                 <div class="bg-red-100 p-3 rounded-full">
                                    <!-- Users Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-8 pt-2">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                            <div class="flex gap-2">
                                <flux:button href="{{ route('posts.polls.create') }}" variant="filled" icon="plus"
                                    wire:navigate>
                                    Add New Poll
                                </flux:button>
                            </div>
                            <div class="flex items-center gap-4 max-w-1/2 w-auto sm:w-full">
                                <div class="relative flex-1 sm:w-full">
                                    <flux:input wire:model.live="search" icon="magnifying-glass"
                                        placeholder="Search posts" />
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <flux:button href="{{ route('posts.create') }}" variant="primary" icon="plus"
                                    wire:navigate>
                                    Add New Post
                                </flux:button>
                            </div>
                        </div>

                        <div class="overflow-x-auto bg-white dark:bg-zinc-800 dark:border-zinc-700 rounded-lg border mb-2.5">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                                <thead class="bg-gray-50 dark:bg-zinc-700 dark:border-zinc-700">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Category</th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order</th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            View</th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Published</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-zinc-700 dark:bg-zinc-800 ">
                                    @if($posts->isNotEmpty())
                                    @foreach($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->id }}</td>
                                        <td class="px-6 py- text-center whitespace-nowrap">
                                            <a href="{{ route('post.view', ['slug' => $post->slug]) }}" wire:navigate
                                               class="hover:text-blue-500 hover:border-b-2 hover:border-blue-500">
                                                {{ Str::limit($post->title, 40, '...') }}</a>
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $post->category?->name ??
                                            'Uncategorized' }}</td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $this->convertToBengaliNumbers($post->section) }}</td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">{{ $this->convertToBengaliNumbers($post->view_count) }}</td>
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

            </div>
        </div>
</section>