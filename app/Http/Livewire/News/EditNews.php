<?php

namespace App\Http\Livewire\News;

use App\Http\Livewire\Concerns\Trix;
use App\Models\Tag;
use  Illuminate\Support\Collection;

class EditNews extends NewsForm
{

    public Collection $tags;

    public array $tagsValues;

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
    ];

    public function trixValueUpdated($value)
    {
        $this->news->news = $value;
    }


    public function render()
    {
        return view('livewire.news.edit-news');
    }

    public function mount()
    {
        $this->tags = Tag::get()->pluck('title', 'id',);
        $this->tagsValues = $this->news->tags->pluck('id', 'id')->toArray();
        $this->published = !is_null($this->news->published_at);
    }
}
