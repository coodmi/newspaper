<section class="w-full">
    <nav class="mb-2 sticky top-0 z-50 bg-zinc-200 dark:bg-zinc-700 border-b border-zinc-200 dark:border-zinc-700">
        <flux:header container class="header-nav-main">
            <style>
                .header-nav-main > div{
                    padding: 0;
                }
                .header-nav-main  div  a div{
                    color: black !important;
                    color: var(--color-accent-content) !important;
                    padding: 0 !important;
                }
                .header-nav-main div a:hover div::after {
                    content: var(--tw-content);
                    background-color: var(--color-accent-content) !important;
                    height: 1px;
                    width: 100%;
                    position: absolute;
                    bottom: -12px;
                    left: 0;
                    transition: width 0.8s ease-in-out;
                }
                .header-nav-main div ui-dropdown button{
                    color: black ;
                    color: var(--color-accent-content) !important;
                }
            </style>
            <flux:modal.trigger name="menu-flyout" class="md:hidden">
                <flux:navbar.item icon="bars-3" label="menu-flyout" />
            </flux:modal.trigger>
            <flux:navbar style="" class="overflow-x-auto scrollbar-hidden max-w-10/12 hidden md:flex">
                <flux:navbar.item href="{{ route('home') }}" icon="home" wire:navigate ></flux:navbar.item>
                @foreach ($menuCategories as $category)
                    @if ($category->children->isNotEmpty())
                        <flux:dropdown class="max-lg:hidden">
                            <flux:navbar.item icon:trailing="chevron-down" class="m-0">
                                {{ $category->name }}
                            </flux:navbar.item>
                            <flux:navmenu>
                                @foreach ($category->children as $child)
                                    <flux:navmenu.item href="{{ route('search.category', ['searchQuery' => $child->slug]) }}" wire:navigate >{{ $child->name }}</flux:navmenu.item>
                                @endforeach
                            </flux:navmenu>
                        </flux:dropdown>
                    @else
                        <flux:navbar.item href="{{ route('search.category', ['searchQuery' => $category->slug]) }}" wire:navigate >{{ $category->name }}</flux:navbar.item>
                    @endif
                @endforeach
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-4">
                <div class="hidden md:block">
                    <flux:modal.trigger name="menu-flyout" class="">
                        <flux:navbar.item icon="bars-2" label="menu-flyout" />
                    </flux:modal.trigger>
                </div>
                <flux:modal.trigger name="search-nav">
                    <flux:navbar.item icon="magnifying-glass" label="Search" />
                </flux:modal.trigger>
            </flux:navbar>

            {{-- User Dropdown --}}
            <flux:dropdown position="bottom" align="end">

                @if (auth()->check() && auth()->user()->profile_image)
                    <button class="relative flex items-center justify-center w-9 h-9 rounded-full ring-2 ring-white/20 hover:ring-orange-400 transition-all duration-200 overflow-hidden focus:outline-none">
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-full h-full object-cover">
                    </button>
                @elseif (auth()->check())
                    <button class="flex items-center justify-center w-9 h-9 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm ring-2 ring-white/20 hover:ring-orange-400 transition-all duration-200 focus:outline-none">
                        {{ auth()->user()->initials() }}
                    </button>
                @else
                    <button class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-200 dark:bg-zinc-600 hover:bg-orange-100 dark:hover:bg-zinc-500 text-gray-500 dark:text-gray-300 ring-2 ring-transparent hover:ring-orange-400 transition-all duration-200 focus:outline-none">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                        </svg>
                    </button>
                @endif

                <flux:menu class="w-56 mt-1 shadow-xl rounded-xl border border-gray-100 dark:border-zinc-700 overflow-hidden">

                    @if (auth()->check())
                        {{-- Logged-in user info --}}
                        <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-zinc-800 border-b border-gray-100 dark:border-zinc-700">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                     class="w-9 h-9 rounded-full object-cover shrink-0" alt="">
                            @else
                                <span class="w-9 h-9 rounded-full bg-orange-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
                                    {{ auth()->user()->initials() }}
                                </span>
                            @endif
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <flux:menu.item icon="user-circle" :href="route('settings.profile')" wire:navigate>
                            {{ __('My Profile') }}
                        </flux:menu.item>

                        @can('admin.panel')
                            <flux:menu.item icon="squares-2x2" :href="route('dashboard')" wire:navigate>
                                {{ __('Dashboard') }}
                            </flux:menu.item>
                        @endcan

                        <flux:menu.separator />

                        <flux:menu.item
                            as="button"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950"
                            onclick="event.preventDefault(); document.getElementById('nav-logout-form').submit();">
                            {{ __('Log Out') }}
                        </flux:menu.item>

                    @else
                        {{-- Guest --}}
                        <div class="px-4 py-3 bg-gray-50 dark:bg-zinc-800 border-b border-gray-100 dark:border-zinc-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">আপনি লগইন করেননি</p>
                        </div>
                        <flux:menu.item icon="arrow-right-end-on-rectangle" :href="route('login')" wire:navigate>
                            {{ __('Login') }}
                        </flux:menu.item>
                    @endif

                </flux:menu>
            </flux:dropdown>

            <form id="nav-logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>
            
            <flux:modal name="search-nav" class="md:w-full max-w-1xl" variant="search">
                <div class="space-y-4">
                    <form wire:submit.prevent="searchPost" class="space-y-4">
                        <div>
                            <flux:heading size="lg">Write what you want to see</flux:heading>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <flux:input wire:model="searchQuery"
                                        type="search"
                                        kbd="⌘K" 
                                        icon="magnifying-glass" 
                                        placeholder="Search..."/>

                            <flux:error name="searchQuery" />
                        </div>
                        <div class="flex w-full">
                            <flux:button type="submit" variant="primary" class="w-full">Search</flux:button>
                        </div>
                    </form>
                </div>
            </flux:modal>
        </flux:header>
        
        <!-- Flyout Modal -->
        <flux:modal name="menu-flyout" variant="flyout" position="left" class="space-y-6  max-h-screen min-h-screen overflow-y-auto bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 p-4">
            <div>

                <div class="flex justify-between items-center">
                </div>

                <flux:navlist variant="outline">
                    @foreach ($menuCategories as $category)
                        @if ($category->children->isNotEmpty())
                            <flux:navlist.group expandable :expanded="false"  class="menu-flyout-nav" heading="{{ $category->name }}">
                                <style>
                                    .menu-flyout-nav button div{
                                        padding-inline-end: 5px;
                                    }
                                </style>
                                @foreach ($category->children as $child)
                                    <flux:navlist.item href="{{ route('search.category', ['searchQuery' => $child->slug]) }}" wire:navigate >{{ $child->name }}</flux:navlist.item>
                                @endforeach
                            </flux:navlist.group>
                        @else
                            <flux:navlist.item href="{{ route('search.category', ['searchQuery' => $category->slug]) }}" wire:navigate >{{ $category->name }}</flux:navlist.item>
                        @endif
                    @endforeach
                </flux:navlist>

                <flux:spacer />

                <flux:navlist variant="outline">
                    {{-- Uncomment or add extra static items --}}
                    {{-- <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item> --}}
                </flux:navlist>

            </div>
        </flux:modal>
    </nav>
    <livewire:ads.display-ads-banner :locationKey="'header_banner'" />
</section>