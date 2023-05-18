<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $fillable = [
        'subject',
        'url',
        'method',
        'ip',
        'agent',
        'admin_id',
    ];

    use HasFactory;

    /**
     * relationships section
     */

    /**
     * attributes section
     */

    /**
     * scopes section
     */

    /**
     * custom functions section
     */
}
