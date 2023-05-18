<?php

namespace App\Tasks\User;

use App\Models\User;

class GetallUsersTask
{
    public function run()
    {
        return User::latest()->get();
    }
}
