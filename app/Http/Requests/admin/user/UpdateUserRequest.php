<?php

namespace App\Http\Requests\admin\user;

use App\Enums\UserGender;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'phonenumber'   => ['required', 'digits:11'],
            'national_code' => ['required', 'digits:10', Rule::unique((new User())->getTable(), 'national_code')->ignore($this->user)],
            'gender'        => ['required', Rule::in(UserGender::values())],
            'email'         => ['required', 'string', 'email', 'max:255',Rule::unique((new User())->getTable(), 'email')->ignore($this->user)],
            'password'      => ['nullable', 'confirmed','min:8'],
            'thumbnail'     => ['nullable','image','mimes:jpg,png,jpeg,gif,svg', 'max:1024'],
        ];
    }
}
