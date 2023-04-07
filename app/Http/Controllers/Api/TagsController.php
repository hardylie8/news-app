<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\QueryBuilders\TagBuilder;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Determine if any access to this resource require authorization.
     *
     * @var bool
     */
    protected static $requireAuthorization = false;

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        if (self::$requireAuthorization) {
            $this->authorizeResource(Tag::class);
        }
    }


    /**
     * function to show multiple record of news
     * 
     * @param TagBuilder $query
     * @return TagCollection 
     */
    public function index(TagBuilder $query): TagCollection
    {
        return (new TagCollection($query->paginate()))
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
     * @param TagBuilder $query
     * @return TagResource 
     */
    public function show(TagBuilder $query, Tag $tag): TagResource
    {
        return (new TagResource($query->find($tag->getKey())))->additional(
            [
                'status' => 200,
                'message' => 'Data Has been successfully retrieved'
            ]
        );
    }
}
