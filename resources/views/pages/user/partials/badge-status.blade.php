@switch($status)
    @case('Tetap')
        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
            Tetap
        </span>
    @break

    @case('Kontrak')
        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
            Kontrak
        </span>
    @break

    @case('Outsourcing')
        <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
            Outsourcing
        </span>
    @break

    @default
        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
            Magang
        </span>
@endswitch
