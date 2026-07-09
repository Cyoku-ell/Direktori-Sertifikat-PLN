@extends('layouts.app')

@section('content')
    <div class="p-8">

        {{-- Header --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-3xl font-bold text-[#146379]">

                        Direktori Pegawai

                    </h1>

                    <p class="text-gray-500 mt-2">

                        Mengatur data pegawai PLN.

                    </p>

                </div>

                <button id="btnAddUser"
                    class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7]
                shadow-sm border border-[#199db7]
                transition transform duration-200 ease-out
                hover:scale-110 hover:shadow-md
                hover:text-white hover:bg-[#199db7]">

                    <i class="fa-solid fa-user-plus"></i>

                    Tambah Pegawai

                </button>

            </div>

        </div>


        {{-- Table --}}
        <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">

            @include('pages.user.partials.searchbar')

            @include('pages.user.partials.filter')

            <table id="userTable" class="custom-table w-full text-sm text-left bg-[#199db7] rounded-2xl">

                <thead class="text-white">

                    <tr>

                        <th class="px-5 py-4 text-center rounded-l-xl">

                            No

                        </th>

                        <th>Username</th>

                        <th>NIP</th>

                        <th>PERNER</th>

                        <th>Unit</th>

                        <th>Jabatan</th>

                        <th>Status</th>

                        <th>Role</th>

                        <th class="px-5 py-4 text-center rounded-r-xl">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody class="bg-white rounded-b-3xl">

                </tbody>

            </table>

        </div>

    </div>

    @include('pages.user.modal.add')

    @include('pages.user.modal.edit')
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            let table = $('#userTable').DataTable({

                processing: true,

                serverSide: true,

                paging: true,

                dom: 'rtp',

                ajax: "{{ route('users.datatable') }}",

                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },

                    {
                        data: 'username',
                        name: 'username'
                    },

                    {
                        data: 'nip',
                        name: 'nip'
                    },

                    {
                        data: 'perner',
                        name: 'perner'
                    },

                    {
                        data: 'unit',
                        name: 'unit.name'
                    },

                    {
                        data: 'position',
                        name: 'position.name'
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'role',
                        name: 'roles.name'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }

                ]

            });

            // ===============================
            // OPEN MODAL
            // ===============================

            $('#btnAddUser').click(function() {

                $('#userForm')[0].reset();

                $('#username').val('');

                $('#addUserModal').removeClass('hidden');

            });

            // ===============================
            // CLOSE MODAL
            // ===============================

            $('#closeUserModal').click(function() {

                $('#addUserModal').addClass('hidden');

            });

            // username auto

            $('#email').on('keyup change', function() {

                let email = $(this).val();

                let username = email.split('@')[0];

                $('#username').val(username);

            });


            $('#searchInput').keyup(function() {

                table.search($(this).val()).draw();

            });

            // ===============================
            // SUBMIT FORM
            // ===============================

            $('#userForm').submit(function(e) {

                e.preventDefault();

                let form = $(this);

                $.ajax({

                    url: "{{ route('users.store') }}",

                    type: "POST",

                    data: form.serialize(),

                    success: function(res) {

                        toastr.success(res.message);

                        $('#addUserModal').addClass('hidden');

                        form[0].reset();

                        $('#username').val('');

                        table.ajax.reload(null, false);

                    },

                    error: function(xhr) {

                        console.log(xhr.responseJSON);

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            Object.keys(errors).forEach(function(key) {

                                toastr.error(errors[key][0]);

                            });

                        } else {

                            toastr.error('Terjadi kesalahan.');

                        }

                    }

                });

            });

        });
    </script>
@endsection
