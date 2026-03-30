<?php

namespace App\Livewire\Ads;

use App\Models\AdSlot;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SlotIndex extends Component
{
    public Collection $adSlots;

    public function mount(): void
    {
        // সব Ad Slot ডেটাবেস থেকে নিয়ে আসা হচ্ছে
        $this->adSlots = AdSlot::latest()->get();
    }
    public function render()
    {
        return view('livewire.ads.slot-index');
    }
}