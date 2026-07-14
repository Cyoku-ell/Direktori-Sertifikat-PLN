<div class="flex items-center justify-center gap-2">

    {{-- Detail --}}
    <a href="{{ route('certificates.show', $certificate->id) }}"
        class="w-10 h-10
        rounded-xl
        bg-sky-100
        hover:bg-sky-200
        text-sky-600
        transition
        flex items-center justify-center"
        title="Detail">

        <i class="fa-solid fa-eye"></i>

    </a>

    {{-- Edit --}}
    <button type="button"
        class="editCertificateBtn
        w-10 h-10
        rounded-xl
        bg-amber-100
        hover:bg-amber-200
        text-amber-600
        transition
        flex items-center justify-center"
        data-id="{{ $certificate->id }}" title="Edit">

        <i class="fa-solid fa-pen-to-square"></i>

    </button>

    {{-- Delete --}}
    <button type="button"
        class="deleteCertificateBtn
        w-10 h-10
        rounded-xl
        bg-red-100
        hover:bg-red-200
        text-red-600
        transition
        flex items-center justify-center"
        data-id="{{ $certificate->id }}" data-title="{{ $certificate->title }}" title="Hapus">

        <i class="fa-solid fa-trash"></i>

    </button>

</div>
