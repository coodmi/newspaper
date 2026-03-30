<?php

namespace App\Livewire\Ads;



use App\Models\Website;
use App\Traits\HasNotifications;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AdSenseManager extends Component
{
    use HasNotifications;
    public ?Website $website;

    // #[Rule('required|string|starts_with:ca-pub-')]
    #[Rule('nullable|max:255')]
    public $publisher_id = '';

    public function mount(): void
    {
        // ওয়েবসাইটের প্রথম সেটিংস রেকর্ডটি লোড করা হচ্ছে
        $this->website = Website::first();
        if ($this->website) {
            $this->publisher_id = $this->website->adsense_publisher_id;
        }
    }

    public function save(): void
    {
        $this->validate();

        if ($this->website) {
            $this->website->update([
                'adsense_publisher_id' => $this->publisher_id
            ]);
        } else {
            // যদি websites টেবিলে কোনো ডেটা না থাকে, তাহলে নতুন করে তৈরি করবে
            Website::create([
                'adsense_publisher_id' => $this->publisher_id
            ]);
        }

        $this->succsessNotify("AdSense Publisher ID updated successfully.");
    }

    public function render()
    {
        return view('livewire.ads.ad-sense-manager');
    }
}