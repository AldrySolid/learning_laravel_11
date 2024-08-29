<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\Comment\StoreRequest as CommentStoreRequest;
use App\Http\Requests\Post\Comment\ChildStoreRequest as ChildCommentStoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProfileResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Services\CommentService;
use App\Services\PostService;

class PostController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validationData();

        $posts    = PostService::index($data);
        $profiles = ProfileResource::collection(Profile::all())->resolve();

        return $request->wantsJson()
            ? $posts
            : inertia('Post/Index', compact('posts', 'profiles'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validationData();

        PostService::store($data);

        return redirect(route('posts.index', absolute: false));
    }

    public function commentStore(Post $post, CommentStoreRequest $request)
    {
        $data = $request->validationData();

        $comment = CommentService::store($post, $data);

        return $comment;
    }

    public function childCommentStore(Post $post, int $parentCommentId, ChildCommentStoreRequest $request)
    {
        $data = $request->validationData();

        $parentComment = Comment::findOrFail($parentCommentId);

        $comment = CommentService::store($parentComment, $data);

        return $comment;
    }

    public function show(Post $post)
    {
        $post = PostResource::make($post)->resolve();

        return inertia('Post/Show', compact('post', 'post'));
    }

    public function destroy(Post $post)
    {
        PostService::delete($post);

        return response()->json(
            [
                'message' => 'Post deleted'
            ]
        );
    }

    public function create()
    {
        $tagsTitles = Tag::All()->pluck('title')->toArray();

        return inertia('Post/Create', compact(['tagsTitles']));
    }

    public function edit(Post $post)
    {
        $post       = PostResource::make($post)->resolve();
        $tagsTitles = Tag::All()->pluck('title')->toArray();

        return inertia('Post/Edit', compact(['post', 'tagsTitles']));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validationData();
        PostService::update($post, $data);

        return redirect(route('posts.index', absolute: false));
    }
}
