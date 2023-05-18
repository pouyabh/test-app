<?php


namespace App\Helpers;

use App\Models\LogActivity as LogActivityModel;

class LogActivity
{
    public static function addToLog($subject, $url, $method, $ip, $agent, $adminID)
    {
        $log = [];

        $log['subject'] = $subject;
        $log['url'] = $url;
        $log['method'] = $method;
        $log['ip'] = $ip;
        $log['agent'] = $agent;
        $log['admin_id'] = $adminID;

        LogActivityModel::create($log);
    }

    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }

}
