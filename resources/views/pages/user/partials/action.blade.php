<div class="flex gap-2">

    <a class="btnEdit
           bg-yellow-500 hover:bg-yellow-600
           text-white px-2 py-1 rounded-md
           cursor-pointer"
        data-id="{{ $row->id }}">
        <i class="fa fa-pen"></i>
    </a>
    @if (auth()->id() != $row->id)
        <a data-id="{{ $row->id }}"
            class="btnDelete
           bg-red-500
           hover:bg-red-600
           text-white
           px-2 py-1
           rounded-md
           cursor-pointer">

            <i class="fa fa-trash"></i>

        </a>
    @endif

</div>
