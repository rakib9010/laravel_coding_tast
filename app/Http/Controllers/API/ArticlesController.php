<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticlesResource;
use App\Http\Requests\StoreArticleRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return ArticlesResource::collection(
            Article::whereRaw('expired IS NULL OR expired > NOW()')->get()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return ArticlesResource
     */
    public function get(Article $article)
    {

        return new ArticlesResource($article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreArticleRequest $request
     * @return ArticlesResource
     */
    public function store(StoreArticleRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $data['publication_date'] ??= null;
        $data['publication_date'] ??= null;

        $article = Article::create($data);

        return new ArticlesResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreArticleRequest $request
     * @param  Article $article
     * @return ArticlesResource
     */
    public function update(Article $article, StoreArticleRequest $request)
    {
        $request->validated();

        $article->title = $request->title;
        $article->author = $request->author;
        $article->description = $request->description;
        $article->publication_date = $request->publication_date ?: $article->publication_date;
        $article->save();

        return new ArticlesResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function delete(Article $article)
    {
        return $article->delete();
    }
}
