<footer class="bg-gradient-to-r from-[#1c98b0] to-[#25b6d3] text-white"> 
    <div class="max-w-7xl w-full mx-auto px-4 py-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

            <!-- Logo -->
            <a href="/" class="flex justify-center sm:justify-start">
                <img src="{{ asset('assets/Logo_PLN.png') }}" class="h-16 w-auto" alt="PLN Logo" />
            </a>

            <!-- Menu -->
            <ul class="flex flex-wrap justify-center sm:justify-end gap-4 text-sm font-medium text-white">
                <li>
                    <a href="#" class="hover:text-white transition">
                        About
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-white transition">
                        Privacy Policy
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-white transition">
                        Licensing
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-white transition">
                        Contact
                    </a>
                </li>
            </ul>

        </div>

        <!-- Copyright -->
        <div class="mt-6 border-t pt-6 text-center text-sm text-white">
            © {{ date('Y') }}
            <span class="font-medium text-white">PLN</span>.
            All Rights Reserved.
        </div>

    </div>
</footer>
