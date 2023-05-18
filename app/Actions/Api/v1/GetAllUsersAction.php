<?php

namespace App\Actions\Api\v1;


use App\Tasks\Api\v1\GetallUsersTask;

class GetAllUsersAction
{
    public function run()
    {
        $users = app(GetallUsersTask::class)->run();

        $users->load('comments.replies');

        return $users;
    }
}
