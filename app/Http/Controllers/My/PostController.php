<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use App\Services\ProfileService;

class PostController extends Controller
{
    public function index()
    {
        $posts = ProfileService::getMyPosts();

        return inertia('My/Post/Index', compact('posts'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validationData();

        PostService::store($data);

        return redirect(route('my.posts.index', absolute: false));
    }

    public function show(Post $post)
    {
        return PostResource::make($post)->resolve();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(
            [
                'message' => 'My post deleted'
            ]
        );
    }

    public function create()
    {
        $tagsTitles = Tag::All()->pluck('title')->toArray();

        return inertia('My/Post/Create', compact(['tagsTitles']));
    }

    public function edit(Post $post)
    {
        $post       = PostResource::make($post)->resolve();
        $tagsTitles = Tag::All()->pluck('title')->toArray();

        return inertia('My/Post/Edit', compact(['post', 'tagsTitles']));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validationData();
        PostService::update($post, $data);

        return redirect(route('my.posts.index', absolute: false));
    }
}
