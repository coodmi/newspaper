<?php

namespace App\Livewire\Ads;



use App\Models\AdSlot;
use App\Traits\HasNotifications;
use Livewire\Component;

class SlotForm extends Component
{
    use HasNotifications;
    
    public ?AdSlot $adSlot;

    public $name = '';
    public $location_key = '';
    public $ad_type = 'google';
    public $google_ad_code = '';
    public $is_active = true;

    protected function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'location_key' => 'required|string|max:255|regex:/^[a-z0-9_]+$/|unique:ad_slots,location_key',
            'ad_type' => 'required|in:google,personal',
            'google_ad_code' => 'nullable|string',
            'is_active' => 'boolean',
        ];

        if ($this->ad_type === 'google') {
            $rules['google_ad_code'] = 'required|string';
        }

        if ($this->adSlot->exists) {
            $rules['location_key'] = 'required|string|max:255|regex:/^[a-z0-9_]+$/|unique:ad_slots,location_key,' . $this->adSlot->id;
        }

        return $rules;
    }

    public function mount(AdSlot $adSlot): void
    {
        $this->adSlot = $adSlot;

        if ($this->adSlot->exists) {
            $this->name = $adSlot->name;
            $this->location_key = $adSlot->location_key;
            $this->ad_type = $adSlot->ad_type;
            $this->google_ad_code = $adSlot->google_ad_code;
            $this->is_active = $adSlot->is_active; // <<-- এই লাইনটি যোগ করা হয়েছে
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate();

        if (!$this->adSlot->exists) {
            AdSlot::create($validatedData);
            $this->succsessNotify('Ad Slot created successfully.');
        } else {
            $this->adSlot->update($validatedData);
            $this->succsessNotify('Ad Slot updated successfully.');
        }

        $this->redirect(route('admin.ads.slots.index'), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.ads.slot-form');
    }
}