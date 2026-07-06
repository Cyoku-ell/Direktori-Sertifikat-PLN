@extends('layouts.app')
@section('content')
    <div class="p-8">

        <!-- Header -->
        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8 ">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-3xl font-bold text-[#146379]">

                        Tambah Sertifikasi

                    </h1>

                    <p class="text-gray-500 mt-2">

                        Tambahkan Sertifikasi yang dapat ditambah ke sertifikat .

                    </p>

                </div>


            </div>

        </div>
        <!-- Card -->
        <div class="bg-white rounded-[30px] shadow-md">

            <!-- Card Header -->
            <div class="border-b px-8 py-6">

                <h2 class="text-xl font-semibold text-[#146379]">
                    Certification Information
                </h2>

            </div>

            <!-- Form -->
            <form id="unitForm" action="{{ route('certifications.store') }}" method="POST">

                @csrf

                <div class="p-8">

                    <label class="block mb-2 font-medium text-gray-700">
                        Nama Sertifikasi
                    </label>

                    <input type="text" name="name" placeholder="Contoh : Sertifikasi PKL"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                    focus:ring-2 focus:ring-[#199db7]
                    focus:border-[#199db7]
                    outline-none">

                </div>

                <!-- Footer -->
                <div class="border-t px-8 py-5 flex justify-end gap-3">

                    <a href="{{ route('certifications.index') }}"
                        class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-red-500 shadow-sm border
                          border-red-500 transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-red-500">

                        Cancel

                    </a>

                    <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7] shadow-sm border
                          border-[#199db7] transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-[#199db7]">

                        <i class="fa-solid fa-floppy-disk mr-2"></i>

                        Save Certification

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
