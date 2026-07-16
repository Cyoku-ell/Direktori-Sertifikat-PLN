<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'email' => 'required|email|unique:users,email',

            'nip' => 'required|string|unique:users,nip',

            'perner' => 'required|string|unique:users,perner',

            'position_id' => 'required|exists:positions,id',

            'unit_id' => 'required|exists:units,id',

            'status' => 'required|string',

            'role' => 'required|in:admin,user',

            'password' => 'required|string|min:8',

        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Isi EMAIL Pegawai',
            'nip.required' => 'Isi NIP Pegawai',
            'perner.required' => 'isi PERNER Pegawai',
            'position_id.required' => 'isi JABATAN pegawai',
            'status.required' => 'isi STATUS pegawai',
            'password.required' => 'isi PASSWORD pegawai',
        ];
    }
}
