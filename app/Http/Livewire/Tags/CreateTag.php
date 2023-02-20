<?php

namespace App\Http\Livewire\Tags;

use App\Models\Tag;

class CreateTag extends TagForm
{
    public function render()
    {
        return view('livewire.tag.create-tag');
    }

    public function mount()
    {
        $this->tag = new Tag();
    }
}
