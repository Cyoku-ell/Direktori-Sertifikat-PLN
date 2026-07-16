<div class="bg-white rounded-3xl shadow-lg">

    {{-- Header --}}
    <div class="px-8 py-6 border-b">

        <h2 class="text-xl font-bold text-[#146379]">

            Informasi Pemilik

        </h2>

        <p class="text-gray-500 mt-1">

            Data pegawai yang memiliki sertifikat ini.

        </p>

    </div>

    {{-- Content --}}
    <div class="p-8">

        <div class="grid grid-cols-2 gap-6">

            {{-- Username --}}
            <div>

                <label class="text-sm text-gray-500">

                    Username

                </label>

                <div class="mt-2 h-11 rounded-xl bg-gray-50 border px-4 flex items-center">

                    {{ $certificate->user?->username ?? '-' }}

                </div>

            </div>

            {{-- PERNER --}}
            <div>

                <label class="text-sm text-gray-500">

                    PERNER

                </label>

                <div class="mt-2 h-11 rounded-xl bg-gray-50 border px-4 flex items-center">

                    {{ $certificate->perner }}

                </div>

            </div>

            {{-- Unit --}}
            <div>

                <label class="text-sm text-gray-500">

                    Unit

                </label>

                <div class="mt-2 h-11 rounded-xl bg-gray-50 border px-4 flex items-center">

                    {{ $certificate->user?->unit?->name ?? '-' }}

                </div>

            </div>

            {{-- Jabatan --}}
            <div>

                <label class="text-sm text-gray-500">

                    Jabatan

                </label>

                <div class="mt-2 h-11 rounded-xl bg-gray-50 border px-4 flex items-center">

                    {{ $certificate->user?->position?->name ?? '-' }}

                </div>

            </div>

        </div>

        {{-- Status Sinkronisasi --}}
        <div class="mt-6">

            <label class="text-sm text-gray-500">

                Status Sinkronisasi

            </label>

            <div class="mt-2">

                @include('pages.certificate.partials.badge', [
                    'certificate' => $certificate,
                ])
            </div>

        </div>

    </div>

</div>
