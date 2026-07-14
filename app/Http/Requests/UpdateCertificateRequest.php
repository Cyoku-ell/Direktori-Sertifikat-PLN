<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCertificateRequest extends FormRequest
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

            'certificate_number' => [

                'required',

                'string',

                Rule::unique('certificates', 'certificate_number')
                    ->ignore($this->route('certificate')->id),

            ],

            'registration_number' => 'nullable|string',

            'institution' => 'required|string|max:255',

            'accreditor' => 'required|string|max:255',

            'issue_date' => 'required|date',

            'start_date' => 'nullable|date',

            'end_date' => 'nullable|date',

            'expired_at' => 'nullable|date|after_or_equal:issue_date',

            'remarks' => 'nullable|string',

            'pdf' => 'nullable|file|mimes:pdf|max:10240',

        ];
    }

    public function messages(): array
    {
        return [

            'certificate_number.unique' =>
            'Nomor sertifikat sudah digunakan.',

            'expired_at.after_or_equal' =>
            'Tanggal expired harus setelah tanggal terbit.',

        ];
    }
}
