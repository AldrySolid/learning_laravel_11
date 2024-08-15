<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = PostResource::collection(Post::all()->sortDesc())->resolve();

        return inertia('Post/Index', compact('posts'));
    }

    public function store(StoreRequest $request)
    {
        $data                = $request->validated();
        $data['profile_id']  = 1;
        $data['category_id'] = 1;

        Post::create($data);

        return redirect(route('posts.index', absolute: false));
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
                'message' => 'Post deleted'
            ]
        );
    }

    public function create()
    {
        return inertia('Post/Create');
    }

    public function edit(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        $tags = Tag::All()->pluck('title', 'id')->toArray();

        return inertia('Post/Edit', compact(['post', 'tags']));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);

        return redirect(route('posts.index', absolute: false));
    }
}
