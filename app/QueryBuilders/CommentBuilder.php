<?php

namespace App\QueryBuilders;

use App\Http\Requests\CommentGetRequest;
use App\Http\Requests\CommentsGetRequest;
use App\Http\Requests\NewsGetRequest;
use App\Models\Comment;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


final class CommentBuilder extends Builder
{
    /**
     * Current HTTP Request object.
     *
     * @var NewsGetRequest
     */
    protected $request;


    /**
     * CommentBuilder constructor.
     *
     * @param NewsGetRequest $request
     */
    public function __construct(CommentsGetRequest $request)
    {
        $this->request = $request;
        $this->builder = QueryBuilder::for(Comment::class, $request);
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedFields(): array
    {
        return [
            'id', 'title', 'users.name', 'news.title', 'news.id'
        ];
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id'), 'title',  'users.name', 'news.title', 'news.id'
        ];
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedIncludes(): array
    {
        return [
            'news', 'users', 'news.tags'
        ];
    }
    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedSearch(): array
    {
        return ['title'];
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedSorts(): array
    {
        return ['id', 'title', 'users.name', 'title.name'];
    }

    /**
     * Get a list of allowed columns that can be appended.
     *
     * @return string[]
     */
    protected function allowedAppends(): array
    {
        return [];
    }


    /**
     * Get the default sort column that will be used in any sort operation.
     *
     * @return string
     */
    protected function getDefaultSort(): string
    {
        return 'id';
    }
}
