<?php

namespace App\Tasks\Api\v1;

use App\Models\User;

class GetallUsersTask
{
    public function run()
    {
        $users = User::all();
        return $users;
    }
}
