<?php

namespace App\Livewire\Frontend;

use App\Models\Post;
use App\Models\PollOption;
use App\Models\PollVote;
use App\Traits\ammountFormater;
use App\Traits\HasBengaliNumbers;
use App\Traits\HasNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Handle post viewing with poll voting support.
 */

 #[Layout('components.layouts.frontend')]
class PostView extends Component
{
    use ammountFormater, HasBengaliNumbers, HasNotifications;


    public $post;
    public $letetstPosts;
    public $todayBestPosts;
    public $weekBestPosts;
    public $relatedPosts;
    public $comments;
    public $poll;
    public $selectedOption;
    public $votedOptionId = null;


    public function formatToBengali($number)
    {
        $formattedNumber = $this->formatLakh($number);

        return $this->convertToBengaliNumbers($formattedNumber);
    }

    /**
     * Handle poll vote submission.
     *
    //  * @return void
     */
    public function vote($optionId): void
    {
        $this->selectedOption = $optionId;
        $this->submitVote();
    }

    public function submitVote(): void
    {
        if (!$this->selectedOption) {
            $this->unsuccsessNotify(" ");
            return;
        }

        $option = PollOption::with('poll')->find($this->selectedOption);

        if (!$option) {
            $this->unsuccsessNotify("");
            return;
        }

        $pollId = $option->poll_id;
        $userId = Auth::id();
        $ip = Request::ip();

        $pollOptionIds = PollOption::where('poll_id', $pollId)->pluck('id');

        $alreadyVoted = PollVote::whereIn('poll_option_id', $pollOptionIds)
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('ip_address', $ip))
            ->exists();

        if ($alreadyVoted) {
            $this->unsuccsessNotify("");
            return;
        }

        PollVote::create([
            'poll_option_id' => $option->id,
            'user_id' => $userId,
            'ip_address' => $userId ? null : $ip,
        ]);

        $option->increment('votes');

        $this->poll = $this->post->poll->fresh()->load('options');
        $this->votedOptionId = $option->id;

        // $this->successNotify("");
    }


    public function mount($slug): void
    {
        $this->post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $viewedPosts = session()->get('viewed_posts', []);

        if (!in_array($slug, $viewedPosts)) {
            $this->post->increment('view_count');
            $viewedPosts[] = $slug;
            session(['viewed_posts' => $viewedPosts]);
        }

        $this->poll = $this->post->poll ? $this->post->poll->load('options') : null;
        if ($this->poll) {
            $pollOptionIds = $this->poll->options->pluck('id');
            $userId = Auth::id();
            $ip = Request::ip();

            $vote = PollVote::whereIn('poll_option_id', $pollOptionIds)
                ->when($userId, fn($q) => $q->where('user_id', $userId))
                ->when(!$userId, fn($q) => $q->where('ip_address', $ip))
                ->first();

            if ($vote) {
                $this->votedOptionId = $vote->poll_option_id;
            }
        }


        $this->relatedPosts = Post::where('category_id', $this->post->category_id)
            ->where('slug', '!=', $slug)
            ->where('status', 'published')
            ->whereNotNull('featured_image')
            ->latest()
            ->take(15)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.post-view');
    }
}