<?php

namespace App\Actions\User;

use App\Models\User;
use App\Tasks\User\{
    GetUserByIdTask,
    UpdateUserTask
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateUserAction
{
    public function run(Request $request, User $user): User|Exception
    {
        DB::beginTransaction();

        try {
            app(UpdateUserTask::class)->run(request: $request, user: $user);

            $user = app(GetUserByIdTask::class)->run(userId: $user->id);

            DB::commit();

            return $user;
            //
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
