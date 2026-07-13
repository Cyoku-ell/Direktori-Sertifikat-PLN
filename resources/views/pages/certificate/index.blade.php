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

                <tbody>

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

                $('#addCertificateModal').removeClass('hidden');

            });

            $('#closeCertificateModal').click(function() {

                $('#addCertificateModal').addClass('hidden');

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
