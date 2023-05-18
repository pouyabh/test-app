<?php

namespace App\Actions\Comment;


use App\Tasks\Comment\GetallCommentsTask;

class GetAllCommentsAction
{
    public function run()
    {
        $comments = app(GetallCommentsTask::class)->run();
        return $comments;
    }
}
