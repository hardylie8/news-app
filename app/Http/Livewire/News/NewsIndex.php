<?php

namespace App\Http\Livewire\News;

use App\Http\Livewire\BaseComponent;
use App\Http\Livewire\Concerns\Column;
use App\Http\Livewire\Concerns\SwalTrigger;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;

class NewsIndex extends BaseComponent
{
    use SwalTrigger;

    public function render()
    {
        return view('livewire.news.news-index');
    }

    public function query(): Builder
    {
        return (News::query());
    }

    public function columns(): array
    {
        return [
            Column::make('title', __("common.title")),
            Column::make('published_at', __("common.publishStatus"))->component('cms.published'),
            Column::make('tagnames', __("common.tagNames"))->component('cms.tags')->notSortable(),
        ];
    }

    public function searchColumn(): string
    {
        return
            'title';
    }

    public function deleteItem($key)
    {
        parent::deleteItem($key);
        $this->DispactchSwal(
            'swal',
            [
                'title' => __("common.success"),
                'text' => __("common.successMessage", ['name' => __("common.News")]),
                'icon' => 'success',
            ]
        );
    }

    public function create()
    {
        return redirect()->to(
            route('web.news.create')
        );
    }
}
