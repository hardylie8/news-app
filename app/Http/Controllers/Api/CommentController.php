<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentsCollection;
use App\Http\Resources\CommentsResource;
use App\Models\Comment;
use App\QueryBuilders\CommentBuilder;

class CommentController extends Controller
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
            $this->authorizeResource(Comment::class);
        }
    }


    /**
     * function to show multiple record of news
     * 
     * @param NewsBuilder $query
     * @return NewsCollection 
     */
    public function index(CommentBuilder $query): CommentsCollection
    {
        return (new CommentsCollection($query->paginate()))
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
    public function show(CommentBuilder $query, Comment $comment): CommentsResource
    {
        return (new CommentsResource($query->find($comment->getKey())))->additional(
            [
                'status' => 200,
                'message' => 'Data Has been successfully retrieved'
            ]
        );
    }
}
