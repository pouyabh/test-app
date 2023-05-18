<?php

namespace App\Tasks\LogActivity;

use App\Helpers\LogActivity;

class GetAllLogActivitiesTask
{
    public function run()
    {
        return LogActivity::logActivityLists();
    }
}
