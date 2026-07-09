<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->route('user');

        return [

            'email' => 'required|email|unique:users,email,' . $user->id,

            'nip' => 'required|string|unique:users,nip,' . $user->id,

            'perner' => 'required|string|unique:users,perner,' . $user->id,

            'position_id' => 'required|exists:positions,id',

            'unit_id' => 'required|exists:units,id',

            'status' => 'required|string',

            'role' => 'required|in:admin,user',

            'password' => 'nullable|string|min:8',

        ];
    }
}
