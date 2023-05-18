<?php

namespace App\Tasks\Comment;

use App\Models\Comment;
use Illuminate\Http\Request;
use Exception;

class UpdateCommentTask
{
    public function run(Request $request, Comment $comment): bool|Exception
    {
        return $comment->update([
            'status' => $request->status
        ]);

    }
}
