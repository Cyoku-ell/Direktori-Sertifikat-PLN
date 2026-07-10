<div id="addUserModal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center overflow-y-auto">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-4xl my-10">

        {{-- Header --}}
        <div class="border-b px-8 py-5">

            <h2 class="text-2xl font-bold text-[#146379]">

                Tambah Pegawai

            </h2>

            <p class="text-gray-500 text-sm mt-1">

                Tambahkan akun pegawai baru.

            </p>

        </div>

        <form id="userForm" action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="p-8 space-y-8">

                {{-- ========================= --}}
                {{-- Informasi Pegawai --}}
                {{-- ========================= --}}

                <div>

                    <h3 class="font-semibold text-[#146379] text-lg mb-5">

                        Informasi Pegawai

                    </h3>

                    <div class="grid grid-cols-2 gap-5">

                        {{-- Username --}}
                        <div>

                            <label class="font-medium">

                                Username

                            </label>

                            <input id="username" name="username" type="text" readonly
                                class="w-full mt-2 rounded-xl bg-gray-100">

                        </div>

                        {{-- Email --}}
                        <div>

                            <label class="font-medium">

                                Email

                            </label>

                            <input id="email" name="email" type="email" class="w-full mt-2 rounded-xl">

                        </div>

                        {{-- NIP --}}
                        <div>

                            <label class="font-medium">

                                NIP

                            </label>

                            <input name="nip" type="text" class="w-full mt-2 rounded-xl">

                        </div>

                        {{-- PERNER --}}
                        <div>

                            <label class="font-medium">

                                PERNER

                            </label>

                            <input name="perner" type="text" class="w-full mt-2 rounded-xl">

                        </div>

                    </div>

                </div>

                {{-- ========================= --}}
                {{-- Organisasi --}}
                {{-- ========================= --}}

                <div>

                    <h3 class="font-semibold text-[#146379] text-lg mb-5">

                        Informasi Organisasi

                    </h3>

                    <div class="grid grid-cols-2 gap-5">

                        {{-- Unit --}}
                        <div>

                            <label class="font-medium">

                                Unit

                            </label>

                            <select name="unit_id" class="w-full mt-2 rounded-xl">

                                <option value="">

                                    Pilih Unit

                                </option>

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

                            </label>

                            <select name="position_id" class="w-full mt-2 rounded-xl">

                                <option value="">

                                    Pilih Jabatan

                                </option>

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

                            </label>

                            <select name="status" class="w-full mt-2 rounded-xl">

                                <option value="Tetap">

                                    Tetap

                                </option>

                                <option value="Kontrak">

                                    Kontrak

                                </option>

                                <option value="Outsourcing">

                                    Outsourcing

                                </option>

                                <option value="Magang">

                                    Magang

                                </option>

                            </select>

                        </div>

                        {{-- Role --}}
                        <div>

                            <label class="font-medium">

                                Role

                            </label>

                            <select name="role" class="w-full mt-2 rounded-xl">

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

                {{-- ========================= --}}
                {{-- Login --}}
                {{-- ========================= --}}

                <div>

                    <h3 class="font-semibold text-[#146379] text-lg mb-5">

                        Keamanan

                    </h3>

                    <div class="grid grid-cols-2 gap-5">

                        <div>

                            <label class="font-medium">

                                Password

                            </label>

                            <input name="password" type="password" class="w-full mt-2 rounded-xl">

                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t px-8 py-5 flex justify-end gap-3">

                <button type="button" id="closeUserModal"
                    class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-red-500
                shadow-sm border border-red-500
                transition transform duration-200 ease-out
                hover:scale-110 hover:shadow-md
                hover:text-white hover:bg-red-500">

                    Cancel

                </button>

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7]
                shadow-sm border border-[#199db7]
                transition transform duration-200 ease-out
                hover:scale-110 hover:shadow-md
                hover:text-white hover:bg-[#199db7]">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>
