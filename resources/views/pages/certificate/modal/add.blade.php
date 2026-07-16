<div id="addCertificateModal" class="fixed inset-0 z-50 hidden bg-black/50 overflow-y-auto">

    <div class="min-h-screen flex  items-center justify-center p-6">

        <div
            class="bg-white 
            shadow-xl
            w-full
            max-w-5xl
            rounded
            h-4000vh]
            flex flex-col">

            {{-- ========================= --}}
            {{-- HEADER --}}
            {{-- ========================= --}}

            <div class="px-8 py-6 sticky top-0 z-30
    border-b
    bg-white
    rounded-t-[30px]
    shrink-0">

                <h2 id="certificateModalTitle" class="text-2xl
        font-bold
        text-[#146379]">

                    Tambah Sertifikat

                </h2>

                <p id="certificateModalSubtitle" class="text-gray-500 mt-1">

                    Tambahkan data sertifikat pegawai PLN.

                </p>

            </div>
            <form id="certificateForm" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1">

                @csrf

                <input type="hidden" id="certificate_id" value="">

                <input type="hidden" id="formMode" value="create">

                {{-- ========================= --}}
                {{-- BODY --}}
                {{-- ========================= --}}

                <div id="certificateBody" class="flex-1 overflow-y-auto px-8 py-7 space-y-6">

                    {{-- ====================================================== --}}
                    {{-- INFORMASI PEMILIK --}}
                    {{-- ====================================================== --}}

                    <div class="bg-gray-50 border rounded-2xl p-6">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-11 h-11
            rounded-xl
            bg-[#199db7]/10
            flex items-center justify-center">

                                <i class="fa-solid fa-user text-[#199db7] text-lg"></i>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-[#146379]">

                                    Informasi Pemilik

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Cari pemilik berdasarkan PERNER.

                                </p>

                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-6">

                            <div>

                                <label class="font-medium">

                                    PERNER

                                    <span class="text-red-500">*</span>

                                </label>

                                <input id="perner" name="perner" type="text" autocomplete="off"
                                    class="w-full mt-2 rounded-xl" placeholder="Masukkan PERNER...">

                            </div>

                        </div>

                        {{-- Card Hasil Sinkronisasi --}}
                        <div id="ownerCard" class="hidden mt-6 rounded-2xl border bg-white p-6">

                            <div class="flex justify-between items-start">

                                <div>

                                    <h4 id="ownerTitle" class="font-semibold text-lg text-[#146379]">

                                        Pegawai Ditemukan

                                    </h4>

                                    <p id="ownerSubtitle" class="text-gray-500 text-sm mt-1">

                                    </p>

                                </div>

                                <div id="ownerBadge">

                                </div>

                            </div>

                            <div class="grid grid-cols-3 gap-6 mt-6">

                                <div>

                                    <p class="text-xs uppercase text-gray-400">

                                        Username

                                    </p>

                                    <p id="ownerUsername" class="font-semibold mt-2">

                                        -

                                    </p>

                                </div>

                                <div>

                                    <p class="text-xs uppercase text-gray-400">

                                        Unit

                                    </p>

                                    <p id="ownerUnit" class="font-semibold mt-2">

                                        -

                                    </p>

                                </div>

                                <div>

                                    <p class="text-xs uppercase text-gray-400">

                                        Jabatan

                                    </p>

                                    <p id="ownerPosition" class="font-semibold mt-2">

                                        -

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ====================================================== --}}
                    {{-- INFORMASI SERTIFIKAT --}}
                    {{-- ====================================================== --}}

                    <div class="bg-gray-50 border rounded-2xl p-6">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-11 h-11
            rounded-xl
            bg-[#199db7]/10
            flex items-center justify-center">

                                <i class="fa-solid fa-certificate text-[#199db7] text-lg"></i>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-[#146379]">

                                    Informasi Sertifikat

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Masukkan informasi utama sertifikat.

                                </p>

                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-6">

                            {{-- Nama Sertifikat --}}
                            <div class="col-span-2">

                                <label class="font-medium">

                                    Nama Sertifikat

                                    <span class="text-red-500">*</span>

                                </label>

                                <input type="text" name="title" class="w-full mt-2 rounded-xl"
                                    placeholder="Contoh : Ahli K3 Umum">

                            </div>

                            {{-- Nomor Sertifikat --}}
                            <div>

                                <label class="font-medium">

                                    Nomor Sertifikat

                                    <span class="text-red-500">*</span>

                                </label>

                                <input type="text" name="certificate_number" class="w-full mt-2 rounded-xl">

                            </div>

                            {{-- Nomor Registrasi --}}
                            <div>

                                <label class="font-medium">

                                    Nomor Registrasi

                                </label>

                                <input type="text" name="registration_number" class="w-full mt-2 rounded-xl">

                            </div>

                            {{-- Instansi --}}
                            <div>

                                <label class="font-medium">

                                    Instansi

                                    <span class="text-red-500">*</span>

                                </label>

                                <input type="text" name="institution" class="w-full mt-2 rounded-xl"
                                    placeholder="Contoh : BNSP">

                            </div>

                            {{-- Lembaga Akreditasi --}}
                            <div>

                                <label class="font-medium">

                                    Lembaga Akreditasi

                                    <span class="text-red-500">*</span>

                                </label>

                                <input type="text" name="accreditor" class="w-full mt-2 rounded-xl"
                                    placeholder="Contoh : Kementerian Ketenagakerjaan">

                            </div>

                        </div>

                    </div>

                    {{-- ====================================================== --}}
                    {{-- INFORMASI TANGGAL --}}
                    {{-- ====================================================== --}}

                    <div class="bg-gray-50 border rounded-2xl p-6">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-11 h-11
            rounded-xl
            bg-[#199db7]/10
            flex items-center justify-center">

                                <i class="fa-solid fa-calendar-days text-[#199db7] text-lg"></i>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-[#146379]">

                                    Informasi Tanggal

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Atur tanggal pelaksanaan dan masa berlaku sertifikat.

                                </p>

                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-6">

                            {{-- Tanggal Terbit --}}
                            <div>

                                <label class="font-medium">

                                    Tanggal Terbit

                                    <span class="text-red-500">*</span>

                                </label>

                                <input id="issue_date" type="date" name="issue_date"
                                    class="w-full mt-2 rounded-xl">

                            </div>

                            {{-- Masa Berlaku --}}
                            <div>

                                <label class="font-medium">

                                    Masa Berlaku

                                </label>

                                <select id="validity" class="w-full mt-2 rounded-xl">

                                    <option value="">Pilih Masa Berlaku</option>

                                    <option value="0">

                                        Tidak Ada

                                    </option>

                                    <option value="1">

                                        1 Tahun

                                    </option>

                                    <option value="2">

                                        2 Tahun

                                    </option>

                                    <option value="3">

                                        3 Tahun

                                    </option>

                                    <option value="4">

                                        4 Tahun

                                    </option>

                                    <option value="5">

                                        5 Tahun

                                    </option>

                                    <option value="custom">

                                        Custom

                                    </option>

                                </select>

                            </div>

                            {{-- Mulai Pelaksanaan --}}
                            <div>

                                <label class="font-medium">

                                    Tanggal Mulai Pelaksanaan

                                </label>

                                <input type="date" name="start_date" class="w-full mt-2 rounded-xl">

                            </div>

                            {{-- Selesai Pelaksanaan --}}
                            <div>

                                <label class="font-medium">

                                    Tanggal Selesai Pelaksanaan

                                </label>

                                <input type="date" name="end_date" class="w-full mt-2 rounded-xl">

                            </div>

                            {{-- Expired --}}
                            <div id="expiredContainer" class="col-span-2 hidden">

                                <label class="font-medium">

                                    Tanggal Expired

                                </label>

                                <input id="expired_at" type="date" name="expired_at"
                                    class="w-full mt-2 rounded-xl">

                            </div>

                        </div>

                    </div>

                    {{-- ====================================================== --}}
                    {{-- DOKUMEN SERTIFIKAT --}}
                    {{-- ====================================================== --}}

                    <div class="bg-gray-50 border rounded-2xl p-6">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-11 h-11
            rounded-xl
            bg-[#199db7]/10
            flex items-center justify-center">

                                <i class="fa-solid fa-file-pdf text-[#199db7] text-lg"></i>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-[#146379]">

                                    Dokumen Sertifikat

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Upload file PDF sertifikat (maksimal 10 MB).

                                </p>

                            </div>

                        </div>

                        <div id="currentPdf" class="hidden mb-5">

                            <div class="rounded-xl
        border
        bg-white
        p-4">

                                <div class="flex items-center">

                                    <i
                                        class="fa-solid fa-file-pdf
                text-red-500
                text-3xl"></i>

                                    <div class="ml-4 flex-1">

                                        <p class="font-semibold">

                                            Dokumen saat ini

                                        </p>

                                        <a id="currentPdfLink" href="#" target="_blank"
                                            class="text-[#199db7]
                    hover:underline
                    text-sm">

                                            Lihat PDF

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <input id="pdf" name="pdf" type="file" accept=".pdf" class="hidden">

                        <label for="pdf" id="uploadArea" class="block cursor-pointer">

                            <div
                                class="rounded-2xl
            border-2
            border-dashed
            border-[#199db7]
            bg-white
            hover:bg-[#f6fcfd]
            transition
            duration-200
            p-10">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="w-20 h-20
                    rounded-full
                    bg-[#199db7]/10
                    flex items-center justify-center">

                                        <i
                                            class="fa-solid fa-cloud-arrow-up
                        text-4xl
                        text-[#199db7]"></i>

                                    </div>

                                    <h4 class="mt-6 font-semibold text-lg">

                                        Drag & Drop PDF

                                    </h4>

                                    <p class="text-gray-500 mt-2">

                                        atau klik area ini untuk memilih file

                                    </p>

                                    <div id="pdfPreview"
                                        class="hidden
                    mt-8
                    w-full
                    max-w-md">

                                        <div
                                            class="rounded-xl
                        bg-[#eefbfd]
                        border
                        border-[#c6edf4]
                        p-4">

                                            <div class="flex items-center gap-4">

                                                <i
                                                    class="fa-solid fa-file-pdf
                                text-red-500
                                text-3xl"></i>

                                                <div class="flex-1">

                                                    <p id="pdfName" class="font-semibold truncate">

                                                    </p>

                                                    <p id="pdfSize" class="text-sm text-gray-500 mt-1">

                                                    </p>

                                                </div>

                                                <button id="removePdf" type="button"
                                                    class="text-red-500 hover:text-red-700">

                                                    <i class="fa-solid fa-xmark"></i>

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </label>

                    </div>

                    {{-- ====================================================== --}}
                    {{-- CATATAN --}}
                    {{-- ====================================================== --}}

                    <div class="bg-gray-50 border rounded-2xl p-6">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-11 h-11
            rounded-xl
            bg-[#199db7]/10
            flex items-center justify-center">

                                <i class="fa-solid fa-note-sticky text-[#199db7] text-lg"></i>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-[#146379]">

                                    Catatan

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Informasi tambahan mengenai sertifikat (opsional).

                                </p>

                            </div>

                        </div>

                        <textarea rows="5" name="remarks" class="w-full rounded-xl resize-none"
                            placeholder="Tambahkan catatan apabila diperlukan..."></textarea>

                    </div>

                </div>
                {{-- END BODY --}}

                {{-- ====================================================== --}}
                {{-- FOOTER --}}
                {{-- ====================================================== --}}
                <div class="shrink-0 sticky bottom-0 z-30
    border-t
    bg-white
    rounded-b-[30px]
    px-8
    py-5">

                    <div class="flex justify-between items-center">

                        <div id="certificateFooterInfo" class="text-sm text-gray-500">

                            <i class="fa-solid fa-circle-info mr-2 text-[#199db7]"></i>

                            Pastikan seluruh data sudah benar sebelum disimpan.

                        </div>

                        <div class="flex gap-3">

                            {{-- Cancel --}}
                            <button type="button" id="closeCertificateModal"
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

                                <i class="fa-solid fa-xmark"></i>

                                Batal

                            </button>

                            {{-- Submit --}}
                            <button id="submitCertificateBtn" type="submit"
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
                hover:bg-[#199db7]">

                                <i id="submitCertificateIcon" class="fa-solid fa-floppy-disk"></i>

                                <span id="submitCertificateText">

                                    Simpan Sertifikat

                                </span>

                            </button>

                        </div>

                    </div>

                </div>
            </form>

        </div>

    </div>

</div>
