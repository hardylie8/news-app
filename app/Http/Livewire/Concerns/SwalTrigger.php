<?php

namespace App\Http\Livewire\Concerns;

trait SwalTrigger
{
    public function DispactchSwal($eventName, $detail)
    {
        $this->dispatchBrowserEvent($eventName, $detail);
    }
}
