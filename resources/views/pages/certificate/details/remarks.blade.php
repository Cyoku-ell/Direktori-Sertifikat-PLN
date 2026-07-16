<div class="bg-white rounded-3xl shadow-lg">

    {{-- Header --}}
    <div class="px-8 py-6 border-b">

        <h2 class="text-xl font-bold text-[#146379]">

            Catatan

        </h2>

        <p class="text-gray-500 mt-1">

            Catatan tambahan mengenai sertifikat.

        </p>

    </div>

    {{-- Content --}}
    <div class="p-8">

        @if ($certificate->remarks)
            <div
                class="rounded-2xl
                border
                bg-gray-50
                p-6
                whitespace-pre-line
                leading-7
                text-gray-700">

                {{ $certificate->remarks }}

            </div>
        @else
            <div
                class="rounded-2xl
                border-2
                border-dashed
                border-gray-300
                p-10
                text-center">

                <i class="fa-regular fa-note-sticky text-5xl text-gray-400"></i>

                <h3 class="mt-4 text-lg font-semibold text-gray-600">

                    Belum ada catatan

                </h3>

                <p class="mt-2 text-gray-500">

                    Sertifikat ini belum memiliki catatan tambahan.

                </p>

            </div>
        @endif

    </div>

</div>
