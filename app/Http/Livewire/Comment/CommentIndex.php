<?php

namespace App\Http\Livewire\Comment;

use App\Http\Livewire\Concerns\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\BaseComponent;
use App\Models\Comment;

class CommentIndex extends BaseComponent
{
    public  $newsId;

    public function render()
    {
        return view('livewire.comment.comment-index');
    }

    public function query(): Builder
    {
        return (Comment::query()->where('news_id',  $this->newsId));
    }

    public function columns(): array
    {
        return [
            Column::make('title', 'title'),
            Column::make('username', 'Username')->notSortable(),
            // Column::make('tagnames', 'Tag Names')->component('cms.tags')->notSortable(),
        ];
    }

    public function searchColumn(): string
    {
        return
            'title';
    }
}
