<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data    = $request->validated();
        $builder = Post::filter($data);

        return PostResource::collection($builder->get())->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);

        return PostResource::make($post)->resolve();
    }

    public function show(Post $post)
    {
        return PostResource::make($post)->resolve();
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);

        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(
            [
                'message' => 'Post deleted'
            ]
        );
    }
}
