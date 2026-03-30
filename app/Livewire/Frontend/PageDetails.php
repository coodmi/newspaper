<?php

namespace App\Livewire\Frontend;

use App\Models\website;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.frontend')]
class PageDetails extends Component
{
    public $q;
    public $page;

    public function mount()
    {
        $this->q = request()->segment(count(request()->segments()));
        if($this->q == 'about-us'){
            $this->page = website::first()->about;
        }elseif($this->q == 'privacy-policy'){
            $this->page = website::first()->privacy;
        }elseif($this->q == 'contact-us'){
            $this->page = website::first()->contact;
        }elseif($this->q == 'terms-and-conditions'){
            $this->page = website::first()->terms;
        }else{
            return redirect()->route('home');
        }
    }
    public function render()
    {
        return view('livewire.frontend.page-details');
    }
}