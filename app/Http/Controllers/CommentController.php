<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request, Article $article)
    {
        $createdComment = $article->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->validated('body'),
            'parent_id' => $request->validated('parent_id'),
        ]);

        return createToast('back', 'دیدگاه', $createdComment);
    }
}
