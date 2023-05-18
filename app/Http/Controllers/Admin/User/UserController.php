<?php

namespace App\Http\Controllers\Admin\User;

use App\Actions\LogActivity\StoreLogActivityAction;
use App\Actions\User\{
    GetAllUsersAction,
    StoreUserAction,
    UpdateUserAction
};
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\user\{StoreUserRequest, UpdateUserRequest};
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = app(GetAllUsersAction::class)->run();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = app(StoreUserAction::class)->run(request: $request);

        app(StoreLogActivityAction::class)->run(subject: 'user created successfully');

        return redirect()->back()->with(['message' => __('messages.success')]);
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

        app(UpdateUserAction::class)->run(request: $request, user: $user);

        app(StoreLogActivityAction::class)->run(subject: 'user updated successfully');

        return redirect()->back()->with(['message' => __('messages.success')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->deleteOrFail();

        app(StoreLogActivityAction::class)->run(subject: 'user deleted successfully');

        return redirect()->back();
    }
}
