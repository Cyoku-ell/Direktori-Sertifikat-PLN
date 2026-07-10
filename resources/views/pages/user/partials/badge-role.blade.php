@if ($role == 'admin')
    <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs font-semibold">
        Admin
    </span>
@else
    <span class="px-3 py-1 rounded-full bg-sky-100 text-sky-600 text-xs font-semibold">
        Pegawai
    </span>
@endif
