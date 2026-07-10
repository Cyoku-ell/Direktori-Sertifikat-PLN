<div class="flex items-center gap-3 mt-4">

    {{-- UNIT --}}
    <div class="relative">

        <button type="button" data-target="#unitDropdown"
            class="filter-btn flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7] shadow-sm border
                          border-[#199db7] transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-[#199db7]">

            Unit

            <i class="fa fa-chevron-down dropdown-arrow text-xs"></i>

        </button>

        <div id="unitDropdown"
            class="filter-dropdown hidden absolute mt-2 w-56 bg-white rounded-xl shadow-lg border z-50">

            <ul class="py-2">

                <li class="unit-option px-4 py-2 hover:bg-gray-100 cursor-pointer" data-value="">

                    Semua Unit

                </li>

                @foreach ($units as $unit)
                    <li class="unit-option px-4 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $unit->id }}">

                        {{ $unit->name }}

                    </li>
                @endforeach

            </ul>

        </div>

    </div>


    {{-- CERTIFICATION --}}
    <div class="relative">

        <button type="button" data-target="#certificationDropdown"
            class="filter-btn flex items-center gap-2 px-4 py-2 bg-white rounded-lg text-sm font-medium text-[#199db7] shadow-sm border
                          border-[#199db7] transition transform duration-200 ease-out hover:scale-110 hover:shadow-md hover:text-white hover:bg-[#199db7]">

            Sertifikasi

            <i class="fa fa-chevron-down dropdown-arrow text-xs"></i>

        </button>

        <div id="certificationDropdown"
            class="filter-dropdown hidden absolute mt-2 w-56 bg-white rounded-xl shadow-lg border z-50">

            <ul class="py-2">

                <li class="certification-option px-4 py-2 hover:bg-gray-100 cursor-pointer" data-value="">

                    Semua Sertifikasi

                </li>

                @foreach ($certifications as $certification)
                    <li class="certification-option px-4 py-2 hover:bg-gray-100 cursor-pointer"
                        data-value="{{ $certification->id }}">

                        {{ $certification->name }}

                    </li>
                @endforeach

            </ul>

        </div>

    </div>

</div>

{{-- Active Filter --}}
<div id="activeFilters" class="flex flex-wrap gap-2 mt-3">

</div>
