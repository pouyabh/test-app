<?php

namespace App\Http\Controllers\ActivityLog;


use App\Actions\LogActivity\GetAllLogActivitiesAction;
use App\Http\Controllers\Controller;

class LogActivityController extends Controller
{
    public function index()
    {
        $logs = app(GetAllLogActivitiesAction::class)->run();
        return view('admin.log-activities', compact('logs'));
    }
}
