<?php

namespace App\Http\Controllers;


use App\Actions\LogActivity\GetAllLogActivitiesAction;
use App\Helpers\LogActivity;

class LogActivityController extends Controller
{
    public function index()
    {
        $logs = app(GetAllLogActivitiesAction::class)->run();
        return view('admin.log-activities', compact('logs'));
    }
}
