<?php

namespace App\Tasks\Comment;

use App\Models\Comment;
use Illuminate\Http\Request;
use Exception;

class StoreReplyTask
{
    public function run(Request $request, Comment $comment): int|Exception
    {
        return Comment::create([
            'parent_id' => $comment->id,
            'admin_id'  => auth()->user()->id,
            'text'      => $request->text
        ])->id;
    }
}
