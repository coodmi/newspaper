<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    @php
        $website = \App\Models\Website::first();
    @endphp
<head>
    @include('partials.head')

</head>

<body class="min-h-screen bg-zinc-100 dark:bg-zinc-800">

    @can('admin.panel')
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                @if (!empty($website) && !empty($website->logo))
                    <img src="{{ asset('storage/' . $website->logo) }}" alt="{{ $website->title }}" class=" w-18 h-auto">
                    <h1 class=" max-w-9/12">{{ $website->title }}</h1>
                @endif
            </a>

            <flux:navlist variant="outline">
                <!-- 1. Platform -->
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    @can('admin.panel')
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    @endcan
                    @can('user.edit')
                    <flux:navlist.item icon="users" :href="route('users.index')" :current="request()->routeIs('users.index')"
                        wire:navigate>{{ __('Users') }}</flux:navlist.item>
                    @endcan
                </flux:navlist.group>

                <!-- 2. Permissions -->
                @can('user.permission')
                    <flux:navlist.group expandable :expanded="request()->routeIs('permissions.*')" heading="Permissions"
                        class="lg:grid">
                        <flux:navlist.item icon="shield-check" :href="route('permissions.index')" :current="request()->routeIs('permissions.index')"
                            wire:navigate>{{ __('Permissions') }}</flux:navlist.item>
                        <flux:navlist.item icon="user-group" :href="route('permissions.roles.index')"
                            :current="request()->routeIs('permissions.roles.index')" wire:navigate>{{ __('Roles') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="user-circle" :href="route('permissions.user-roles.index')"
                            :current="request()->routeIs('permissions.user-roles.index')" wire:navigate>{{ __('User Roles') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                @endcan

                <!-- 3. Categories -->
                @can('categories.edit')
                    <flux:navlist.group expandable :expanded="request()->routeIs('categories.*')" heading="Categories"
                        class="lg:grid">
                        <flux:navlist.item icon="folder" :href="route('categories.index')" :current="request()->routeIs('categories.index')"
                            wire:navigate>{{__('All Categories') }}</flux:navlist.item>
                        <flux:navlist.item icon="plus-circle" :href="route('categories.create')" :current="request()->routeIs('categories.create')"
                            wire:navigate>{{ __('Create Category') }}</flux:navlist.item>
                    </flux:navlist.group>
                @endcan

                <!-- 4. Posts -->
                @canany(['post.maintenance', 'post.create', 'post.published', 'polls.edit', 'polls.create'])
                    <flux:navlist.group expandable :expanded="request()->routeIs('posts.*')" heading="Posts" class="lg:grid">
                        @can('post.maintenance')
                            <flux:navlist.item icon="document-text" :href="route('posts.index')" :current="request()->routeIs('posts.index')"
                                wire:navigate>{{ __('All Posts') }}</flux:navlist.item>
                        @endcan
                        @canany(['post.maintenance', 'post.create'])
                            <flux:navlist.item icon="plus" :href="route('posts.create')" :current="request()->routeIs('posts.create')"
                                wire:navigate>{{ __('Create Post') }}</flux:navlist.item>
                        @endcanany
                        @canany(['post.maintenance', 'post.published'])
                            <flux:navlist.item icon="check-circle" :href="route('posts.published')" :current="request()->routeIs('posts.published')"
                                wire:navigate>{{ __('Published Posts') }}</flux:navlist.item>
                        @endcanany
                        @canany(['post.maintenance', 'polls.create', 'polls.edit'])
                            <flux:navlist.item icon="chart-bar" :href="route('posts.polls.create')" :current="request()->routeIs('posts.polls.create')"
                                wire:navigate>{{ __('Create Poll') }}</flux:navlist.item>
                        @endcanany
                        @canany(['post.maintenance', 'polls.edit'])
                            <flux:navlist.item icon="chart-pie" :href="route('posts.polls.index')" :current="request()->routeIs('posts.polls.index')"
                                wire:navigate>{{ __('All Polls') }}</flux:navlist.item>
                        @endcanany
                    </flux:navlist.group>
                @endcanany

                <!-- 5. Advertisements -->
                @can('ads')
                        <flux:navlist.group expandable :expanded="request()->routeIs('admin.ads.*')" heading="Advertisements"
                            class="lg:grid">
                            <flux:navlist.item icon="megaphone" :href="route('admin.ads.slots.index')" :current="request()->routeIs('admin.ads.slots.index')"
                                wire:navigate>{{ __('Advertisements') }}</flux:navlist.item>
                            <flux:navlist.item icon="cog-6-tooth"
                                :href="route('admin.ads.settings')"
                                :current="request()->routeIs('admin.ads.settings')" wire:navigate>{{ __('AdSense Settings') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                @endcan

                <!-- 6. Website -->
                @can('website.maintenance')
                    <flux:navlist.group expandable :expanded="request()->routeIs('website.*')" heading="Website"
                        class="lg:grid">
                        <flux:navlist.item icon="information-circle" :href="route('website.index')" :current="request()->routeIs('website.index')"
                            wire:navigate>{{ __('Details') }}</flux:navlist.item>
                        <flux:navlist.item icon="photo" :href="route('website.logos')" :current="request()->routeIs('website.logos')"
                            wire:navigate>{{ __('Logo') }}</flux:navlist.item>
                    </flux:navlist.group>
                @endcan
            </flux:navlist>

            <flux:spacer />

            {{-- <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                    target="_blank">
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                    target="_blank">
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist> --}}

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile :name="auth()->user()?->name" :initials="auth()->user()?->initials()"
                    icon-trailing="chevrons-up-down" />

                <flux:menu class="w-[240px]">
                    {{-- User Info --}}
                    <div class="flex items-center gap-3 px-3 py-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 font-semibold text-sm dark:bg-indigo-900 dark:text-indigo-300">
                            {{ auth()->user()?->initials() }}
                        </span>
                        <div class="grid flex-1 text-start leading-tight">
                            <span class="truncate font-semibold text-sm text-gray-900 dark:text-white">{{ auth()->user()?->name }}</span>
                            <span class="truncate text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()?->email }}</span>
                        </div>
                    </div>

                    <flux:menu.separator />

                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Account Settings') }}
                    </flux:menu.item>

                    <flux:menu.separator />

                    <flux:menu.item
                        as="button"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950"
                        onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>

            <form id="sidebar-logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>
        </flux:sidebar>
    @endcan

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()?->initials()" icon-trailing="chevron-down" />

            <flux:menu class="w-[240px]">
                {{-- User Info --}}
                <div class="flex items-center gap-3 px-3 py-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 font-semibold text-sm dark:bg-indigo-900 dark:text-indigo-300">
                        {{ auth()->user()?->initials() }}
                    </span>
                    <div class="grid flex-1 text-start leading-tight">
                        <span class="truncate font-semibold text-sm text-gray-900 dark:text-white">{{ auth()->user()?->name }}</span>
                        <span class="truncate text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()?->email }}</span>
                    </div>
                </div>

                <flux:menu.separator />

                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                    {{ __('Account Settings') }}
                </flux:menu.item>

                <flux:menu.separator />

                <flux:menu.item
                    as="button"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950"
                    onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts

    {{--
    <livewire:partials.notifications /> --}}

    <script>
        // SweetAlert2
            window.addEventListener('notify', event => {
                Swal.fire({
                    title: event.detail.type == "success" ? "Success" : "Oops...",
                    text: event.detail.message,
                    icon: event.detail.type,
                    // timer: 1500

                });
            })
    </script>
</body>

</html>