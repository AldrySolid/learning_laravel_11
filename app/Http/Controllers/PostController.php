<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = PostResource::collection(Post::all())->resolve();

        return inertia('Post/Index', compact('posts'));
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['profile_id'] = 1;
        $data['category_id'] = 1;
        $post = Post::create($data);

        return $post;
    }

    public function show(Post $post)
    {
        return PostResource::make($post)->resolve();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return Response::HTTP_NO_CONTENT;
    }

    public function create()
    {
        return inertia('Post/Create');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
}
