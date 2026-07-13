<div id="addUserModal"
    class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 p-4">

    <div class="flex min-h-full items-center justify-center">

        <div
            class="relative flex w-full max-w-[900px] max-h-[90vh] flex-col overflow-hidden rounded-2xl bg-white shadow-2xl">

        {{-- Header --}}
        <div
            class="flex items-start justify-between border-b border-slate-200 px-7 py-5 shrink-0">

            <div>

                <h2 class="text-xl font-semibold text-slate-800">

                    Tambah Pegawai

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Tambahkan akun pegawai baru ke sistem.

                </p>

            </div>

        </div>

        <form id="userForm" action="{{ route('users.store') }}" method="POST"
            class="flex flex-col flex-1 min-h-0">

            @csrf

            <div class="flex-1 overflow-y-auto px-7 py-6 space-y-6">

                {{-- ========================= --}}
                {{-- Informasi Pegawai --}}
                {{-- ========================= --}}

                <div>

                    <div class="flex items-center gap-3 pb-4 border-b border-slate-200 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center">

                        <i class="fa-solid fa-user text-[#199db7]"></i>

                    </div>

                    <div>

                        <h3 class="text-base font-semibold text-[#146379]">
                            Informasi Pegawai
                        </h3>

                        <p class="text-sm text-slate-500">
                            Masukkan informasi pegawai.
                        </p>

                    </div>

                </div>

                      <div class="grid grid-cols-2 gap-x-6 gap-y-5">

                        {{-- Username --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-2">

                                Username

                            </label>

                            <input id="username" name="username" type="text" readonly
                                class="w-full mt-2 rounded-xl bg-gray-100">

                        </div>

                        {{-- Email --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-2">

                                Email

                            </label>

                            <input id="email" name="email" type="email" class="w-full h-11 rounded-xl border border-slate-300 bg-white px-4 text-sm shadow-sm transition focus:border-[#199db7] focus:ring-2 focus:ring-[#199db7]/20">

                        </div>

                        {{-- NIP --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-2">

                                NIP

                            </label>

                            <input name="nip" type="text" class="w-full mt-2 rounded-xl">

                        </div>

                        {{-- PERNER --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-2">

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

                  <div class="flex items-center gap-3 pb-4 border-b border-slate-200 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center">

                        <i class="fa-solid fa-building text-[#199db7]"></i>

                    </div>

                    <div>

                        <h3 class="text-base font-semibold text-[#146379]">
                            Informasi Organisasi
                        </h3>

                        <p class="text-sm text-slate-500">
                            Tentukan unit dan jabatan pegawai.
                        </p>

                    </div>

                </div>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-5">

                        {{-- Unit --}}
                        <div>

                            <label class="block text-sm font-medium text-slate-700 mb-2">

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

                            <label class="block text-sm font-medium text-slate-700 mb-2">

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

                            <label class="block text-sm font-medium text-slate-700 mb-2">

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

                            <label class="block text-sm font-medium text-slate-700 mb-2">

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

                 <div class="flex items-center gap-3 pb-4 border-b border-slate-200 mb-6">

                    <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center">

                        <i class="fa-solid fa-lock text-[#199db7]"></i>

                    </div>

                    <div>

                        <h3 class="text-base font-semibold text-[#146379]">
                            Keamanan
                        </h3>

                        <p class="text-sm text-slate-500">
                            Tentukan password awal akun.
                        </p>

                    </div>

                </div>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-5">

                        <div>

                            <labelclass="block text-sm font-medium text-slate-700 mb-2">

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
