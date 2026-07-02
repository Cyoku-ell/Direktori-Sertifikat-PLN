@extends('layouts.app')


@section('content')
    <div class="p-8">

        <div class="bg-white rounded-3xl shadow-lg p-8">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-3xl font-bold text-[#146379]">

                        Direktori Sertifikat

                    </h1>

                    <p class="text-gray-500 mt-2">

                        Mengatur Sertifikat.

                    </p>

                </div>

                <button id="btnUpload"
                    class="bg-[#199db7]
                       hover:bg-[#146379]
                       text-white
                       px-6 py-3
                       rounded-xl">

                    <i class="fa fa-plus"></i>

                    Upload Sertifikat

                </button>

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">

            <table id="certificateTable"
                class="custom-table w-full text-sm text-left rtl:text-right bg-[#199db7] rounded-2xl">

                <thead class="text-white">

                    <tr>

                        <th class="px-5 py-4 text-left rounded-l-xl">No</th>

                        <th>Name</th>

                        <th>NIP</th>

                        <th>Unit</th>

                        <th>Certification</th>

                        <th class="px-5 py-4 text-left rounded-r-xl">

                            Action

                        </th>

                    </tr>

                </thead>
                <tbody class="bg-white rounded-b-3xl">
                </tbody>

            </table>

        </div>

    </div>
    @include('pages.Data.modal.add')
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // ===============================
            // DataTable
            // ===============================
            let table = $('#certificateTable').DataTable({

                processing: true,
                serverSide: true,

                ajax: "{{ route('certificates.datatable') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'unit',
                        name: 'unit.name'
                    },
                    {
                        data: 'certification',
                        name: 'certification.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]

            });

            // ===============================
            // Open Modal
            // ===============================
            $('#btnUpload').click(function() {

                $('#certificateForm')[0].reset();

                $('#addCertificateModal').removeClass('hidden');

            });

            // ===============================
            // Close Modal
            // ===============================
            $('#closeModal').click(function() {

                $('#addCertificateModal').addClass('hidden');

            });

            // ===============================
            // Submit Upload
            // ===============================
            $('#certificateForm').submit(function(e) {

                e.preventDefault();

                Swal.fire({
                    title: 'Upload Certificate?',
                    text: 'Pastikan data yang dimasukkan sudah benar.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#199db7',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Upload',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    if (result.isConfirmed) {

                        let formData = new FormData(this);

                        $.ajax({

                            url: "{{ route('certificates.store') }}",

                            type: "POST",

                            data: formData,

                            processData: false,

                            contentType: false,

                            success: function(response) {

                                toastr.success(response.message);

                                $('#addCertificateModal').addClass('hidden');

                                $('#certificateForm')[0].reset();

                                table.ajax.reload(null, false);

                            },

                            error: function(xhr) {

                                console.log(xhr);

                                if (xhr.responseJSON) {
                                    console.log(xhr.responseJSON);
                                }

                                if (xhr.status === 422) {

                                    let errors = xhr.responseJSON.errors;

                                    Object.keys(errors).forEach(function(key) {
                                        toastr.error(errors[key][0]);
                                    });

                                } else if (xhr.status === 500) {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Server Error',
                                        text: xhr.responseText
                                    });

                                } else {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Status : ' + xhr.status
                                    });

                                }

                            }
                        });

                    }

                });

            });

        });
    </script>
@endsection
