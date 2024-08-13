<?php

// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'news_id' => 'required|integer|exists:news,id',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'news_id' => $request->news_id,
            'content' => $request->comment,
        ]);

        return response()->json(['comment' => $comment->load('user')]);
    }

    public function index(News $newsItem)
    {
        $comments = $newsItem->comments()->with('user')->get();

        return response()->json(['comments' => $comments]);
    }

    public function getComments($newsId, $offset = 0, $limit = 10)
    {
        $comments = Comment::where('news_id', $newsId)
            ->skip($offset)
            ->take($limit)
            ->with('user') // Pour charger les utilisateurs associés aux commentaires
            ->get();

        return response()->json(['comments' => $comments]);
    }
}
