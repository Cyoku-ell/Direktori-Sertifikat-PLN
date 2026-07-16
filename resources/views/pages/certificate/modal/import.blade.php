<div id="importCertificateModal"
    class="fixed inset-0
    bg-black/50
    hidden
    flex
    items-center
    justify-center
    z-50">

    <div class="bg-white
        rounded-[30px]
        w-full
        max-w-2xl
        overflow-hidden">

        {{-- HEADER --}}

        <div class="px-8 py-6 border-b">

            <h2 class="text-2xl
                font-bold
                text-[#146379]">

                Import Sertifikat

            </h2>

            <p class="text-gray-500 mt-1">

                Upload file Excel untuk menambahkan banyak sertifikat sekaligus.

            </p>

        </div>

        {{-- BODY --}}

        <form id="importCertificateForm" enctype="multipart/form-data">

            @csrf

            <div class="p-8">

                <input type="file" id="excelFile" name="file" accept=".xlsx,.xls" class="hidden">

                <label for="excelFile" class="block
                    cursor-pointer">

                    <div
                        class="border-2
                        border-dashed
                        border-[#199db7]
                        rounded-2xl
                        p-12
                        text-center">

                        <i
                            class="fa-solid
                            fa-file-excel
                            text-6xl
                            text-green-600">

                        </i>

                        <p class="mt-5 font-semibold">

                            Klik untuk memilih file Excel

                        </p>

                        <p class="text-sm text-gray-500 mt-2">

                            Format .xlsx atau .xls

                        </p>

                    </div>

                </label>

                <div id="selectedExcel"
                    class="hidden
    mt-5
    rounded-xl
    bg-green-50
    border
    border-green-300
    p-4">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <i class="fa-solid fa-file-excel text-green-600 text-3xl"></i>

                            <div>

                                <p id="excelName" class="font-semibold"></p>

                                <p id="excelSize" class="text-sm text-gray-500"></p>

                            </div>

                        </div>

                        <button type="button" id="removeExcel"
                            class="flex items-center gap-2 px-4 py-2 bg-white
                            rounded-lg text-sm font-medium text-red-500 border-red-500 shadow-sm transition
                            transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white
                            hover:bg-red-500">

                            <i class="fa-solid fa-xmark text-xl"></i>

                        </button>

                    </div>

                </div>
            </div>

            {{-- FOOTER --}}

            <div
                class="border-t
                px-8
                py-5
                flex
                justify-between
                items-center">

                <span class="text-sm
                    text-gray-500">

                    Maksimal ukuran file 10 MB.

                </span>

                <div class="flex gap-3">

                    <button type="button" id="closeImportModal"
                        class="flex items-center gap-2
                px-4 py-2
                bg-white
                rounded-lg
                text-sm
                font-medium
                text-red-500
                border
                border-red-500
                shadow-sm
                transition
                transform
                duration-200
                ease-out
                hover:scale-110
                hover:shadow-md
                hover:text-white
                hover:bg-red-500">

                        Batal

                    </button>

                    <button id="btnImportSubmit" type="submit" disabled
                        class="flex items-center gap-2
                px-4 py-2
                bg-white
                rounded-lg
                text-sm
                font-medium
                text-[#199db7]
                border
                border-[#199db7]
                shadow-sm
                transition
                transform
                duration-200
                ease-out
                hover:scale-110
                hover:shadow-md
                hover:text-white
                hover:bg-[#199db7] disabled:cursor-not-allowed">

                        <i class="fa-solid fa-upload mr-2"></i>

                        Import Excel

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
