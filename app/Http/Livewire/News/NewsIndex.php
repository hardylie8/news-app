<?php

namespace App\Http\Livewire\News;

use App\Http\Livewire\Concerns\Column;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\BaseComponent;
use App\Http\Livewire\Concerns\SwalTrigger;

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
            Column::make('title', 'title'),
            Column::make('published_at', 'Publish Status')->component('cms.published'),
            Column::make('tagnames', 'Tag Names')->component('cms.tags')->notSortable(),
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
                'title' => 'Success',
                'text'  => 'News deleted successfully!',
                'icon'  => 'success'
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
