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
                    class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7] shadow-sm border
                          border-gray-300 transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-[#199db7] ">

                    <i class="fa fa-plus"></i>

                    Upload Sertifikat

                </button>

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">
            @include('pages.Data.partials.searchbar')

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
    @include('pages.Data.modal.edit')
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
                paging: true,
                dom: 'rtp',

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
            // Search
            // ===============================
            $('#searchInput').on('keyup', function() {

                table.search($(this).val()).draw();

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
            // Close Edit Modal
            // ===============================
            $('#closeEditModal').click(function() {

                $('#editCertificateModal').addClass('hidden');

            });

            // ===============================
            // Update Certificate
            // ===============================
            $('#editCertificateForm').submit(function(e) {

                e.preventDefault();

                Swal.fire({

                    title: 'Update Sertifikat?',

                    text: 'Pastikan perubahan sudah benar.',

                    icon: 'question',

                    showCancelButton: true,

                    confirmButtonColor: '#199db7',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Ya, Update',

                    cancelButtonText: 'Batal'

                }).then((result) => {

                    if (result.isConfirmed) {

                        let id = $('#edit_id').val();

                        let formData = new FormData(this);

                        $.ajax({

                            url: "/certificates/" + id,

                            type: "POST",

                            data: formData,

                            processData: false,

                            contentType: false,

                            success: function(response) {

                                toastr.success(response.message);

                                $('#editCertificateModal').addClass('hidden');

                                $('#editCertificateForm')[0].reset();

                                table.ajax.reload(null, false);

                            },

                            error: function(xhr) {

                                if (xhr.status == 422) {

                                    let errors = xhr.responseJSON.errors;

                                    Object.keys(errors).forEach(function(key) {

                                        toastr.error(errors[key][0]);

                                    });

                                } else {

                                    toastr.error("Gagal update sertifikat.");

                                }

                            }

                        });

                    }

                });

            });

            // ===============================
            // Submit Upload
            // ===============================
            $('#certificateForm').submit(function(e) {

                e.preventDefault();

                Swal.fire({
                    title: 'Upload Sertifikat?',
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

            // ===============================
            // Open Edit Modal
            // ===============================
            $(document).on('click', '.btnEdit', function() {

                let id = $(this).data('id');

                $.ajax({

                    url: "/certificates/" + id + "/edit",

                    type: "GET",

                    success: function(response) {

                        $('#edit_id').val(response.id);

                        $('#edit_name').val(response.name);

                        $('#edit_nip').val(response.nip);

                        $('#edit_unit').val(response.unit_id);

                        $('#edit_certification').val(response.certification_id);

                        $('#oldPdf').text(response.file);

                        $('#editCertificateModal').removeClass('hidden');

                    },

                    error: function() {

                        toastr.error("Failed to load certificate.");

                    }

                });

            });

            // ===============================
            // Delete Certificate
            // ===============================
            $(document).on('click', '.btnDelete', function() {

                let id = $(this).data('id');

                Swal.fire({

                    title: 'Hapus Sertifikat?',

                    text: 'Data yang dihapus tidak dapat dikembalikan.',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#d33',

                    cancelButtonColor: '#6b7280',

                    confirmButtonText: 'Ya, Hapus',

                    cancelButtonText: 'Batal'

                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({

                            url: "/certificates/" + id,

                            type: "DELETE",

                            data: {

                                _token: "{{ csrf_token() }}"

                            },

                            success: function(response) {

                                toastr.success(response.message);

                                table.ajax.reload(null, false);

                            },

                            error: function() {

                                toastr.error("Failed to delete certificate.");

                            }

                        });

                    }

                });

            });

        });
    </script>
@endsection
