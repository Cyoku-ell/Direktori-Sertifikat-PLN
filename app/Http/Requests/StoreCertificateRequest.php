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

            'name' => 'required|string|max:255',

            'nip' => 'required|string|max:30',

            'unit_id' => 'required|exists:units,id',

            'certification_id' => 'required|exists:certifications,id',

            'file' => 'required|mimes:pdf|max:5120',

        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'Nama wajib diisi.',

            'nip.required' => 'NIP wajib diisi.',

            'unit_id.required' => 'Pilih unit.',

            'certification_id.required' => 'Pilih sertifikasi.',

            'file.required' => 'Upload PDF.',

            'file.mimes' => 'File harus PDF.',

            'file.max' => 'Ukuran maksimal 5 MB.'

        ];
    }
}
