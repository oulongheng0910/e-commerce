<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Audience;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',  // e.g., 'App\Models\Article'
        ]);

        $comment = Comment::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'content' => $request->content,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
        ]);

        return response()->json([
            'message' => 'Comment created',
            'comment' => $comment,
        ], 201);
    }

   public function getCommentsOfSamnang()
{
    $audience = Audience::where('name', 'Samnang')->first();

    if (!$audience) {
        return response()->json(['message' => 'Audience not found'], 404);
    }

    $comments = $audience->comments;

    return response()->json($comments);
}

public function getCommentsWithTopic()
{
    $comments = Comment::with('commentable')->get();

    $result = $comments->map(function ($comment) {
        $topic = $comment->commentable;

        $topicType = class_basename($topic); // Article, Author, or Audience
        $topicName = $topic->name ?? 'Unknown';

        return [
            'comment_id' => $comment->id,
            'content' => $comment->content,
            'topic_type' => $topicType,
            'topic_name' => $topicName,
        ];
    });

    return response()->json($result);
}
}