<div class="bg-white rounded-3xl shadow-lg">

    {{-- Header --}}
    <div class="px-8 py-6 border-b">

        <h2 class="text-xl font-bold text-[#146379]">

            Informasi Sertifikat

        </h2>

        <p class="text-gray-500 mt-1">

            Detail utama sertifikat.

        </p>

    </div>

    {{-- Content --}}
    <div class="p-8">

        <div class="grid grid-cols-2 gap-6">

            {{-- Nama Sertifikat --}}
            <div class="col-span-2">

                <label class="text-sm text-gray-500">

                    Nama Sertifikat

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->title }}

                </div>

            </div>

            {{-- Nomor Sertifikat --}}
            <div>

                <label class="text-sm text-gray-500">

                    Nomor Sertifikat

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->certificate_number }}

                </div>

            </div>

            {{-- Nomor Registrasi --}}
            <div>

                <label class="text-sm text-gray-500">

                    Nomor Registrasi

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->registration_number ?: '-' }}

                </div>

            </div>

            {{-- Instansi --}}
            <div>

                <label class="text-sm text-gray-500">

                    Instansi

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->institution }}

                </div>

            </div>

            {{-- Lembaga Akreditasi --}}
            <div>

                <label class="text-sm text-gray-500">

                    Lembaga Akreditasi

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->accreditor }}

                </div>

            </div>

        </div>

    </div>

</div>
