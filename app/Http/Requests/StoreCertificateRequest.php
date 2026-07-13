<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'perner' => 'required|string',

            'title' => 'required|string|max:255',

            'certificate_number' => 'required|string|unique:certificates,certificate_number',

            'registration_number' => 'nullable|string',

            'institution' => 'required|string|max:255',

            'accreditor' => 'required|string|max:255',

            'issue_date' => 'required|date',

            'start_date' => 'nullable|date',

            'end_date' => 'nullable|date',

            'expired_at' => 'nullable|date|after_or_equal:issue_date',

            'remarks' => 'nullable|string',

            'pdf' => 'nullable|mimes:pdf|max:10240',

        ];
    }
}
