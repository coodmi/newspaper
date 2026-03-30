<?php

namespace App\Livewire\Website;

use App\Models\Website;
use App\Traits\HasNotifications;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use HasNotifications;

    public $title;
    public $tags = [];
    public $tagsString = '';
    public $meta_description;
    public $meta_tags;
    public $website;
    public $fb_app_id, $youtube_url, $facebook_url, $twitter_url, $instagram_url, $reddit_url, $google_news_url, $linkedin_url;
    public $mailer, $host, $port, $username, $password, $encryption, $from_address, $from_name, $terms, $privacy, $contact, $about, $editor;
    

    public function mount()
    {
        $this->website = Website::first();

        if ($this->website) {
            $this->title = $this->website->title;
            $this->meta_description = $this->website->meta_description;
            $this->meta_tags = $this->website->meta_tags;
            $this->fb_app_id = $this->website->fb_app_id;
            $this->youtube_url = $this->website->youtube_url;
            $this->facebook_url = $this->website->facebook_url;
            $this->twitter_url = $this->website->twitter_url;
            $this->instagram_url = $this->website->instagram_url;
            $this->reddit_url = $this->website->reddit_url;
            $this->google_news_url = $this->website->google_news_url;
            $this->linkedin_url = $this->website->linkedin_url;

            $this->mailer = $this->website->mailer ?? null;
            $this->host = $this->website->host ?? null;
            $this->port = $this->website->port ?? null;
            $this->username = $this->website->username ?? null;
            $this->password = $this->website->password ?? null;
            $this->encryption = $this->website->encryption ?? null;
            $this->from_address = $this->website->from_address ?? null;
            $this->from_name = $this->website->from_name ?? null;
            $this->terms = $this->website->terms ?? null;
            $this->privacy = $this->website->privacy ?? null;
            $this->contact = $this->website->contact ?? null;
            $this->about = $this->website->about ?? null;
            $this->editor = $this->website->editor ?? null;

            // Convert meta_tags to tags array
            $this->tags = array_filter(array_map('trim', explode(',', $this->website->meta_tags)));
            $this->tagsString = implode(',', $this->tags);
        }
    }

    public function saveSettings()
    {
        $validated = $this->validate([
            'title' => 'nullable|min:3|max:255',
            'meta_description' => 'nullable',
            'meta_tags' => 'nullable|max:255',
            'fb_app_id' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'reddit_url' => 'nullable|url|max:255',
            'google_news_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'mailer' => 'nullable|max:255',
            'host' => 'nullable|max:255',
            'port' => 'nullable|max:255',
            'username' => 'nullable|max:255',
            'password' => 'nullable|max:255',
            'encryption' => 'nullable|max:255',
            'from_address' => 'nullable|max:255',
            'from_name' => 'nullable|max:255',
            'terms' => 'nullable|max:255',
            'privacy' => 'nullable|max:255',
            'contact' => 'nullable|max:255',
            'about' => 'nullable|max:255',
            'editor' => 'nullable|max:255',
        ]);

        // Set meta_tags from tagsString
        $validated['meta_tags'] = $this->tagsString;

        // REMOVE all null values (so DB default will work)
        $validated = array_filter($validated, fn ($v) => !is_null($v));

        try {

            if ($this->website) {
                $this->website->update($validated);
            } else {
                Website::create($validated);
            }

            $this->succsessNotify("Website settings saved successfully!");
            // return redirect()->route('website.index');
        } catch (\Throwable $th) {
            $this->unsuccsessNotify("Failed to save website settings: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.website.index');
    }
}