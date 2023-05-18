<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\admin\user\{
    StoreUserRequest,
    UpdateUserRequest
};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->sortByDesc('created_at');
        return view('admin.user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create([
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'phonenumber'   => $request->phonenumber,
            'national_code' => $request->national_code,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'password'      => $request->password,
            'image_path'    => $request->file('thumbnail')? $request->file('thumbnail')->store('thumbnails','public') : null,
        ]);

        return redirect()->back()->with([ 'message' => __('messages.success')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
                'name'          => $request->name,
                'lastname'      => $request->lastname,
                'phonenumber'   => $request->phonenumber,
                'national_code' => $request->national_code,
                'gender'        => $request->gender,
                'email'         => $request->email,
                'password'      => $request->has('password') ? bcrypt($request->password):$user->password,
                'image_path'    => $request->file('thumbnail') ? $request->file('thumbnail')->store('thumbnails','public') : $user->image_path,
        ]);

        return redirect()->back()->with([ 'message' => __('messages.success')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->deleteOrFail();
        return redirect()->back();
    }
}
