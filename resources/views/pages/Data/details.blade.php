@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- Title --}}
    <div class="bg-white rounded-3xl shadow-lg p-8 mb-6">

        <h1 class="text-3xl font-bold text-[#146379]">
            Detail Sertifikat
        </h1>

        <p class="text-gray-500 mt-2">
            Informasi lengkap sertifikat.
        </p>

    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        {{-- PDF Preview --}}
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

            <div class="px-6 py-4 border-b">

                <h2 class="font-semibold text-lg">
                    Preview PDF
                </h2>

            </div>

            <iframe
                src="{{ asset('storage/certificates/' . $certificate->file) }}"
                class="w-full h-[700px]">
            </iframe>

        </div>

        {{-- Detail Card --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <div class="flex justify-between items-center mb-8">

                <h2 class="text-xl font-bold text-[#146379]">
                    Certificate Information
                </h2>

                <span class="bg-[#199db7]/10 text-[#199db7] px-4 py-2 rounded-full text-sm">

                    Uploaded

                </span>

            </div>

            <div class="space-y-6">

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Name
                    </span>

                    <span class="font-semibold">
                        {{ $certificate->name }}
                    </span>

                </div>

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        NIP
                    </span>

                    <span class="font-semibold">
                        {{ $certificate->nip }}
                    </span>

                </div>

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Unit
                    </span>

                    <span class="font-semibold">
                        {{ $certificate->unit->name }}
                    </span>

                </div>

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Certification
                    </span>

                    <span class="font-semibold">
                        {{ $certificate->certification->name }}
                    </span>

                </div>

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Uploaded By
                    </span>

                    <span class="font-semibold">
                        {{ $certificate->user->name }}
                    </span>

                </div>

                <div class="flex justify-between border-b pb-3">

                    <span class="text-gray-500">
                        Upload Date
                    </span>

                    <span class="font-semibold">
                        {{ $certificate->created_at->format('d M Y H:i') }}
                    </span>

                </div>

                @if($certificate->remarks)

                <div>

                    <p class="text-gray-500 mb-2">
                        Remarks
                    </p>

                    <div class="bg-gray-100 rounded-xl p-4">

                        {{ $certificate->remarks }}

                    </div>

                </div>

                @endif

            </div>

            {{-- Button --}}
            <div class="flex justify-end gap-3 mt-10">

                <a
                    href="{{ asset('storage/certificates/'.$certificate->file) }}"
                    target="_blank"
                    class="px-6 py-3 rounded-xl bg-[#199db7] text-white hover:bg-[#146379] transition">

                    <i class="fa fa-download mr-2"></i>

                    Download PDF

                </a>

                <a
                    href="{{ route('certificates.index') }}"
                    class="px-6 py-3 rounded-xl border hover:bg-gray-100 transition">

                    Back

                </a>

            </div>

        </div>

    </div>

</div>

@endsection