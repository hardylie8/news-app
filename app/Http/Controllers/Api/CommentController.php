<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentSaveRequest;
use App\Http\Resources\CommentsCollection;
use App\Http\Resources\CommentsResource;
use App\Models\Comment;
use App\QueryBuilders\CommentBuilder;
use Illuminate\Http\JsonResponse;


class CommentController extends Controller
{
    /**
     * Determine if any access to this resource require authorization.
     *
     * @var bool
     */
    protected static $requireAuthorization = false;

    /**
     * commentsController constructor.
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

    /**
     * Create Resource.
     * Create a new comment resource.
     *
     * @authenticated
     *
     * @param \App\Http\Requests\CommentSaveRequest $request
     * @param \App\Models\Comment $comment
     *
     * @return JsonResponse
     */
    public function store(CommentSaveRequest $request, Comment $comment): JsonResponse
    {
        $comment->fill($request->only($comment->offsetGet('fillable')))
            ->save();

        $resource = (new CommentsResource($comment))
            ->additional(
                [
                    'status' => 201,
                    'message' => 'Created'
                ]
            );

        return $resource->toResponse($request)->setStatusCode(201);
    }

    /**
     * Update Resource.
     * Update a specific comment resource identified by the given id/key.
     *
     * @authenticated
     *
     * @urlParam comment required *integer* - No-example
     * The identifier of a specific comment resource.
     *
     * @param \App\Http\Requests\CommentSaveRequest $request
     * @param \App\Models\Comment  $comment
     *
     * @return CommentsResource
     */
    public function update(CommentSaveRequest $request, Comment  $comment): CommentsResource
    {
        $comment->fill($request->only($comment->offsetGet('fillable')));

        if ($comment->isDirty()) {
            $comment->save();
        }

        return (new CommentsResource($comment))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Success'
                ]
            );
    }

    /**
     * Delete Resource.
     * Delete a specific comment resource identified by the given id/key.
     *
     * @authenticated
     *
     * @urlParam comment required *integer* - No-example
     * The identifier of a specific comment resource.
     *
     * @param \App\Models\Comment $comment
     *
     * @throws \Exception
     *
     * @return CommentsResource
     */
    public function destroy(Comment $comment): CommentsResource
    {
        $comment->delete();

        return (new CommentsResource($comment))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Success'
                ]
            );
    }
}
