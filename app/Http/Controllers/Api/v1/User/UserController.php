<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Actions\Api\v1\GetAllUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\User\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = app(GetAllUsersAction::class)->run();
        return UserResource::collection($users);
    }
}
