<div class="flex gap-2">

    <a href="{{ route('certificates.show', $row->id) }}"
        class="bg-[#199db7]
        hover:bg-[#146379]
        text-white
        px-2 py-1 rounded-md">

        <i class="fa fa-eye"></i>

    </a>

    <a class="btnEdit
           bg-blue-500 hover:bg-blue-600
           text-white px-2 py-1 rounded-md
           cursor-pointer"
        data-id="{{ $row->id }}">
        <i class="fa fa-pen"></i>
    </a>

    @role('admin')
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
    @endrole

</div>
