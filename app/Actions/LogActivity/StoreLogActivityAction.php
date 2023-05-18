<?php

namespace App\Actions\LogActivity;

use App\Tasks\LogActivity\StoreLogActivityTask;
use Illuminate\Support\Facades\DB;
use Exception;

class StoreLogActivityAction
{
    public function run(string $subject)
    {

        DB::beginTransaction();

        try {
            $log = app(StoreLogActivityTask::class)->run(subject: $subject);

            DB::commit();

            return $log;
            //
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
