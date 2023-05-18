<?php

namespace App\Tasks\User;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class UpdateUserTask
{
    public function run(Request $request, User $user): bool|Exception
    {
        return $user->update([
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'phonenumber'   => $request->phonenumber,
            'national_code' => $request->national_code,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'password'      => $request->has('password') ? bcrypt($request->password):$user->password,
            'image_path'    => $request->file('thumbnail') ? $request->file('thumbnail')->store('thumbnails','public') : $user->image_path,
        ]);

    }
}
