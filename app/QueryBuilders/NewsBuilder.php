<?php

namespace App\QueryBuilders;

use App\Http\Requests\NewsGetRequest;
use App\Models\News;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


final class NewsBuilder extends Builder
{
    /**
     * Current HTTP Request object.
     *
     * @var NewsGetRequest
     */
    protected $request;


    /**
     * NewsBuilder constructor.
     *
     * @param NewsGetRequest $request
     */
    public function __construct(NewsGetRequest $request)
    {
        $this->request = $request;
        $this->builder = QueryBuilder::for(News::class, $request);
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedFields(): array
    {
        return [
            'id', 'title', 'news'
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
            AllowedFilter::exact('id'), 'title', 'news', 'tags.title', 'tags.id'
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
            'tags', 'comments', 'comments.news', 'comments.users'
        ];
    }
    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedSearch(): array
    {
        return ['title', 'news'];
    }

    /**
     * Get a list of allowed columns that can be selected.
     *
     * @return string[]
     */
    protected function getAllowedSorts(): array
    {
        return ['id', 'title', 'news'];
    }

    /**
     * Get a list of allowed columns that can be appended.
     *
     * @return string[]
     */
    protected function allowedAppends(): array
    {
        return ['comments.username'];
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
