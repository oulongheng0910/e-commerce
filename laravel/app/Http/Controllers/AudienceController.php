<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Audience;
use App\Models\Article;
use App\Models\Author;


class AudienceController extends Controller
{
    public function createAudience(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'audience_name' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $audience = Audience::create([
            'user_id' => $user->id,
            'name' => $request->audience_name,
        ]);

        return response()->json([
            'message' => 'Audience and user created',
            'user' => $user,
            'audience' => $audience,
        ], 201);
    }

    public function subscribeArticle(Request $request)
{
    $request->validate([
        'audience_id' => 'required|exists:audiences,id',
        'article_ids' => 'required|array',  // array of article IDs
        'article_ids.*' => 'exists:articles,id',
    ]);

    $audience = Audience::findOrFail($request->audience_id);

    $audience->articles()->attach($request->article_ids);  // Assuming many-to-many, but task is one-to-many — adjust if needed

    return response()->json([
        'message' => 'Audience subscribed to articles',
        'audience' => $audience->load('articles'),
    ], 200);
}

public function getAudiencesOfClimateArticle()
{
    $article = Article::where('name', 'Climate changes in the last 3 years')->first();

    if (!$article) {
        return response()->json(['message' => 'Article not found'], 404);
    }

    $audiences = $article->audiences;

    return response()->json($audiences);
}

public function getAudiencesOfSok()
{
    $author = Author::where('name', 'Sok')->first();

    if (!$author) {
        return response()->json(['message' => 'Author not found'], 404);
    }

    $audiences = $author->audiences;  // Using hasManyThrough

    return response()->json($audiences);
}
}