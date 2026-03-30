<?php

namespace App\Livewire\Ads;

use App\Models\AdSlot;
use App\Models\PersonalAd;
use App\Traits\HasNotifications;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class PersonalAdManager extends Component
{
    use WithFileUploads, HasNotifications;

    public AdSlot $adSlot;
    public Collection $personalAds;

    // নতুন বিজ্ঞাপন তৈরির ফর্মের জন্য প্রপার্টি
    #[Rule('required|string|max:255')]
    public $title = '';

    #[Rule('required|url')]
    public $target_link = '';

    #[Rule('required|image|max:2048')] // 2MB সর্বোচ্চ সাইজ
    public $ad_image;

    public function mount(AdSlot $adSlot): void
    {
        // রাউট থেকে আসা AdSlot মডেলটি গ্রহণ করা হচ্ছে
        $this->adSlot = $adSlot;
        // ঐ AdSlot-এর অধীনে থাকা সব ব্যক্তিগত বিজ্ঞাপন লোড করা হচ্ছে
        $this->loadPersonalAds();
    }

    // ব্যক্তিগত বিজ্ঞাপনগুলো লোড করার জন্য একটি হেল্পার মেথড
    public function loadPersonalAds(): void
    {
        $this->personalAds = $this->adSlot->personalAds()->latest()->get();
    }

    // নতুন ব্যক্তিগত বিজ্ঞাপন সেভ করার মেথড
    public function save(): void
    {
        $this->validate();

        // ছবির জন্য ইউনিক নাম তৈরি করা হচ্ছে
        $imageName = "ad-" . time() . '.' . $this->ad_image->getClientOriginalExtension();
        // ছবিটি 'storage/app/public/ads' ফোল্ডারে সেভ হবে এবং পাথ রিটার্ন করবে
        $imagePath = $this->ad_image->storeAs('ads', $imageName, 'public');

        // ডেটাবেসে নতুন বিজ্ঞাপন রেকর্ড তৈরি করা হচ্ছে
        $this->adSlot->personalAds()->create([
            'title' => $this->title,
            'target_link' => $this->target_link,
            'ad_image' => $imagePath,
        ]);

        // ফর্মটি রিসেট করা হচ্ছে
        $this->reset('title', 'target_link', 'ad_image');

        // বিজ্ঞাপনের তালিকাটি রিফ্রেশ করা হচ্ছে
        $this->loadPersonalAds();

        // session()->flash('success', 'Personal ad uploaded successfully.');
        $this->succsessNotify('Personal ad uploaded successfully.');
    }

    // একটি বিজ্ঞাপন ডিলিট করার মেথড
    public function delete(PersonalAd $personalAd): void
    {
        // প্রথমে স্টোরেজ থেকে ছবিটি ডিলিট করা হচ্ছে
        Storage::disk('public')->delete($personalAd->ad_image);
        
        // এরপর ডেটাবেস থেকে রেকর্ডটি ডিলিট করা হচ্ছে
        $personalAd->delete();

        // তালিকাটি রিফ্রেশ করা হচ্ছে
        $this->loadPersonalAds();

        // session()->flash('success', 'Ad deleted successfully.');
        $this->succsessNotify('Ad deleted successfully.');
    }
    
    public function render()
    {
        return view('livewire.ads.personal-ad-manager');
    }
}