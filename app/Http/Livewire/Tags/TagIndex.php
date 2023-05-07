<?php

namespace App\Http\Livewire\Tags;

use App\Http\Livewire\BaseComponent;
use App\Http\Livewire\Concerns\Column;
use App\Http\Livewire\Concerns\SwalTrigger;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagIndex extends BaseComponent
{
    use SwalTrigger;

    public function render()
    {
        return view('livewire.tag.tag-index');
    }

    public function query(): Builder
    {
        return (Tag::query());
    }

    public function columns(): array
    {
        return [
            Column::make('title', __("common.title")),
            Column::make('created_at', __("common.createdAt")),
            Column::make('updated_at', __("common.updatedAt")),
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
                'text' => 'Tag deleted successfully!',
                'icon' => 'success',
            ]
        );
    }

    public function create()
    {
        return redirect()->to(
            route('web.tag.create')
        );
    }
}
