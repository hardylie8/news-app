<?php

namespace App\Http\Livewire\News;

use App\Http\Livewire\Concerns\Trix;
use App\Models\News;
use App\Models\Tag;
use  Illuminate\Support\Collection;

class CreateNews extends NewsForm
{

    public Collection $tags;

    public array $tagsValues = [];

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
    ];

    public function trixValueUpdated($value)
    {
        $this->news->news = $value;
    }


    public function render()
    {
        return view('livewire.news.create-news');
    }

    public function mount()
    {
        $this->news = new News();
        $this->tags = Tag::get()->pluck('title', 'id',);
    }
}
