<div class="flex gap-2">

    <a href="{{ route('certificates.show',$row->id) }}"
        class="bg-[#199db7]
        hover:bg-[#146379]
        text-white
        px-2 py-1 rounded-md">

        <i class="fa fa-eye"></i>

    </a>

    <a
        data-id="{{ $row->id }}"
        id="btnEdit"

        class="bg-[#fbf306]
        hover:bg-yellow-400
        text-gray-800
        px-2 py-1 rounded-md">

        <i class="fa fa-pen"></i>

    </a>

    @role('admin')

    <a
        data-id="{{ $row->id }}"
        id="btnDelete"

        class="bg-red-500
        hover:bg-red-600
        text-white
        px-2 py-1 rounded-md">

        <i class="fa fa-trash"></i>

    </a>

    @endrole

</div>