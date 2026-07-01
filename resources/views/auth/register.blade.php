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
            <div class="left-0 w-full h-2 rounded-t-[30px] bg-[#fbf306]"></div>

            <h1 class="text-3xl font-bold text-center text-[#146379] mt-4">
                Buat Akun!
            </h1>

            <p class="text-center text-gray-500 text-sm mt-2 mb-7">
                Buat Akun untuk mengakses.
            </p>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Name --}}
                <div>

                    <label class="text-sm font-medium text-gray-700">
                        Nama Lengkap
                    </label>

                    <div class="relative mt-2">

                        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-[#199db7]"></i>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-xl border-gray-300 pl-11 h-12 focus:ring-[#199db7] focus:border-[#199db7]"
                            placeholder="Masukkan Nama Lengkap Anda"
                            required>

                    </div>

                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>

                </div>

                {{-- Email --}}
                <div>

                    <label class="text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <div class="relative mt-2">

                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[#199db7]"></i>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-xl border-gray-300 pl-11 h-12 focus:ring-[#199db7] focus:border-[#199db7]"
                            placeholder="Masukkan Email Anda"
                            required>

                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                </div>

                {{-- Password --}}
                <div>

                    <label class="text-sm font-medium text-gray-700">
                        Password
                    </label>

                    <div class="relative mt-2">

                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#199db7]"></i>

                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-xl border-gray-300 pl-11 h-12 focus:ring-[#199db7] focus:border-[#199db7]"
                            placeholder="Buat Password"
                            required>

                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                </div>

                {{-- Confirm Password --}}
                <div>

                    <label class="text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>

                    <div class="relative mt-2">

                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#199db7]"></i>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full rounded-xl border-gray-300 pl-11 h-12 focus:ring-[#199db7] focus:border-[#199db7]"
                            placeholder="Konfirmasi Password"
                            required>

                    </div>  

                </div>

                {{-- Button --}}
                <button
                    class="w-full h-12 rounded-xl bg-[#199db7] hover:bg-[#146379] text-white font-semibold transition duration-300">

                    Buat Akun

                </button>

                <p class="text-center text-sm text-gray-500">

                    Sudah Punya Akun?

                    <a
                        href="{{ route('login') }}"
                        class="text-[#199db7] hover:text-[#146379] font-semibold">

                        Login

                    </a>

                </p>

            </form>

        </div>

    </div>

</div>
@endsection