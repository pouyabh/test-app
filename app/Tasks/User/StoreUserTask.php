<?php

namespace App\Tasks\User;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class StoreUserTask
{
    public function run(Request $request): int|Exception
    {
        return User::create([
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'phonenumber'   => $request->phonenumber,
            'national_code' => $request->national_code,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'password'      => $request->password,
            'image_path'    => $request->file('thumbnail')? $request->file('thumbnail')->store('thumbnails','public') : null,
        ])->id;

    }
}
