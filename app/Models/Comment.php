<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'parent_id',
        'text',
        'admin_id',
        'user_id',
    ];

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
