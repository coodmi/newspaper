<?php

namespace App\Livewire\Ads;



use App\Models\AdSlot;
use App\Models\PersonalAd;
use Livewire\Component;

class DisplayAd extends Component
{
    public string $locationKey;
    public ?AdSlot $adSlot;
    public ?PersonalAd $personalAd = null;

    public function mount(string $locationKey): void
    {
        $this->locationKey = $locationKey;

        $this->adSlot = AdSlot::where('location_key', $this->locationKey)
                               ->where('is_active', true)
                               ->first();

        if ($this->adSlot && $this->adSlot->ad_type === 'personal') {
            
            $this->personalAd = $this->adSlot->personalAds()
                                             ->where('is_active', true)
                                             ->inRandomOrder()
                                             ->first();
        }
    }

    public function render()
    {
        return view('livewire.ads.display-ad');
    }
}