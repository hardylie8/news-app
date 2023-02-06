<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\QueryBuilders\NewsBuilder;
// use Illuminate\Http\Request;
// use Spatie\QueryBuilder\QueryBuilder;
// use Spatie\QueryBuilder\AllowedFilter;

class NewsController extends Controller
{
    /**
     * Determine if any access to this resource require authorization.
     *
     * @var bool
     */
    protected static $requireAuthorization = false;

    /**
     * BrandsController constructor.
     */
    public function __construct()
    {
        if (self::$requireAuthorization) {
            $this->authorizeResource(News::class);
        }
    }

    /**
     * function to show multiple record of news
     * 
     * @param NewsBuilder $query
     * @return NewsCollection 
     */
    public function index(NewsBuilder $query): NewsCollection
    {
        return (new NewsCollection($query->paginate()))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Data Has been successfully retrieved'
                ]
            );
    }

    /**
     * function to show single record of news
     * 
     * @param NewsBuilder $query
     * @return NewsResource 
     */
    public function show(NewsBuilder $query, News $news): NewsResource
    {
        return (new NewsResource($query->find($news->getKey())))->additional(
            [
                'status' => 200,
                'message' => 'Data Has been successfully retrieved'
            ]
        );
    }
}
