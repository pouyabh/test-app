<?php

namespace App\Tasks\LogActivity;

use App\Jobs\LogActivityJob;
use Illuminate\Support\Facades\Request;

class StoreLogActivityTask
{
    public function run(string $subject)
    {
        return LogActivityJob::dispatch(subject: $subject, url: Request::url(), method: Request::method(), ip: Request::ip(), agent: Request::header('user-agent'), adminID: auth()->user()->id);
    }
}
