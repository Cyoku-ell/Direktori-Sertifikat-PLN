<div class="flex items-center justify-center gap-2">

    {{-- Edit --}}
    <button type="button"
        class="btnEdit
        w-10 h-10
        rounded-xl
        bg-amber-100
        hover:bg-amber-200
        text-amber-600
        transition
        flex items-center justify-center"
        data-id="{{ $row->id }}" title="Edit">

        <i class="fa-solid fa-pen-to-square"></i>

    </button>

    @if (auth()->id() != $row->id)
        {{-- Delete --}}
        <button type="button"
            class="btnDelete
            w-10 h-10
            rounded-xl
            bg-red-100
            hover:bg-red-200
            text-red-600
            transition
            flex items-center justify-center"
            data-id="{{ $row->id }}" title="Hapus">

            <i class="fa-solid fa-trash"></i>

        </button>
    @endif

</div>
