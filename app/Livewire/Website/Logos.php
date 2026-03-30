<?php

namespace App\Livewire\Website;

use App\Models\Website;
use App\Traits\HasNotifications;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Logos extends Component
{
    use HasNotifications, WithFileUploads;

    public $favicon;
    public $logo;
    public $temp_favicon;
    public $temp_logo;
    public $website;

    public function mount()
    {
        $this->website = Website::first();

        if ($this->website) {
            $this->temp_favicon = $this->website->favicon ? asset('storage/' . $this->website->favicon) : null;
            $this->temp_logo = $this->website->logo ? asset('storage/' . $this->website->logo) : null;
        }
        // dd($this->website);
    }

    public function saveSettings()
    {
        $validated = $this->validate([
            'favicon' => 'nullable|image|max:1024',
            'logo' => 'nullable|image|max:1024',
        ]);

        try {
            $data = [];

            // Handle favicon upload only if a new one is selected
            if ($this->favicon) {
                // Delete old favicon if exists
                if ($this->website && $this->website->favicon) {
                    Storage::disk('public')->delete($this->website->favicon);
                }
                $faviconName = "favicon-" . time() . '.' . $this->favicon->getClientOriginalExtension();
                $data['favicon'] = $this->favicon->storeAs('website', $faviconName, 'public');
            }

            // Handle logo upload only if a new one is selected
            if ($this->logo) {
                // Delete old logo if exists
                if ($this->website && $this->website->logo) {
                    Storage::disk('public')->delete($this->website->logo);
                }
                $logoName = "logo-" . time() . '.' . $this->logo->getClientOriginalExtension();
                $data['logo'] = $this->logo->storeAs('website', $logoName, 'public');
            }

            if ($this->website) {
                $this->website->update($data);
            } else {
                Website::create($data);
            }

            $this->succsessNotify("Website settings saved successfully!");
            // return redirect()->route('website.index');
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Failed to save website settings: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.website.logos');
    }
}