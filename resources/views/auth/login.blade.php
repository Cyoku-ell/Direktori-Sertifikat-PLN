@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-10">

    <div class="flex flex-col items-center">

        {{-- Character --}}
        <div class="w-62 -mb-12  select-none">
            <img
                src="{{ asset('assets/Gemini_Generated_Image_ewkq7lewkq7lewkq-removebg-preview.png') }}"
                alt="PLN Character"
                class="w-full object-contain drop-shadow-2xl">
        </div>

        {{-- Card --}}
        <div class="w-full max-w-[390px] bg-white rounded-[30px] shadow-2xl p-7 relative">

            {{-- Accent Line --}}
            <div class="absolute top-0 left-0 w-full h-2 rounded-t-[30px] bg-[#fbf306]"></div>

            <h1 class="text-3xl font-bold text-center text-[#146379] mt-4">
                Selamat Datang!
            </h1>

            <p class="text-center text-gray-500 text-sm mt-2 mb-7">
                Login dengan akun yang di sediakan untuk melanjutkan akses.
            </p>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Username --}}
                <div>

                    <label class="text-sm font-medium text-gray-700">
                        Username  <span class="text-red-700">*</span>
                    </label>

                    <div class="relative mt-2">

                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[#199db7]"></i>

                        <input
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            class="w-full rounded-xl border-gray-300 pl-11 h-12 focus:ring-[#199db7] focus:border-[#199db7]"
                            placeholder="Masukkan Username Anda"
                            required
                            autofocus>

                    </div>

                    <x-input-error :messages="$errors->get('username')" class="mt-2"/>

                </div>

                {{-- Password --}}
                <div>

                    <label class="text-sm font-medium text-gray-700">
                        Password <span class="text-red-700">*</span>
                    </label>

                    <div class="relative mt-2">

                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#199db7]"></i>

                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-xl border-gray-300 pl-11 h-12 focus:ring-[#199db7] focus:border-[#199db7]"
                            placeholder="Masukkan Password Anda"
                            required>

                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">

                    <label class="flex items-center gap-2">

                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-[#199db7] focus:ring-[#199db7]">

                        <span class="text-sm text-gray-600">
                            Remember Me
                        </span>

                    </label>

                  

                </div>

                {{-- Button --}}
                <button
                    type="submit"
                    class="w-full h-12 rounded-xl bg-[#199db7] hover:bg-[#146379] text-white font-semibold transition duration-300">

                    Sign In

                </button>

               
            </form>

        </div>

    </div>

</div>
@endsection