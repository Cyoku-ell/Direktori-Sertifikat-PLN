<div id="addCertificateModal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-2xl">

        {{-- Header --}}
        <div class="border-b px-8 py-5">

            <h2 class="text-2xl font-bold text-[#146379]">

                Upload Sertifikat

            </h2>

            <p class="text-gray-500 text-sm mt-1">

                Upload Sertifikat Baru.

            </p>

            

        </div>

        {{-- Body --}}
        <form id="certificateForm" enctype="multipart/form-data">

            @csrf

            <div class="p-8 grid grid-cols-2 gap-5">

                {{-- Name --}}
                <div class="col-span-2">

                    <label class="font-medium">

                        Name

                    </label>

                    <input name="name" type="text" class="w-full mt-2 rounded-xl">

                </div>

                {{-- NIP --}}
                <div class="col-span-2">

                    <label class="font-medium">

                        NIP

                    </label>

                    <input name="nip" type="text" class="w-full mt-2 rounded-xl">

                </div>

                {{-- Unit --}}
                <div>

                    <label class="font-medium">

                        Unit

                    </label>

                    <select name="unit_id" id="unit_id" class="w-full mt-2 rounded-xl">

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

                        Certification

                    </label>

                    <select name="certification_id" id="certification_id" class="w-full mt-2 rounded-xl">

                        @foreach ($certifications as $certification)
                            <option value="{{ $certification->id }}">

                                {{ $certification->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- PDF --}}
                <div class="col-span-2">

                    <label class="font-medium">

                        Certificate PDF

                    </label>

                    <input type="file" name="file" accept=".pdf" class="w-full mt-2">

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t px-8 py-5 flex justify-end gap-3">

                <button type="button" id="closeModal" class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-red-500 shadow-sm border
                          border-red-500 transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-red-500">

                    Cancel

                </button>

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7] shadow-sm border
                          border-[#199db7] transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-[#199db7]">

                    Upload

                </button>

            </div>

        </form>

    </div>

</div>
