<?php

namespace App\Actions\User;

use App\Tasks\User\GetallUsersTask;

class GetAllUsersAction
{
    public function run()
    {
        $users = app(GetallUsersTask::class)->run();
        return $users;
    }
}
