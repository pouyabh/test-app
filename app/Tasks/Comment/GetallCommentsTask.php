<?php

namespace App\Tasks\Comment;

use App\Models\Comment;

class GetallCommentsTask
{
    public function run()
    {
        return Comment::latest()->get();
    }
}
