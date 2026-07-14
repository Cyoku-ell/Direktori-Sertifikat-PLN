<div class="bg-white rounded-3xl shadow-lg">

    {{-- Header --}}
    <div class="px-8 py-6 border-b">

        <h2 class="text-xl font-bold text-[#146379]">

            Dokumen Sertifikat

        </h2>

        <p class="text-gray-500 mt-1">

            File PDF sertifikat yang telah diunggah.

        </p>

    </div>

    {{-- Content --}}
    <div class="p-8">

        @if ($certificate->pdf)
            <div class="border-2 border-dashed border-[#199db7] rounded-2xl p-10">

                <div class="flex flex-col items-center text-center">

                    <i class="fa-solid fa-file-pdf text-7xl text-red-500"></i>

                    <h3 class="mt-5 text-xl font-semibold">

                        Dokumen Sertifikat

                    </h3>

                    <p class="mt-2 text-gray-500">

                        File PDF berhasil diupload.

                    </p>

                    <div class="mt-8 flex gap-4">

                        <a href="{{ asset('storage/' . $certificate->pdf) }}" target="_blank"
                            class="px-6 py-3
                            rounded-xl
                            border
                            hover:bg-gray-100
                            transition">

                            <i class="fa-solid fa-eye mr-2"></i>

                            Lihat PDF

                        </a>

                        <a href="{{ asset('storage/' . $certificate->pdf) }}" download
                            class="px-6 py-3
                            rounded-xl
                            bg-[#199db7]
                            hover:bg-[#146379]
                            text-white
                            transition">

                            <i class="fa-solid fa-download mr-2"></i>

                            Download

                        </a>

                    </div>

                </div>

            </div>
        @else
            <div
                class="rounded-2xl
                border-2
                border-dashed
                border-gray-300
                p-12
                text-center">

                <i class="fa-solid fa-file-circle-xmark text-6xl text-gray-400"></i>

                <h3 class="mt-5 text-lg font-semibold text-gray-600">

                    Belum ada dokumen

                </h3>

                <p class="mt-2 text-gray-500">

                    Sertifikat ini belum memiliki file PDF.

                </p>

            </div>
        @endif

    </div>

</div>
