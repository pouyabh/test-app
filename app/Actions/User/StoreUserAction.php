<?php

namespace App\Actions\User;

use App\Tasks\User\GetUserByIdTask;
use App\Tasks\User\StoreUserTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreUserAction
{
    public function run(Request $request)
    {
        DB::beginTransaction();

        try {
            $userID = app(StoreUserTask::class)->run(request: $request);
            $user = app(GetUserByIdTask::class)->run(userId: $userID);

            DB::commit();

            return $user;
            //
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
