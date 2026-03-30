<?php

namespace App\Traits;

trait HasNotifications
{
    //

    public function succsessNotify($message)
    {
        $this->dispatch("notify", type:"success", message: $message);
    }

    public function unsuccsessNotify($message)
    {
        $this->dispatch("notify", type:"error", message: $message);
    }
    
}