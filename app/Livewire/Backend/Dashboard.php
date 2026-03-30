<?php

namespace App\Livewire\Backend;

use App\Helpers\BanglaDateHelper;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Post;
use App\Models\Visitor;
use App\Traits\ammountFormater;
use App\Traits\HasBengaliNumbers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    use ammountFormater, HasBengaliNumbers;
    public $popularCategories = [];
    public $popularPolls = [];

    public function mount()
    {
        $this->loadPopularCategories();
        $this->loadPopularPolls();
    }

    public function loadPopularCategories()
    {
        $totalViews = Post::sum('view_count');

        $this->popularCategories = Category::query()
            ->select('categories.name', DB::raw('SUM(posts.view_count) as total_category_views'))
            ->join('posts', 'categories.id', '=', 'posts.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_category_views')
            ->limit(3)
            ->get()
            ->map(function ($category) use ($totalViews) {
                $percentage = ($totalViews > 0) ? round(($category->total_category_views / $totalViews) * 100) : 0;
                return [
                    'name' => $category->name,
                    'percentage' => $percentage,
                    'color' => $this->getRandomColor(), // Assign a random color
                ];
            });
    }

    public function loadPopularPolls()
    {
        $this->popularPolls = Poll::query()
            ->select('polls.question', DB::raw('SUM(poll_options.votes) as total_votes'))
            ->join('poll_options', 'polls.id', '=', 'poll_options.poll_id')
            ->groupBy('polls.id', 'polls.question')
            ->orderByDesc('total_votes')
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->limit(4)
            ->get();
    }
    
    private function getRandomColor()
    {
        $colors = ['blue-600', 'teal-500', 'orange-500', 'purple-500', 'red-500', 'green-500'];
        return $colors[array_rand($colors)];
    }
    
    public function formatToBengali($number)
    {
        $formattedNumber = $this->formatLakh($number);

        return $this->convertToBengaliNumbers($formattedNumber);
    }
    
    public function render()
    {

        $totalPosts   = Post::count();
        $publishedPosts   = Post::where('status', 'published')->count();
        $pendingPosts = Post::where('status', 'pending')->count();
        
        $todaysVisitors = Visitor::whereDate('created_at', today())
                              ->distinct('visitor_identifier')
                              ->count(); 



        // --- ✨ চার্টের জন্য ডেটা তৈরি করার নতুন লজিক ---
        $chartLabels = [];
        $chartData   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            
            // প্রতিদিনের ইউনিক ভিজিটর গণনা
            $count = Visitor::whereDate('created_at', $date)
                            ->distinct('visitor_identifier')
                            ->count();

            // চার্টের জন্য লেবেল এবং ডেটা অ্যারেতে যোগ করা
            $chartLabels[] = BanglaDateHelper::formattedLineFour($date);
            $chartData[] = $count;
        }
        // --- চার্টের লজিক শেষ ---


                $letetstPosts = Post::where('status', 'published')
                    ->orderBy('published_at', 'desc')
                    ->where('status', 'published')
                    ->whereDate('published_at', '<=', now())
                    ->take(5)
                    ->get();
        
        return view('livewire.backend.dashboard', [
            'totalPosts' => $totalPosts,
            'pendingPosts' => $pendingPosts,
            'publishedPosts' => $publishedPosts,
            'todaysVisitors' => $todaysVisitors,
            'chartLabels'    => $chartLabels,
            'chartLabels'    => $chartLabels,
            'chartData'      => $chartData,
            'letetstPosts' => $letetstPosts,
            
        ]);
    }
}