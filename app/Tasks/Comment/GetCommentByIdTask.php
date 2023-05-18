<?php

namespace App\Tasks\Comment;

use App\Models\Comment;
use Exception;

class GetCommentByIdTask
{
    public function run(int $commentId): Comment|Exception
    {
        return Comment::findOrFail($commentId);
    }
}
