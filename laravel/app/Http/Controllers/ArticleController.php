<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;

class ArticleController extends Controller
{
    public function createArticle(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $article = Article::create([
            'author_id' => $request->author_id,
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'Article created',
            'article' => $article,
        ], 201);
    }

   public function getArticlesBySao()
{
    $author = Author::where('name', 'Sao')->first();

    if (!$author) {
        return response()->json(['message' => 'Author not found'], 404);
    }

    $articles = $author->articles;

    return response()->json($articles);
}
}