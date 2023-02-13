<?php

namespace App\Http\Livewire\Concerns;

use Livewire\Component;

class Trix extends Component
{
    const EVENT_VALUE_UPDATED = 'trixValueUpdated';

    public $value;
    public $trixId;

    public function mount($value = '')
    {
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updatedValue($value)
    {
        $this->emit(self::EVENT_VALUE_UPDATED, $value);
    }

    public function render()
    {
        return view('components.cms.trix');
    }
}
