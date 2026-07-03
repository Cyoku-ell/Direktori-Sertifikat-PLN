<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',

            'nip' => 'required|string|max:50',

            'unit_id' => 'required|exists:units,id',

            'certification_id' => 'required|exists:certifications,id',

            'file' => 'nullable|mimes:pdf|max:5120',

        ];
    }
}
