<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

    public function messages(): array
    {
        return [

            'perner.required' => 'PERNER wajib diisi.',
            'perner.string' => 'PERNER tidak valid.',

            'title.required' => 'Nama sertifikat wajib diisi.',
            'title.string' => 'Nama sertifikat tidak valid.',
            'title.max' => 'Nama sertifikat maksimal 255 karakter.',

            'certificate_number.required' => 'Nomor sertifikat wajib diisi.',
            'certificate_number.string' => 'Nomor sertifikat tidak valid.',
            'certificate_number.unique' => 'Nomor sertifikat sudah digunakan.',

            'registration_number.string' => 'Nomor registrasi tidak valid.',

            'institution.required' => 'Lembaga sertifikasi wajib diisi.',
            'institution.string' => 'Lembaga sertifikasi tidak valid.',
            'institution.max' => 'Lembaga sertifikasi maksimal 255 karakter.',

            'accreditor.required' => 'Akreditor wajib diisi.',
            'accreditor.string' => 'Akreditor tidak valid.',
            'accreditor.max' => 'Akreditor maksimal 255 karakter.',

            'issue_date.required' => 'Tanggal terbit sertifikat wajib diisi.',
            'issue_date.date' => 'Tanggal terbit sertifikat tidak valid.',

            'start_date.date' => 'Tanggal mulai pelaksanaan tidak valid.',

            'end_date.date' => 'Tanggal selesai pelaksanaan tidak valid.',

            'expired_at.date' => 'Tanggal expired tidak valid.',
            'expired_at.after_or_equal' => 'Tanggal expired harus sama atau setelah tanggal terbit sertifikat.',

            'remarks.string' => 'Catatan tidak valid.',

            'pdf.mimes' => 'File harus berformat PDF.',
            'pdf.max' => 'Ukuran file PDF maksimal 10 MB.',

        ];
    }
}
