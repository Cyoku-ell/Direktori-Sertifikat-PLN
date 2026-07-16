<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    {{-- HEADER --}}
    <div class="px-8 py-6 border-b">

        <div class="flex justify-between items-start">

            <div>

                <a href="{{ route('certificates.index') }}"
                    class="inline-flex items-center
                    text-[#199db7]
                    hover:text-[#146379]
                    transition">

                    <i class="fa-solid fa-arrow-left mr-2"></i>

                    Kembali ke Daftar Sertifikat

                </a>

                <h1 class="text-3xl font-bold text-[#146379] mt-5">

                    {{ $certificate->title }}

                </h1>

                <p class="text-gray-500 mt-2">

                    Nomor Sertifikat

                    <span class="font-semibold text-gray-700">

                        {{ $certificate->certificate_number }}

                    </span>

                </p>

            </div>

            <div class="flex gap-3">

                @php

                    $expired = $certificate->expired_at ? \Carbon\Carbon::parse($certificate->expired_at) : null;

                @endphp

                {{-- Status Expired --}}
                @if (!$expired)
                    <span
                        class="px-4 py-2 rounded-xl
                        bg-gray-100
                        text-gray-600
                        text-sm font-semibold">

                        Tidak Ada Expired

                    </span>
                @elseif($expired->isPast())
                    <span
                        class="px-4 py-2 rounded-xl
                        bg-red-100
                        text-red-700
                        text-sm font-semibold">

                        Expired

                    </span>
                @elseif($expired->diffInDays(now()) <= 30)
                    <span
                        class="px-4 py-2 rounded-xl
                        bg-yellow-100
                        text-yellow-700
                        text-sm font-semibold">

                        Hampir Expired

                    </span>
                @else
                    <span
                        class="px-4 py-2 rounded-xl
                        bg-green-100
                        text-green-700
                        text-sm font-semibold">

                        Aktif

                    </span>
                @endif

                {{-- Sinkronisasi --}}
                @if ($certificate->is_matched)
                    <span
                        class="px-4 py-2 rounded-xl
                        bg-sky-100
                        text-sky-700
                        text-sm font-semibold">

                        Sinkron

                    </span>
                @else
                    <span
                        class="px-4 py-2 rounded-xl
                        bg-orange-100
                        text-orange-700
                        text-sm font-semibold">

                        Belum Sinkron

                    </span>
                @endif

            </div>

        </div>

    </div>

    {{-- ACTION --}}
    <div class="px-8 py-5 bg-gray-50">

        <div class="flex justify-end gap-3">

            @if ($certificate->pdf)
                <a href="{{ asset('storage/' . $certificate->pdf) }}" target="_blank"
                    class="px-5 py-2.5
                    rounded-xl
                    border
                    hover:bg-white
                    transition">

                    <i class="fa-solid fa-file-pdf mr-2 text-red-500"></i>

                    Lihat PDF

                </a>
            @endif

        </div>

    </div>

</div>
