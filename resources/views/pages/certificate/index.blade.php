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

                @hasrole('admin')
                    <div class="flex items-center gap-3">

                        <button id="btnImportCertificate"
                            class="flex items-center gap-2
                    px-4 py-2
                    bg-white
                    rounded-lg
                    text-sm
                    font-medium
                    text-green-600
                    shadow-sm
                    border
                    border-green-500
                    transition
                    transform
                    duration-200
                    hover:scale-110
                    hover:text-white
                    hover:bg-green-500">

                            <i class="fa-solid fa-file-import"></i>

                            Import Excel

                        </button>

                        <button id="btnAddCertificate"
                            class="flex items-center gap-2
                    px-4 py-2
                    bg-white
                    rounded-lg
                    text-sm
                    font-medium
                    text-[#199db7]
                    shadow-sm
                    border
                    border-[#199db7]
                    transition
                    transform
                    duration-200
                    hover:scale-110
                    hover:shadow-md
                    hover:text-white
                    hover:bg-[#199db7]">

                            <i class="fa-solid fa-file-circle-plus"></i>

                            Tambah Sertifikat

                        </button>

                    </div>
                @endhasrole

            </div>

        </div>
        {{-- Table --}}
        <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">

            @include('pages.certificate.partials.searchbar')

            @include('pages.certificate.partials.filter')

            <table id="certificateTable" class="custom-table w-full  text-sm text-left bg-[#199db7] rounded-2xl">

                <thead class="text-white">

                    <tr>

                        <th class="px-5 py-4 text-center rounded-l-xl">

                            No

                        </th>

                        <th>Pemilik</th>

                        <th>PERNER</th>

                        <th>Nama Sertifikat</th>

                        <th>No. Sertifikat</th>

                        <th>Instansi </th>

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

    @include('pages.certificate.modal.import')
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            let selectedSync = '';
            let selectedPdf = '';
            let selectedUnit = '';
            let selectedExpired = '';

            let table = $('#certificateTable').DataTable({

                processing: true,

                serverSide: true,

                paging: true,

                autoWidth: false,

                dom: 'rtp',

                ajax: {

                    url: "{{ route('certificates.datatable') }}",

                    data: function(d) {

                        d.sync = selectedSync;
                        d.pdf = selectedPdf;
                        d.unit = selectedUnit;
                        d.expired = selectedExpired;

                    }

                },

                columnDefs: [{
                        width: "50px",
                        targets: 0
                    }, // No
                    {
                        width: "180px",
                        targets: 1
                    }, // Nama
                    {
                        width: "90px",
                        targets: 2
                    }, // Perner
                    {
                        width: "260px",
                        targets: 3
                    }, // Judul Sertifikat
                    {
                        width: "150px",
                        targets: 4
                    }, // No Sertifikat
                    {
                        width: "170px",
                        targets: 5
                    }, // Lembaga
                    {
                        width: "120px",
                        targets: 6
                    }, // Terbit
                    {
                        width: "120px",
                        targets: 7
                    }, // Expired
                    {
                        width: "120px",
                        targets: 8
                    }, // Status
                    {
                        width: "130px",
                        targets: 9
                    }, // Action
                ],

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

            renderActiveFilters();

            // dropdown filter

            $(document).on('click', '.filter-btn', function(e) {

                e.stopPropagation();

                let target = $(this).data('target');

                let dropdown = $(target);

                let arrow = $(this).find('.dropdown-arrow');

                $('.dropdown-arrow').removeClass('rotate-180');

                $('.filter-dropdown').not(dropdown).each(function() {

                    $(this)
                        .removeClass('scale-100 opacity-100')
                        .addClass('scale-95 opacity-0');

                    let el = $(this);

                    setTimeout(function() {

                        el.addClass('hidden');

                    }, 200);

                });

                if (dropdown.hasClass('hidden')) {

                    dropdown.removeClass('hidden');

                    setTimeout(function() {

                        dropdown
                            .removeClass('scale-95 opacity-0')
                            .addClass('scale-100 opacity-100');

                    }, 10);

                    arrow.addClass('rotate-180');

                } else {

                    dropdown
                        .removeClass('scale-100 opacity-100')
                        .addClass('scale-95 opacity-0');

                    setTimeout(function() {

                        dropdown.addClass('hidden');

                    }, 200);

                }

            });

            $(document).on('click', function() {

                $('.filter-dropdown').each(function() {

                    $(this)
                        .removeClass('scale-100 opacity-100')
                        .addClass('scale-95 opacity-0');

                    let el = $(this);

                    setTimeout(function() {

                        el.addClass('hidden');

                    }, 200);

                });

                $('.dropdown-arrow').removeClass('rotate-180');

            });

            // filter option

            $(document).on('click', '.sync-option', function() {

                selectedSync = $(this).data('value');

                table.ajax.reload(null, false);

                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');

            });

            $(document).on('click', '.expired-option', function() {

                selectedExpired = $(this).data('value');

                table.ajax.reload(null, false);

                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');

            });


            $(document).on('click', '.pdf-option', function() {

                selectedPdf = $(this).data('value');

                table.ajax.reload(null, false);

                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');

            });


            $(document).on('click', '.unit-option', function() {

                selectedUnit = $(this).data('value');

                table.ajax.reload(null, false);

                renderActiveFilters();

                $('.filter-dropdown').addClass('hidden');

            });

            // remove filter

            $(document).on('click', '.remove-filter', function() {

                let type = $(this).data('type');

                if (type == 'sync') selectedSync = '';

                if (type == 'pdf') selectedPdf = '';

                if (type == 'unit') selectedUnit = '';

                if (type === 'expired') selectedExpired = '';

                table.ajax.reload(null, false);

                renderActiveFilters();

            });

            // active filter

            function renderActiveFilters() {

                const container = $("#activeFilters");

                container.empty();

                const filters = [

                    {
                        value: selectedSync,
                        type: 'sync',
                        label: 'Sinkronisasi',
                        text: getSyncText(selectedSync)
                    },

                    {
                        value: selectedPdf,
                        type: 'pdf',
                        label: 'PDF',
                        text: getPdfText(selectedPdf)
                    },

                    {
                        value: selectedExpired,
                        type: 'expired',
                        label: 'Expired',
                        text: getExpiredText(selectedExpired)
                    },

                    {
                        value: selectedUnit,
                        type: 'unit',
                        label: 'Unit',
                        text: getText('.unit-option', selectedUnit)
                    }

                ];

                filters.forEach(f => addFilter(container, f.value, f.type, f.label, f.text));

            }


            function addFilter(container, value, type, label, text) {

                if (value === '') return;

                container.append(`
        <span class="filter-badge filter-${type}">
            ${label}: ${text}
            <button class="remove-filter filter-remove" data-type="${type}">
                ✕
            </button>
        </span>
    `);

            }


            function getText(selector, value) {

                return $(`${selector}[data-value="${value}"]`).text().trim();

            }


            function getSyncText(value) {

                if (value == 1) return 'Sinkron';

                if (value == 0) return 'Belum Sinkron';

                return '';

            }

            function getExpiredText(value) {

                if (value == 1) return 'Sudah Diatur';

                if (value == 0) return 'Belum Diatur';

                return '';

            }


            function getPdfText(value) {

                if (value == 1) return 'Sudah Upload';

                if (value == 0) return 'Belum Upload';

                return '';

            }


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

            $('#btnImportCertificate').click(function() {

                $('#importCertificateModal').removeClass('hidden');

            });

            $('#closeImportModal').click(function() {

                $('#importCertificateModal').addClass('hidden');

            });

            $('#importCertificateForm').submit(function(e) {

                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({

                    url: "{{ route('certificates.import') }}",

                    type: "POST",

                    data: formData,

                    processData: false,

                    contentType: false,

                    beforeSend: function() {

                        $('#btnImportSubmit')
                            .prop('disabled', true)
                            .html(`
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    Mengimpor...
                `);

                    },

                    success: function(res) {

                        toastr.success(res.message);

                        table.ajax.reload(null, false);

                        $('#importCertificateModal').addClass('hidden');

                        $('#importCertificateForm')[0].reset();

                        $('#btnImportSubmit')
                            .prop('disabled', false)
                            .html(`
                    <i class="fa-solid fa-file-import mr-2"></i>
                    Import Excel
                `);

                        Swal.fire({

                            icon: 'success',

                            title: 'Import Selesai',

                            html: `

                    <div class="text-left mt-4 space-y-2">

                        <div>✅ Berhasil : <b>${res.summary.success}</b></div>

                        <div>⚠️ Duplikat : <b>${res.summary.duplicate}</b></div>

                        <div>❌ Gagal : <b>${res.summary.failed}</b></div>

                        <div>👤 Belum Sinkron : <b>${res.summary.unmatched}</b></div>

                        <div>🏢 Unit Baru : <b>${res.summary.new_units}</b></div>

                        <div>💼 Jabatan Baru : <b>${res.summary.new_positions}</b></div>

                    </div>

                `

                        });

                    },

                    error: function(xhr) {

                        $('#btnImportSubmit')
                            .prop('disabled', false)
                            .html(`
                    <i class="fa-solid fa-file-import mr-2"></i>
                    Import Excel
                `);

                        if (xhr.status == 422) {

                            $.each(xhr.responseJSON.errors, function(k, v) {

                                toastr.error(v[0]);

                            });

                        } else {

                            toastr.error('Import gagal.');

                            console.log(xhr);

                        }

                    }

                });

            });

            $('#excelFile').change(function() {

                let file = this.files[0];

                if (!file) return;

                $('#selectedExcel').removeClass('hidden');

                $('#excelName').text(file.name);

                $('#excelSize').text(
                    (file.size / 1024 / 1024).toFixed(2) + ' MB'
                );

                $('#btnImportSubmit')
                    .prop('disabled', false)
                    .removeClass('bg-gray-300')
                    .addClass('bg-[#199db7]');
            });

            $('#removeExcel').click(function() {

                $('#excelFile').val('');

                $('#selectedExcel').addClass('hidden');

                $('#btnImportSubmit')
                    .prop('disabled', true)
                    .removeClass('bg-[#199db7]')
                    .addClass('bg-gray-300');

            });

            $('#closeImportModal').click(function() {

                $('#importCertificateModal').addClass('hidden');

                $('#importCertificateForm')[0].reset();

                $('#selectedExcel').addClass('hidden');

                $('#btnImportSubmit')
                    .prop('disabled', true)
                    .removeClass('bg-[#199db7]')
                    .addClass('bg-gray-300');

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

                        /*  MODAL  */

                        $('#addCertificateModal').removeClass('hidden');

                    }

                });

            });

            /* DELETE CERTIFICATE  */

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
