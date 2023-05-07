<?php

namespace App\Http\Livewire\Comment;

use App\Http\Livewire\BaseComponent;
use App\Http\Livewire\Concerns\Column;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

class CommentIndex extends BaseComponent
{
    public $newsId;

    public function render()
    {
        return view('livewire.comment.comment-index');
    }

    public function query(): Builder
    {
        return (Comment::query()->where('news_id', $this->newsId));
    }

    public function columns(): array
    {
        return [
            Column::make('title', __('common.Comment')),
            Column::make('username', __('common.Username'))->notSortable(),
            // Column::make('tagnames', 'Tag Names')->component('cms.tags')->notSortable(),
        ];
    }

    public function searchColumn(): string
    {
        return
            'title';
    }
}
