<?php

namespace App\Jobs;

use App\Helpers\LogActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subject;
    public $url;
    public $method;
    public $adminID;
    public $ip;
    public $agent;


    /**
     * Create a new job instance.
     */
    public function __construct($subject, $url, $method, $adminID, $agent, $ip)
    {
        $this->subject = $subject;
        $this->url = $url;
        $this->method = $method;
        $this->adminID = $adminID;
        $this->agent = $agent;
        $this->ip = $ip;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        LogActivity::addToLog(
            subject: $this->subject,
            adminID: $this->adminID,
            method: $this->method,
            ip: $this->ip
            , agent: $this->agent,
            url: $this->url
        );
    }
}
