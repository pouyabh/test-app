<?php

namespace App\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class StoreCommentEvent
{

    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var Authenticatable
     */
    public $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }
}
