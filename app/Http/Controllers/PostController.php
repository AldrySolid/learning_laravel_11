<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        PostResource::collection(Post::all())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = [
            'title'          => fake()->jobTitle(),
            'content'        => fake()->realText(255),
            'profile_id'     => User::inRandomOrder()->get()->first()->id,
            'is_commentable' => 1,
        ];

        return Post::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Response::HTTP_NO_CONTENT;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
