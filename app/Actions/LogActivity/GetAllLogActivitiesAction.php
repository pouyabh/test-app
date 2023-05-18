<?php

namespace App\Actions\LogActivity;

use App\Tasks\LogActivity\GetAllLogActivitiesTask;

class GetAllLogActivitiesAction
{
    public function run()
    {

        $logs = app(GetAllLogActivitiesTask::class)->run();


        return $logs;

    }

}
