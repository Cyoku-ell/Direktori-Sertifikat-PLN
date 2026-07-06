<div class="bg-gradient-to-r from-[#1c98b0] to-[#25b6d3] h-20 flex items-center justify-between px-6 shadow-md">

    {{-- Logo --}}
    <img src="{{ asset('assets/Logo_PLN.png') }}" class="h-12 w-auto" alt="PLN Logo">

    {{-- Logout khusus User --}}
    @role('user')
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="flex items-center gap-2
                bg-white/15 hover:bg-white/25
                text-white
                px-4 py-2
                rounded-xl
                transition-all duration-200">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </button>
        </form>
    @endrole

</div>
