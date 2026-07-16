{{-- ====================================================== --}}
{{-- ACTIVE FILTER --}}
{{-- ====================================================== --}}

<div id="activeFilters" class="flex flex-wrap gap-2 mb-4"></div>

{{-- ====================================================== --}}
{{-- FILTER TOP --}}
{{-- ====================================================== --}}

<div class="flex flex-wrap items-center gap-3 mb-6">

    {{-- ====================================================== --}}
    {{-- SINKRONISASI --}}
    {{-- ====================================================== --}}

    <div class="relative inline-block">

        <button type="button" data-target="#filterSyncDropdown"
            class="filter-btn
            flex items-center gap-2
            px-4 py-2
            bg-white
            rounded-lg
            text-sm
            font-medium
            text-gray-600
            shadow-sm
            border
            border-gray-300
            transition
            transform
            duration-200
            ease-out
            hover:scale-110
            hover:shadow-md
            hover:text-white
            hover:bg-[#199db7]">

            Sinkronisasi

            <svg class="dropdown-arrow w-4 h-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

            </svg>

        </button>

        <div id="filterSyncDropdown"
            class="filter-dropdown
            hidden
            absolute
            left-0
            mt-2
            w-52
            bg-white
            rounded-xl
            shadow-xl
            border
            border-gray-200
            overflow-hidden
            z-50">

            <ul class="text-sm text-gray-700">

                <li class="sync-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="">

                    Semua

                </li>

                <li class="sync-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="1">

                    Sinkron

                </li>

                <li class="sync-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="0">

                    Belum Sinkron

                </li>

            </ul>

        </div>

    </div>

    {{-- ====================================================== --}}
    {{-- DOKUMEN PDF --}}
    {{-- ====================================================== --}}

    <div class="relative inline-block">

        <button type="button" data-target="#filterPdfDropdown"
            class="filter-btn
            flex items-center gap-2
            px-4 py-2
            bg-white
            rounded-lg
            text-sm
            font-medium
            text-gray-600
            shadow-sm
            border
            border-gray-300
            transition
            transform
            duration-200
            ease-out
            hover:scale-110
            hover:shadow-md
            hover:text-white
            hover:bg-[#199db7]">

            Dokumen PDF

            <svg class="dropdown-arrow w-4 h-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

            </svg>

        </button>

        <div id="filterPdfDropdown"
            class="filter-dropdown
            hidden
            absolute
            left-0
            mt-2
            w-52
            bg-white
            rounded-xl
            shadow-xl
            border
            border-gray-200
            overflow-hidden
            z-50">

            <ul class="text-sm text-gray-700">

                <li class="pdf-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="">

                    Semua

                </li>

                <li class="pdf-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="1">

                    Sudah Upload

                </li>

                <li class="pdf-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="0">

                    Belum Upload

                </li>

            </ul>

        </div>

    </div>

    {{-- ====================================================== --}}
    {{-- EXPIRE --}}
    {{-- ====================================================== --}}

    <div class="relative inline-block">

        <button type="button" data-target="#filterExpiredDropdown"
            class="filter-btn
            flex items-center gap-2
            px-4 py-2
            bg-white
            rounded-lg
            text-sm
            font-medium
            text-gray-600
            shadow-sm
            border
            border-gray-300
            transition
            transform
            duration-200
            ease-out
            hover:scale-110
            hover:shadow-md
            hover:text-white
            hover:bg-[#199db7]">

            Expire 

            <svg class="dropdown-arrow w-4 h-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

            </svg>

        </button>

        <div id="filterExpiredDropdown"
            class="filter-dropdown
            hidden
            absolute
            left-0
            mt-2
            w-52
            bg-white
            rounded-xl
            shadow-xl
            border
            border-gray-200
            overflow-hidden
            z-50">

            <ul class="text-sm text-gray-700">

                <li class="expired-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="">

                    Semua

                </li>

                <li class="expired-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="1">

                    Belum atur expire

                </li>

                <li class="expired-option px-4 py-3 hover:bg-gray-100 cursor-pointer" data-value="0">

                    Sudah atur expire

                </li>

            </ul>

        </div>

    </div>




    {{-- ====================================================== --}}
    {{-- UNIT --}}
    {{-- ====================================================== --}}

    <div class="relative inline-block">

        <button type="button" data-target="#filterUnitDropdown"
            class="filter-btn
            flex items-center gap-2
            px-4 py-2
            bg-white
            rounded-lg
            text-sm
            font-medium
            text-gray-600
            shadow-sm
            border
            border-gray-300
            transition
            transform
            duration-200
            ease-out
            hover:scale-110
            hover:shadow-md
            hover:text-white
            hover:bg-[#199db7]">

            Unit

            <svg class="dropdown-arrow w-4 h-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

            </svg>

        </button>

        <div id="filterUnitDropdown"
            class="filter-dropdown
            hidden
            absolute
            left-0
            mt-2
            w-64
            bg-white
            rounded-xl
            shadow-xl
            border
            border-gray-200
            overflow-hidden
            z-50">

            <ul class="text-sm text-gray-700 max-h-72 overflow-y-auto">

                <li class="unit-option
                    px-4
                    py-3
                    hover:bg-gray-100
                    cursor-pointer"
                    data-value="">

                    Semua Unit

                </li>

                @foreach ($units as $unit)
                    <li class="unit-option
                        px-4
                        py-3
                        hover:bg-gray-100
                        cursor-pointer"
                        data-value="{{ $unit->id }}">

                        {{ $unit->name }}

                    </li>
                @endforeach

            </ul>

        </div>

    </div>



</div>
