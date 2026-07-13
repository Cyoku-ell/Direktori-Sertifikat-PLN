<?php

namespace App\Http\Requests\Certificate;

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

            // ===========================
            // Owner
            // ===========================

            'perner' => [
                'required',
                'string',
                'max:50',
            ],

            // ===========================
            // Certificate
            // ===========================

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'certificate_number' => [
                'required',
                'string',
                'max:255',
                'unique:certificates,certificate_number',
            ],

            'registration_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'institution' => [
                'required',
                'string',
                'max:255',
            ],

            'accreditor' => [
                'required',
                'string',
                'max:255',
            ],

            // ===========================
            // Date
            // ===========================

            'issue_date' => [
                'required',
                'date',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
            ],

            'expired_at' => [
                'nullable',
                'date',
                'after_or_equal:issue_date',
            ],

            // ===========================
            // File
            // ===========================

            'pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            // ===========================
            // Remarks
            // ===========================

            'remarks' => [
                'nullable',
                'string',
            ],

        ];
    }
}
