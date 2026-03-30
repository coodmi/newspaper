<footer class="bg-white dark:bg-zinc-900 text-gray-600 dark:text-gray-400 text-sm border-t border-gray-200 dark:border-zinc-700">

    {{-- Top accent bar --}}
    <div class="h-0.5 w-full bg-orange-500 opacity-80"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 pt-10 pb-8">

        {{-- Main grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-10 pb-10 border-b border-gray-100 dark:border-zinc-700">

            {{-- Col 1: Brand + App + Social --}}
            <div class="col-span-2 sm:col-span-1 space-y-5">

                {{-- Logo --}}
                @if (!empty($website) && !empty($website->logo))
                    <a href="{{ url('/') }}" wire:navigate>
                        <img src="{{ asset('storage/' . $website->logo) }}"
                             alt="{{ $website->title ?? 'Logo' }}"
                             class="h-9 w-auto object-contain max-w-[140px] dark:brightness-90">
                    </a>
                @else
                    <span class="text-gray-900 dark:text-white font-bold text-lg tracking-tight">
                        {{ $website->title ?? 'News Portal' }}
                    </span>
                @endif

                {{-- App Buttons --}}
                <div>
                    <p class="text-[10px] uppercase tracking-widest text-gray-400 dark:text-zinc-500 mb-2 font-semibold">অ্যাপ ডাউনলোড</p>
                    <div class="flex flex-col gap-2">
                        <a href="#" aria-label="Get it on Google Play"
                            class="inline-flex items-center gap-2 bg-gray-900 dark:bg-zinc-800 hover:bg-gray-700 dark:hover:bg-zinc-700 border border-transparent dark:border-zinc-600 rounded-lg px-3 py-1.5 transition-all duration-200 w-full">
                            <svg viewBox="0 0 24 24" class="w-4 h-4 shrink-0" fill="none">
                                <path d="M3.18 1.07C2.47 1.46 2 2.22 2 3.1v17.8c0 .88.47 1.64 1.18 2.03l.1.06 9.97-9.97v-.24L3.28 1.01l-.1.06z" fill="#EA4335"/>
                                <path d="M16.58 16.35l-3.32-3.33v-.24l3.33-3.33.07.04 3.95 2.24c1.13.64 1.13 1.69 0 2.33l-3.95 2.25-.08.04z" fill="#FBBC04"/>
                                <path d="M16.66 16.31L13.25 12.9 3.18 23c.37.4.94.64 1.58.57a2.1 2.1 0 001.1-.43l10.8-6.83z" fill="#34A853"/>
                                <path d="M16.66 9.69L5.86 2.86A2.1 2.1 0 004.76 2.4c-.64-.07-1.21.17-1.58.57l10.07 10.1 3.41-3.38z" fill="#4285F4"/>
                            </svg>
                            <div class="leading-tight">
                                <div class="text-[7px] uppercase tracking-wider text-gray-400">Get it on</div>
                                <div class="text-[11px] font-semibold text-white">Google Play</div>
                            </div>
                        </a>
                        <a href="#" aria-label="Download on the App Store"
                            class="inline-flex items-center gap-2 bg-gray-900 dark:bg-zinc-800 hover:bg-gray-700 dark:hover:bg-zinc-700 border border-transparent dark:border-zinc-600 rounded-lg px-3 py-1.5 transition-all duration-200 w-full">
                            <svg viewBox="0 0 24 24" class="w-4 h-4 shrink-0" fill="white">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98l-.09.06c-.22.14-2.18 1.27-2.16 3.8.03 3.02 2.65 4.03 2.68 4.04l-.07.28zM13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                            </svg>
                            <div class="leading-tight">
                                <div class="text-[7px] uppercase tracking-wider text-gray-400">Download on the</div>
                                <div class="text-[11px] font-semibold text-white">App Store</div>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Social --}}
                <div>
                    <p class="text-[10px] uppercase tracking-widest text-gray-400 dark:text-zinc-500 mb-2 font-semibold">অনুসরণ করুন</p>
                    <div class="flex items-center gap-2">
                        <a href="{{ $website->facebook_url ?? '#' }}" aria-label="Facebook" target="_blank"
                            class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-100 dark:bg-zinc-800 hover:bg-[#1877f2] border border-gray-200 dark:border-zinc-700 hover:border-[#1877f2] transition-all duration-200 text-gray-500 dark:text-zinc-400 hover:text-white">
                            <i class="fab fa-facebook-f" style="font-size:10px;"></i>
                        </a>
                        <a href="{{ $website->twitter_url ?? '#' }}" aria-label="Twitter" target="_blank"
                            class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-100 dark:bg-zinc-800 hover:bg-black border border-gray-200 dark:border-zinc-700 hover:border-black transition-all duration-200 text-gray-500 dark:text-zinc-400 hover:text-white">
                            <i class="fab fa-twitter" style="font-size:10px;"></i>
                        </a>
                        <a href="{{ $website->instagram_url ?? '#' }}" aria-label="Instagram" target="_blank"
                            class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-100 dark:bg-zinc-800 hover:bg-[#e4405f] border border-gray-200 dark:border-zinc-700 hover:border-[#e4405f] transition-all duration-200 text-gray-500 dark:text-zinc-400 hover:text-white">
                            <i class="fab fa-instagram" style="font-size:10px;"></i>
                        </a>
                        <a href="{{ $website->youtube_url ?? '#' }}" aria-label="YouTube" target="_blank"
                            class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-100 dark:bg-zinc-800 hover:bg-[#ff0000] border border-gray-200 dark:border-zinc-700 hover:border-[#ff0000] transition-all duration-200 text-gray-500 dark:text-zinc-400 hover:text-white">
                            <i class="fab fa-youtube" style="font-size:10px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Col 2: Latest News --}}
            <div>
                <h3 class="text-gray-900 dark:text-white font-bold text-xs uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-0.5 h-3.5 bg-orange-500 rounded-full inline-block"></span>
                    আজকের পত্রিকা
                </h3>
                <ul class="space-y-2">
                    @php $allPosts = collect(); @endphp
                    @if (!empty($letestPosts) && $letestPosts->isNotEmpty())
                        @php $allPosts = $allPosts->merge($letestPosts); @endphp
                    @endif
                    @if (!empty($letestPosts2) && $letestPosts2->isNotEmpty())
                        @php $allPosts = $allPosts->merge($letestPosts2); @endphp
                    @endif
                    @foreach ($allPosts->take(5) as $post)
                        <li class="border-b border-gray-100 dark:border-zinc-800 pb-2 last:border-0 last:pb-0">
                            <a href="{{ route('post.view', ['slug' => $post->slug]) }}" wire:navigate
                                class="text-gray-500 dark:text-zinc-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors duration-150 leading-snug line-clamp-2 text-xs">
                                {{ $post->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Col 3: Categories --}}
            <div>
                <h3 class="text-gray-900 dark:text-white font-bold text-xs uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-0.5 h-3.5 bg-orange-500 rounded-full inline-block"></span>
                    বিভাগ
                </h3>
                <ul class="grid grid-cols-2 gap-x-3 gap-y-2">
                    @if (!empty($category) && $category->isNotEmpty())
                        @foreach ($category->take(10) as $ctgy)
                            <li>
                                <a href="{{ route('search.category', ['searchQuery' => $ctgy->slug]) }}" wire:navigate
                                    class="text-gray-500 dark:text-zinc-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors duration-150 flex items-center gap-1.5 text-xs">
                                    <span class="w-1 h-1 rounded-full bg-orange-400 shrink-0"></span>
                                    {{ $ctgy->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Col 4: Quick Links + Ad --}}
            <div class="space-y-6">
                <div>
                    <h3 class="text-gray-900 dark:text-white font-bold text-xs uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="w-0.5 h-3.5 bg-orange-500 rounded-full inline-block"></span>
                        দ্রুত লিংক
                    </h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('page.about') }}" wire:navigate class="text-gray-500 dark:text-zinc-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors flex items-center gap-1.5 text-xs"><span class="text-orange-400">›</span> আমাদের সম্পর্কে</a></li>
                        <li><a href="{{ route('page.contact') }}" wire:navigate class="text-gray-500 dark:text-zinc-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors flex items-center gap-1.5 text-xs"><span class="text-orange-400">›</span> যোগাযোগ করুন</a></li>
                        <li><a href="{{ route('page.privacy') }}" wire:navigate class="text-gray-500 dark:text-zinc-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors flex items-center gap-1.5 text-xs"><span class="text-orange-400">›</span> গোপনীয়তা নীতি</a></li>
                        <li><a href="{{ route('page.terms') }}" wire:navigate class="text-gray-500 dark:text-zinc-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors flex items-center gap-1.5 text-xs"><span class="text-orange-400">›</span> শর্তাবলী</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-gray-900 dark:text-white font-bold text-xs uppercase tracking-widest mb-3 flex items-center gap-2">
                        <span class="w-0.5 h-3.5 bg-orange-500 rounded-full inline-block"></span>
                        বিজ্ঞাপন
                    </h3>
                    <a href="{{ route('page.contact') }}" wire:navigate
                        class="inline-flex items-center gap-1.5 text-xs text-orange-500 hover:text-orange-600 border border-orange-200 dark:border-orange-900 hover:border-orange-400 rounded-lg px-3 py-2 transition-all duration-200 bg-orange-50 dark:bg-orange-950/30 hover:bg-orange-100 dark:hover:bg-orange-950/50">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        বিজ্ঞাপন দিন
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="pt-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-400 dark:text-zinc-500">
            <p class="select-text">
                সম্পাদক : <span class="text-gray-600 dark:text-zinc-300 font-medium">{{ $website->editor ?? 'demo editor' }}</span>
            </p>
            <p class="text-center select-text">
                স্বত্ব © {{ now()->year }}
                <span class="text-gray-600 dark:text-zinc-300 font-medium">{{ $website->title ?? 'News Portal' }}</span>
                — সর্বস্বত্ব সংরক্ষিত
            </p>
        </div>
    </div>
</footer>
