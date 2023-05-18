<?php

namespace App\Tasks\User;

use App\Models\User;
use Exception;

class GetUserByIdTask
{
    public function run(int $userId): User|Exception
    {
        return User::findOrFail($userId);
    }
}
