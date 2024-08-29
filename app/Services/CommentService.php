<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

abstract class CommentService
{
    /**
     * @param Model $model
     * @param array $data
     *
     * @return Comment
     */
    public static function store(Model $model, array $data): Comment
    {
        $comment = Comment::make($data);
        $comment->commentable()->associate($model);
        $comment->save();

        return $comment;
    }
}
