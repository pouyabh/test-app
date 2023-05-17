<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserGender;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredAdminController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'phonenumber'   => ['required', 'digits:11'],
            'national_code' => ['required', 'digits:10', Rule::unique((new User())->getTable(), 'national_code')],
            'gender'        => ['required', Rule::in(UserGender::values())],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Admin::create([
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'phonenumber'   => $request->phonenumber,
            'national_code' => $request->national_code,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
}
