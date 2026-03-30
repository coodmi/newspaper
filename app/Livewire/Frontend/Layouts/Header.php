<?php

namespace App\Livewire\Frontend\Layouts;

use App\Models\website;
use Livewire\Component;

class Header extends Component
{


    public $logo;
    public $facebook_url;
    public $twitter_url;
    public $instagram_url;
    public $youtube_url;
    public $google_news_url;
    public $linkedin_url;
    public $reddit_url;
    
    public function mount()
    {
        $website = website::first();
    
        if ($website) {
            $this->logo = $website->logo;
            $this->facebook_url = $website->facebook_url;
            $this->twitter_url = $website->twitter_url;
            $this->instagram_url = $website->instagram_url;
            $this->youtube_url = $website->youtube_url;
            $this->google_news_url = $website->google_news_url;
            $this->linkedin_url = $website->linkedin_url;
            $this->reddit_url = $website->reddit_url;
        }
    }
    

    
    public function render()
    {
        
        return view('livewire.frontend.layouts.header');
    }
}