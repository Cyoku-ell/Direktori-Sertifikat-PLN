@extends('layouts.app')
@section('content')
    <div class="p-8">

        <!-- Header -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-[#146379]">
                Tambah Unit
            </h1>

            <p class="text-gray-500 mt-1">
                Tambahkan unit baru yang nantinya digunakan pada data sertifikat.
            </p>

        </div>

        <!-- Card -->
        <div class="bg-white rounded-[30px] shadow-md">

            <!-- Card Header -->
            <div class="border-b px-8 py-6">

                <h2 class="text-xl font-semibold text-[#146379]">
                    Unit Information
                </h2>

            </div>

            <!-- Form -->
            <form id="unitForm" action="{{ route('units.store') }}" method="POST">

                @csrf

                <div class="p-8">

                    <label class="block mb-2 font-medium text-gray-700">
                        Unit Name
                    </label>

                    <input type="text" name="name" placeholder="Contoh : UP3 Bandung"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                    focus:ring-2 focus:ring-[#199db7]
                    focus:border-[#199db7]
                    outline-none">

                </div>

                <!-- Footer -->
                <div class="border-t px-8 py-5 flex justify-end gap-3">

                    <a href="{{ route('units.index') }}"
                        class="px-6 py-3 rounded-xl border border-gray-300 hover:bg-gray-100">

                        Cancel

                    </a>

                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-[#199db7] hover:bg-[#146379] text-white font-semibold">

                        <i class="fa-solid fa-floppy-disk mr-2"></i>

                        Save Unit

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection

@section('script')
    <script>
        $('#unitForm').submit(function(e) {

            e.preventDefault();

            let form = $(this);

            Swal.fire({
                title: 'Simpan Unit?',
                text: "Pastikan nama unit sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#199db7',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'

            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),

                        success: function(response) {

                            toastr.success(response.message);

                            setTimeout(function() {

                                window.location.href = response.redirect;

                            }, 1000);

                        },

                        error: function() {

                            toastr.error('Terjadi kesalahan.');

                        }

                    });

                }

            });

        });
    </script>
@endsection
