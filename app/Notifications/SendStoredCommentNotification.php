<?php

namespace App\Notifications;

use App\Events\StoreCommentEvent;
use App\Mail\SendStoreComment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class SendStoredCommentNotification extends Notification
{
    use Queueable;

    public function handle(StoreCommentEvent $event)
    {
        // can use queue and setup another service (sms or slack)
        Mail::to($event->comment->user->email)->send(new SendStoreComment());
    }
}
