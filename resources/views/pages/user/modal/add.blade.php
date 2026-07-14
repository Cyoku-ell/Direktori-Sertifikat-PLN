<div id="addUserModal" class="fixed inset-0 z-50 hidden bg-black/50 overflow-y-auto">

    <div class="min-h-screen flex items-center justify-center p-6">

        <div
            class="bg-white
            shadow-xl
            w-full
            max-w-5xl
            rounded-[30px]
            flex flex-col">

            {{-- ========================= --}}
            {{-- HEADER --}}
            {{-- ========================= --}}

            <div
                class="px-8 py-6
                border-b
                bg-white
                rounded-t-[30px]
                shrink-0">

                <h2 class="text-2xl font-bold text-[#146379]">

                    Tambah Pegawai

                </h2>

                <p class="text-gray-500 mt-1">

                    Tambahkan akun pegawai baru ke dalam sistem.

                </p>

            </div>

            <form id="userForm"
                action="{{ route('users.store') }}"
                method="POST"
                class="flex flex-col flex-1">

                @csrf

                {{-- ========================= --}}
                {{-- BODY --}}
                {{-- ========================= --}}

                <div
                    class="flex-1 overflow-y-auto px-8 py-7 space-y-6">

                    {{-- ====================================================== --}}
                    {{-- INFORMASI PEGAWAI --}}
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

                                    Informasi Pegawai

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Masukkan data utama pegawai.

                                </p>

                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-6">

                            {{-- Username --}}
                            <div>

                                <label class="font-medium">

                                    Username

                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    readonly
                                    class="w-full mt-2 rounded-xl bg-gray-100">

                            </div>

                            {{-- Email --}}
                            <div>

                                <label class="font-medium">

                                    Email

                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    class="w-full mt-2 rounded-xl"
                                    placeholder="Masukkan email">

                            </div>

                            {{-- NIP --}}
                            <div>

                                <label class="font-medium">

                                    NIP

                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    name="nip"
                                    type="text"
                                    class="w-full mt-2 rounded-xl"
                                    placeholder="Masukkan NIP">

                            </div>

                            {{-- PERNER --}}
                            <div>

                                <label class="font-medium">

                                    PERNER

                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    name="perner"
                                    type="text"
                                    class="w-full mt-2 rounded-xl"
                                    placeholder="Masukkan PERNER">

                            </div>

                        </div>

                    </div>

                    {{-- ====================================================== --}}
                    {{-- INFORMASI ORGANISASI --}}
                    {{-- ====================================================== --}}
<div class="bg-gray-50 border rounded-2xl p-6">

    <div class="flex items-center gap-3 mb-6">

        <div
            class="w-11 h-11
            rounded-xl
            bg-[#199db7]/10
            flex items-center justify-center">

            <i class="fa-solid fa-building text-[#199db7] text-lg"></i>

        </div>

        <div>

            <h3 class="text-lg font-bold text-[#146379]">

                Informasi Organisasi

            </h3>

            <p class="text-sm text-gray-500">

                Tentukan unit kerja dan hak akses pegawai.

            </p>

        </div>

    </div>

    <div class="grid grid-cols-2 gap-6">

        {{-- Unit --}}
        <div>

            <label class="font-medium">

                Unit

                <span class="text-red-500">*</span>

            </label>

            <select
                name="unit_id"
                class="w-full mt-2 rounded-xl">

                <option value="">Pilih Unit</option>

                @foreach ($units as $unit)

                    <option value="{{ $unit->id }}">

                        {{ $unit->name }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- Jabatan --}}
        <div>

            <label class="font-medium">

                Jabatan

                <span class="text-red-500">*</span>

            </label>

            <select
                name="position_id"
                class="w-full mt-2 rounded-xl">

                <option value="">Pilih Jabatan</option>

                @foreach ($positions as $position)

                    <option value="{{ $position->id }}">

                        {{ $position->name }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- Status --}}
        <div>

            <label class="font-medium">

                Status

                <span class="text-red-500">*</span>

            </label>

            <select
                name="status"
                class="w-full mt-2 rounded-xl">

                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Outsourcing">Outsourcing</option>
                <option value="Magang">Magang</option>

            </select>

        </div>

        {{-- Role --}}
        <div>

            <label class="font-medium">

                Role

                <span class="text-red-500">*</span>

            </label>

            <select
                name="role"
                class="w-full mt-2 rounded-xl">

                <option value="user">

                    Pegawai

                </option>

                <option value="admin">

                    Admin

                </option>

            </select>

        </div>

    </div>

</div>

{{-- ====================================================== --}}
{{-- KEAMANAN --}}
{{-- ====================================================== --}}

<div class="bg-gray-50 border rounded-2xl p-6">

    <div class="flex items-center gap-3 mb-6">

        <div
            class="w-11 h-11
            rounded-xl
            bg-[#199db7]/10
            flex items-center justify-center">

            <i class="fa-solid fa-lock text-[#199db7] text-lg"></i>

        </div>

        <div>

            <h3 class="text-lg font-bold text-[#146379]">

                Keamanan

            </h3>

            <p class="text-sm text-gray-500">

                Tentukan password awal akun pegawai.

            </p>

        </div>

    </div>

    <div class="grid grid-cols-2 gap-6">

        <div class="col-span-2">

            <label class="font-medium">

                Password

                <span class="text-red-500">*</span>

            </label>

            <input
                name="password"
                type="password"
                class="w-full mt-2 rounded-xl"
                placeholder="Masukkan password">

        </div>

    </div>

</div>

             {{-- ====================================================== --}}
            {{-- FOOTER --}}
            {{-- ====================================================== --}}

            <div
                class="shrink-0
                border-t
                bg-white
                rounded-b-[30px]
                px-8
                py-5">

                <div class="flex justify-between items-center">

                    <div class="text-sm text-gray-500">

                        <i class="fa-solid fa-circle-info mr-2 text-[#199db7]"></i>

                        Pastikan seluruh data sudah benar sebelum disimpan.

                    </div>

                    <div class="flex gap-3">

                        <button
                            type="button"
                            id="closeUserModal"
                            class="px-6 py-2.5
                            rounded-xl
                            border
                            hover:bg-gray-100
                            transition">

                            Batal

                        </button>

                        <button
                            type="submit"
                            class="px-6 py-2.5
                            rounded-xl
                            bg-[#199db7]
                            hover:bg-[#146379]
                            text-white
                            transition">

                            <i class="fa-solid fa-floppy-disk mr-2"></i>

                            Simpan Pegawai

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

</div>