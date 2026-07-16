@extends('layouts.app')

@section('content')
    <div class="p-8">

        {{-- Header --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-3xl font-bold text-[#146379]">

                        Direktori Sertifikat

                    </h1>

                    <p class="text-gray-500 mt-2">

                        Mengelola seluruh data sertifikat pegawai PLN.

                    </p>

                </div>

                <button id="btnAddCertificate"
                    class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7]
                    shadow-sm border border-[#199db7]
                    transition transform duration-200 ease-out
                    hover:scale-110 hover:shadow-md
                    hover:text-white hover:bg-[#199db7]">

                    <i class="fa-solid fa-file-circle-plus"></i>

                    Tambah Sertifikat

                </button>

            </div>

        </div>

        {{-- Table --}}
        <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">

            @include('pages.certificate.partials.searchbar')

            @include('pages.certificate.partials.filter')

            <table id="certificateTable" class="custom-table w-full text-sm text-left bg-[#199db7] rounded-2xl">

                <thead class="text-white">

                    <tr>

                        <th class="px-5 py-4 text-center rounded-l-xl">

                            No

                        </th>

                        <th>Pemilik</th>

                        <th>PERNER</th>

                        <th>Nama Sertifikat</th>

                        <th>No. Sertifikat</th>

                        <th>Instansi</th>

                        <th>Terbit</th>

                        <th>Expired</th>

                        <th>Status</th>

                        <th class="text-center rounded-r-xl">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody class="bg-white rounded-b-3xl">

                </tbody>

            </table>

        </div>

    </div>

    {{-- Modal --}}
    @include('pages.certificate.modal.add')

    @include('pages.certificate.modal.edit')
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            let table = $('#certificateTable').DataTable({

                processing: true,

                serverSide: true,

                paging: true,

                dom: 'rtp',

                ajax: "{{ route('certificates.datatable') }}",

                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },

                    {
                        data: 'owner',
                        name: 'owner'
                    },

                    {
                        data: 'perner',
                        name: 'perner'
                    },

                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'certificate_number',
                        name: 'certificate_number'
                    },

                    {
                        data: 'institution',
                        name: 'institution'
                    },

                    {
                        data: 'issue_date',
                        name: 'issue_date'
                    },

                    {
                        data: 'expired_at',
                        name: 'expired_at'
                    },

                    {
                        data: 'status',
                        name: 'status',
                        searchable: false,
                        orderable: false
                    },

                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }

                ]

            });

            $('#searchInput').keyup(function() {

                table.search($(this).val()).draw();

            });

            $('#btnAddCertificate').click(function() {

                $('#certificateForm')[0].reset();

                $('#formMode').val('create');

                $('#certificate_id').val('');

                $('#certificateModalTitle').text(
                    'Tambah Sertifikat'
                );

                $('#certificateModalSubtitle').text(
                    'Tambahkan data sertifikat pegawai PLN.'
                );

                $('#submitCertificateText').text(
                    'Simpan Sertifikat'
                );

                $('#certificateFooterInfo').html(
                    '<i class="fa-solid fa-circle-info mr-2 text-[#199db7]"></i> Pastikan seluruh data sudah benar sebelum disimpan.'
                );

                $('#currentPdf').addClass('hidden');

                $('#pdfPreview').addClass('hidden');

                $('#addCertificateModal').removeClass('hidden');

            });

            $('#closeCertificateModal').click(function() {

                $('#addCertificateModal').addClass('hidden');

            });

            // submit add

            /*
        |--------------------------------------------------------------------------
        | SUBMIT ADD & EDIT
        |--------------------------------------------------------------------------
        */

            $('#certificateForm').submit(function(e) {

                e.preventDefault();

                let formData = new FormData(this);

                let mode = $('#formMode').val();

                let id = $('#certificate_id').val();

                let url = "";

                if (mode == "create") {

                    url = "{{ route('certificates.store') }}";

                } else {

                    url = "/certificates/" + id;

                    formData.append('_method', 'PUT');

                }

                $.ajax({

                    url: url,

                    type: "POST",

                    data: formData,

                    processData: false,

                    contentType: false,

                    success: function(res) {

                        toastr.success(res.message);

                        $('#addCertificateModal').addClass('hidden');

                        $('#certificateForm')[0].reset();

                        $('#currentPdf').addClass('hidden');

                        $('#pdfPreview').addClass('hidden');

                        $('#certificate_id').val('');

                        $('#formMode').val('create');

                        $('#certificateModalTitle').text(
                            'Tambah Sertifikat'
                        );

                        $('#certificateModalSubtitle').text(
                            'Tambahkan data sertifikat pegawai PLN.'
                        );

                        $('#submitCertificateText').text(
                            'Simpan Sertifikat'
                        );

                        table.ajax.reload(null, false);

                    },

                    error: function(xhr) {

                        if (xhr.status == 422) {

                            $.each(xhr.responseJSON.errors, function(k, v) {

                                toastr.error(v[0]);

                            });

                        } else {

                            toastr.error('Terjadi kesalahan.');

                            console.log(xhr);

                        }

                    }

                });

            });

            /*
            |--------------------------------------------------------------------------
            | EDIT CERTIFICATE
            |--------------------------------------------------------------------------
            */

            $(document).on('click', '.editCertificateBtn', function() {

                let id = $(this).data('id');

                $.ajax({

                    url: "/certificates/" + id + "/edit",

                    type: "GET",

                    success: function(res) {

                        /*
                        |--------------------------------------------------------------------------
                        | MODE
                        |--------------------------------------------------------------------------
                        */

                        $('#formMode').val('edit');

                        $('#certificate_id').val(res.id);

                        /*
                        |--------------------------------------------------------------------------
                        | HEADER
                        |--------------------------------------------------------------------------
                        */

                        $('#certificateModalTitle').text(
                            'Edit Sertifikat'
                        );

                        $('#certificateModalSubtitle').text(
                            'Perbarui data sertifikat pegawai PLN.'
                        );

                        $('#submitCertificateText').text(
                            'Update Sertifikat'
                        );

                        $('#certificateFooterInfo').html(
                            '<i class="fa-solid fa-pen-to-square mr-2 text-amber-500"></i> Perbarui data sertifikat kemudian tekan Update.'
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | OWNER
                        |--------------------------------------------------------------------------
                        */

                        $('#perner').val(res.perner);

                        $('#owner_username').val(res.username);

                        $('#owner_unit').val(res.unit);

                        $('#owner_position').val(res.position);

                        /*
                        |--------------------------------------------------------------------------
                        | CERTIFICATE
                        |--------------------------------------------------------------------------
                        */

                        $('input[name="title"]').val(res.title);

                        $('input[name="certificate_number"]').val(
                            res.certificate_number
                        );

                        $('input[name="registration_number"]').val(
                            res.registration_number
                        );

                        $('input[name="institution"]').val(
                            res.institution
                        );

                        $('input[name="accreditor"]').val(
                            res.accreditor
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | DATE
                        |--------------------------------------------------------------------------
                        */

                        $('#issue_date').val(res.issue_date);

                        $('input[name="start_date"]').val(
                            res.start_date
                        );

                        $('input[name="end_date"]').val(
                            res.end_date
                        );

                        $('#expired_at').val(
                            res.expired_at
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | REMARK
                        |--------------------------------------------------------------------------
                        */

                        $('textarea[name="remarks"]').val(
                            res.remarks
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | PDF
                        |--------------------------------------------------------------------------
                        */

                        if (res.pdf) {

                            $('#currentPdf').removeClass('hidden');

                            $('#currentPdfLink').attr(
                                'href',
                                res.pdf
                            );

                        } else {

                            $('#currentPdf').addClass('hidden');

                        }

                        /*
                        |--------------------------------------------------------------------------
                        | MODAL
                        |--------------------------------------------------------------------------
                        */

                        $('#addCertificateModal').removeClass('hidden');

                    }

                });

            });

            /*
    |--------------------------------------------------------------------------
    | DELETE CERTIFICATE
    |--------------------------------------------------------------------------
    */

            $(document).on('click', '.deleteCertificateBtn', function() {

                let id = $(this).data('id');

                Swal.fire({

                    title: 'Hapus Sertifikat?',

                    text: 'Data yang dihapus tidak dapat dikembalikan.',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#dc2626',

                    cancelButtonColor: '#9ca3af',

                    confirmButtonText: 'Ya, Hapus',

                    cancelButtonText: 'Batal',

                }).then((result) => {

                    if (!result.isConfirmed) return;

                    $.ajax({

                        url: "/certificates/" + id,

                        type: "POST",

                        data: {

                            _method: "DELETE",

                            _token: $('meta[name="csrf-token"]').attr('content')

                        },

                        success: function(res) {

                            toastr.success(res.message);

                            table.ajax.reload(null, false);

                        },

                        error: function(xhr) {

                            toastr.error('Gagal menghapus sertifikat.');

                            console.log(xhr);

                        }

                    });

                });

            });


        });


        // preview pdf
        $('#pdf').change(function() {

            let file = this.files[0];

            if (!file) return;

            $('#pdfPreview').removeClass('hidden');

            $('#pdfName').text(file.name);

            $('#pdfSize').text(
                (file.size / 1024 / 1024).toFixed(2) + " MB"
            );

        });

        // hapus file
        $('#removePdf').click(function() {

            $('#pdf').val('');

            $('#pdfPreview').addClass('hidden');

        });

        // hitung expired

        $('#validity, #issue_date').change(function() {

            let validity = $('#validity').val();

            let issue = $('#issue_date').val();

            if (!issue) return;

            if (validity === "custom") {

                $('#expiredContainer').removeClass('hidden');

                return;

            }

            $('#expiredContainer').addClass('hidden');

            if (validity == "0" || validity == "") {

                $('#expired_at').val('');

                return;

            }

            let date = new Date(issue);

            date.setFullYear(date.getFullYear() + parseInt(validity));

            let year = date.getFullYear();

            let month = String(date.getMonth() + 1).padStart(2, '0');

            let day = String(date.getDate()).padStart(2, '0');

            $('#expired_at').val(`${year}-${month}-${day}`);

        });

        // debounce
        let timer;

        $('#perner').keyup(function() {

            clearTimeout(timer);

            let perner = $(this).val();

            if (perner.length < 3) {

                $('#ownerCard').addClass('hidden');

                return;

            }

            timer = setTimeout(function() {

                checkOwner(perner);

            }, 400);

        });

        function checkOwner(perner) {

            $.get('/certificates/check-owner/' + perner, function(res) {

                $('#ownerCard').removeClass('hidden');

                if (res.found) {

                    $('#ownerTitle').text('Pegawai Ditemukan');

                    $('#ownerSubtitle').text('Sertifikat akan langsung terhubung dengan akun pegawai.');

                    $('#ownerUsername').text(res.username);

                    $('#ownerUnit').text(res.unit ?? '-');

                    $('#ownerPosition').text(res.position ?? '-');

                    $('#ownerBadge').html(`
                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                    Sinkron
                </span>
            `);

                } else {

                    $('#ownerTitle').text('Pegawai Belum Terdaftar');

                    $('#ownerSubtitle').text(
                        'Sertifikat tetap akan disimpan dan otomatis tersinkron saat akun dibuat.');

                    $('#ownerUsername').text('-');

                    $('#ownerUnit').text('-');

                    $('#ownerPosition').text('-');

                    $('#ownerBadge').html(`
                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                    Belum Sinkron
                </span>
            `);

                }

            });

        }
    </script>
@endsection
