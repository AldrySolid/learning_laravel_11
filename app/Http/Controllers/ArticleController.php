<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = ArticleResource::collection(Article::all())->resolve();

        return inertia('Article/Index', compact('articles'));
    }

    public function store(ArticleRequest $request)
    {
        $data = $request->validated();
        $data['profile_id'] = 1;
        $data['category_id'] = 1;
        $post = Article::create($data);

        return $post;
    }

    public function show(Article $post)
    {
        return ArticleResource::make($post)->resolve();
    }

    public function destroy(Article $post)
    {
        $post->delete();

        return Response::HTTP_NO_CONTENT;
    }

    public function create()
    {
        return inertia('Article/Create');
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
