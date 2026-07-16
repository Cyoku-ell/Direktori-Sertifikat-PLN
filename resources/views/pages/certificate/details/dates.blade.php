<div class="bg-white rounded-3xl shadow-lg">

    {{-- Header --}}
    <div class="px-8 py-6 border-b">

        <h2 class="text-xl font-bold text-[#146379]">

            Informasi Tanggal

        </h2>

        <p class="text-gray-500 mt-1">

            Riwayat pelaksanaan dan masa berlaku sertifikat.

        </p>

    </div>

    {{-- Content --}}
    <div class="p-8">

        <div class="grid grid-cols-2 gap-6">

            {{-- Tanggal Terbit --}}
            <div>

                <label class="text-sm text-gray-500">

                    Tanggal Terbit

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->issue_date?->format('d F Y') ?? '-' }}

                </div>

            </div>

            {{-- Tanggal Expired --}}
            <div>

                <label class="text-sm text-gray-500">

                    Tanggal Expired

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->expired_at?->format('d F Y') ?? '-' }}

                </div>

            </div>

            {{-- Tanggal Mulai --}}
            <div>

                <label class="text-sm text-gray-500">

                    Tanggal Mulai Pelaksanaan

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificate->start_date?->format('d F Y') ?? '-' }}

                </div>

            </div>

            {{-- Tanggal Selesai --}}
            <div>

                <label class="text-sm text-gray-500">

                    Tanggal Selesai Pelaksanaan

                </label>

                <div class="mt-2 min-h-[44px] rounded-xl border bg-gray-50 px-4 py-3">

                    {{ $certificateend_date?->format('d F Y') ?? '-' }}

                </div>

            </div>

        </div>

        @if ($certificate->expired_at)

            @php

                $expired = \Carbon\Carbon::parse($certificate->expired_at);

            @endphp

            <div class="mt-8">

                <label class="text-sm text-gray-500">

                    Status Masa Berlaku

                </label>

                <div class="mt-3">

                    @if ($expired->isPast())
                        <div class="rounded-2xl bg-red-50 border border-red-200 p-4">

                            <div class="font-semibold text-red-700">

                                Sertifikat telah expired

                            </div>

                            <div class="text-red-600 text-sm mt-1">

                                Berakhir {{ $expired->diffForHumans() }}

                            </div>

                        </div>
                    @elseif($expired->diffInDays(now()) <= 30)
                        <div class="rounded-2xl bg-yellow-50 border border-yellow-200 p-4">

                            <div class="font-semibold text-yellow-700">

                                Sertifikat akan segera expired

                            </div>

                            <div class="text-yellow-600 text-sm mt-1">

                                Tersisa {{ now()->diffInDays($expired) }} hari lagi.

                            </div>

                        </div>
                    @else
                        <div class="rounded-2xl bg-green-50 border border-green-200 p-4">

                            <div class="font-semibold text-green-700">

                                Sertifikat masih aktif

                            </div>

                            <div class="text-green-600 text-sm mt-1">

                                Berlaku hingga {{ $expired->format('d F Y') }}

                            </div>

                        </div>
                    @endif

                </div>

            </div>

        @endif

    </div>

</div>
