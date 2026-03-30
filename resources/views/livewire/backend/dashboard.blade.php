
<section class="antialiased text-slate-800">
    @push('cdns')
        <!-- Chart.js CDN for data visualization -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

        <div class="p-4 sm:p-6 lg:p-8">
            <!-- Dashboard Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-gray-100">ড্যাশবোর্ড</h1>
                    <p class="mt-1 text-slate-500 dark:text-slate-300">আপনার নিউজ পোর্টালের সকল কার্যক্রমের সারসংক্ষেপ।</p>
                </div>
                <div class="mt-4 sm:mt-0 flex items-center gap-2">
                     <a href="{{ route('posts.create') }}" wire:navigate class="px-8 py-2 cursor-pointer dark:bg-zinc-700 dark:border-zinc-600 dark:text-white bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 flex items-center gap-2">
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
                <!-- Card 1: Total Posts -->
                <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-200">সর্বমোট পোস্ট</p>
                            <p class="text-3xl font-bold text-slate-900 mt-1 dark:text-white">{{ $this->formatToBengali($totalPosts) }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <!-- FileText Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                    </div>
                </div>
                <!-- Card 2: Published Posts -->
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
                <!-- Card 3: Drafts -->
                <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-200">পেন্ডিং পোস্ট</p>
                            <p class="text-3xl font-bold text-slate-900 mt-1 dark:text-white">{{ $this->formatToBengali($pendingPosts) }}</p>
                        </div>
                         <div class="bg-amber-100 p-3 rounded-full">
                             <!-- Edit3 Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-600"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        </div>
                    </div>
                </div>
                <!-- Card 4: Visitors -->
                <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-200">আজকের ভিজিটর</p>
                            <p class="text-3xl font-bold text-slate-900 mt-1 dark:text-white">{{ $this->formatToBengali($todaysVisitors) }}</p>
                        </div>
                         <div class="bg-red-100 p-3 rounded-full">
                            <!-- Users Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Recent Posts & Chart -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Visitor Statistics Chart -->
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-md border dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-gray-300 mb-4">ভিজিটর পরিসংখ্যান (শেষ ৭ দিন)</h3>
                        <div class="h-80 dark:text-white">
                            {{-- ক্যানভাস ট্যাগটি এখানে থাকবে --}}
                            <canvas id="visitorsChart" class="dark:text-white"></canvas>
                        </div>
                    </div>

                    <!-- Recent Posts Table -->
                    <div class="bg-white dark:bg-zinc-900 dark:border-zinc-600 dark:text-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-50">সাম্প্রতিক পোস্টসমূহ</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 font-medium">শিরোনাম</th>
                                        <th scope="col" class="px-6 py-3 font-medium">ক্যাটেগরি</th>
                                        <th scope="col" class="px-6 py-3 font-medium">স্ট্যাটাস</th>
                                        <th scope="col" class="px-6 py-3 font-medium">ভিউ</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200  dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                    @if ($letetstPosts->isNOtEmpty())
                                        @foreach ($letetstPosts as $letetstPost)
                                            <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-300">
                                                    {{ $letetstPost->title }}
                                                </td>
                                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                                    {{ $this->convertToBengaliNumbers($letetstPost->category?->name ?? 'Uncategorized') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                        @if ($letetstPost->status === 'published')
                                                            প্রকাশিত
                                                        @elseif ($letetstPost->status === 'draft')
                                                            খসড়া
                                                        @elseif ($letetstPost->status === 'pending')
                                                            অপেক্ষমাণ
                                                        @else
                                                            {{ $letetstPost->status }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                                    {{ $this->getBengaliTimeAgo($letetstPost->published_at) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-gray-500">
                                                কোনো পোস্ট নেই
                                            </td>
                                        </tr>
                                    {{-- @endif
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 font-medium text-slate-900">পদ্মা সেতুর নতুন টোল হার কার্যকর</td>
                                            <td class="px-6 py-4 text-slate-600">জাতীয়</td>
                                            <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">প্রকাশিত</span></td>
                                            <td class="px-6 py-4 text-slate-600">২.৫ হাজার</td>
                                        </tr> --}}
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Quick Actions & Categories -->
                <div class="space-y-8">
                    <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-50 mb-4">জনপ্রিয় ক্যাটেগরি</h3>
                        <div class="space-y-4">
                            @foreach ($popularCategories as $category)
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $category['name'] }}</span>
                                        <span class="text-sm font-medium text-slate-500 dark:text-slate-300">{{ $category['percentage'] }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-200 dark:bg-zinc-800 rounded-full h-2.5">
                                        <div class="h-2.5 rounded-full bg-{{ $category['color'] }}" style="width: {{ $category['percentage'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white p-6 rounded-xl shadow-md border border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-50 mb-4">জনপ্রিয় পোল</h3>
                        <div class="flex flex-col space-y-3">
                            @forelse ($popularPolls as $poll)
                                <a href="#" class="w-full text-left p-3 rounded-lg hover:bg-slate-100 dark:hover:bg-zinc-800 transition-colors">
                                    {{ $poll->question }} (ভোট: {{ $poll->total_votes }})
                                </a>
                            @empty
                                <p class="text-sm text-slate-500 dark:text-slate-300">কোনো জনপ্রিয় পোল পাওয়া যায়নি।</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        @push('scripts')
            <script>
                // چار্ট ইনস্ট্যান্স রাখার জন্য একটি ভ্যারিয়েবল
                let visitorsChartInstance;
            
                // چار্ট তৈরি করার জন্য একটি ফাংশন
                const initVisitorChart = () => {
                    // যদি আগের কোনো چار্ট ইনস্ট্যান্স থাকে, তবে সেটি ধ্বংস করে দেওয়া হচ্ছে
                    if (visitorsChartInstance) {
                        visitorsChartInstance.destroy();
                    }
            
                    const chartLabels = @json($chartLabels);
                    const chartData = @json($chartData);
            
                    const convertToBengali = (text) => {
                        const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                        const bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                        let strText = String(text);
                        for (let i = 0; i < englishDigits.length; i++) {
                            strText = strText.replace(new RegExp(englishDigits[i], "g"), bengaliDigits[i]);
                        }
                        return strText;
                    };
            
                    const ctx = document.getElementById('visitorsChart')?.getContext('2d');
                    if (!ctx) return; // যদি ক্যানভাস এলিমেন্ট না পাওয়া যায়, তাহলে ফাংশন থেকে বেরিয়ে আসা হবে
            
                    visitorsChartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: chartLabels,
                            datasets: [{
                                label: 'ইউনিক ভিজিটর',
                                data: chartData,
                                borderColor: 'rgb(79, 70, 229)',
                                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return convertToBengali(value);
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (label) { label += ': '; }
                                            if (context.parsed.y !== null) {
                                                label += convertToBengali(context.parsed.y);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                };
            
                // ✨ প্রথমবার পেজ লোড হওয়ার সময় চার্ট চালু করা
                document.addEventListener('DOMContentLoaded', () => {
                    initVisitorChart();
                });
            
                // ✨ Livewire নেভিগেশনের পর প্রতিবার চার্ট নতুন করে চালু করা
                document.addEventListener('livewire:navigated', () => {
                    initVisitorChart();
                });
            </script>
        @endpush
</section>