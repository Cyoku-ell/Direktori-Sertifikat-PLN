<div id="editCertificateModal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-2xl">

        {{-- Header --}}
        <div class="border-b px-8 py-5">

            <h2 class="text-2xl font-bold text-[#146379]">

                Edit Sertifikat

            </h2>

            <p class="text-gray-500 text-sm mt-1">

                Update informasi sertifikat

            </p>

        </div>

        {{-- Body --}}
        <form id="editCertificateForm" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <input type="hidden" id="edit_id">

            <div class="p-8 grid grid-cols-2 gap-5">

                {{-- Name --}}
                <div class="col-span-2">

                    <label class="font-medium">

                        Nama

                    </label>

                    <input id="edit_name" name="name" type="text" class="w-full mt-2 rounded-xl">

                </div>

                {{-- NIP --}}
                <div class="col-span-2">

                    <label class="font-medium">

                        NIP

                    </label>

                    <input id="edit_nip" name="nip" type="text" class="w-full mt-2 rounded-xl">

                </div>

                {{-- Unit --}}
                <div>

                    <label class="font-medium">

                        Unit

                    </label>

                    <select id="edit_unit" name="unit_id" class="w-full mt-2 rounded-xl">

                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">

                                {{ $unit->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- Certification --}}
                <div>

                    <label class="font-medium">

                        Sertifikasi

                    </label>

                    <select id="edit_certification" name="certification_id" class="w-full mt-2 rounded-xl">

                        @foreach ($certifications as $certification)
                            <option value="{{ $certification->id }}">

                                {{ $certification->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- Current PDF --}}
                <div class="col-span-2">

                    <label class="font-medium">

                        File Sekarang

                    </label>

                    <p id="oldPdf" class="mt-2 text-sm text-gray-500 italic">

                        -

                    </p>

                </div>

                {{-- Upload New PDF --}}
                <div class="col-span-2">

                    <label class="font-medium">

                        Ubah PDF (Opsional)

                    </label>

                    <input id="edit_file" type="file" name="file" accept=".pdf" class="w-full mt-2">

                    <small class="text-gray-400">

                        Biarkan kosong jika tak mengganti PDF.

                    </small>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t px-8 py-5 flex justify-end gap-3">

                <button type="button" id="closeEditModal" class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-red-500 shadow-sm border
                          border-red-500 transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-red-500">

                    Cancel

                </button>

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7] shadow-sm border
                          border-[#199db7] transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-[#199db7]">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>
