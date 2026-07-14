@extends('layouts.app')

@section('content')
    <div class="p-8">

        {{-- Header --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <h1 class="text-3xl font-bold text-[#146379]">

                Dashboard

            </h1>

            <p class="text-gray-500 mt-2">

                Selamat datang,
                {{ auth()->user()->name }}

            </p>

        </div>


        {{-- Cards --}}
        <div class="grid grid-cols-3 gap-6 mt-6">

            {{-- Total Certificate --}}
            <div class="bg-white rounded-3xl shadow-lg p-6">

                <h3 class="text-gray-500">

                    Total Sertifikat

                </h3>

                <h1 class="text-5xl font-bold text-[#199db7] mt-3">

                    {{ $totalCertificate }}

                </h1>

                <p class="text-gray-400 mt-3">

                    Semua sertifikat yang terdaftar

                </p>

            </div>


            {{-- Hari Ini --}}
            <div class="bg-white rounded-3xl shadow-lg p-6">

                <h3 class="text-gray-500">

                    Sertifikat Baru

                    (Hari ini)

                </h3>

                <h1 class="text-5xl font-bold text-[#199db7] mt-3">

                    {{ $todayCertificate }}

                </h1>

                <p class="text-gray-400 mt-3">

                    Upload hari ini

                </p>

            </div>


            {{-- Unit --}}
            <div class="bg-white rounded-3xl shadow-lg p-6">

                <h3 class="text-gray-500">

                    Unit

                </h3>

                <h1 class="text-5xl font-bold text-[#199db7] mt-3">

                    {{ $totalUnit }}

                </h1>

                <p class="text-gray-400 mt-3">

                    Unit yang terdaftar

                </p>

            </div>

        </div>



        {{-- Content --}}
        <div class="grid grid-cols-3 gap-6 mt-6">

            {{-- Chart --}}
            <div class="col-span-2 bg-white rounded-3xl shadow-lg p-6">

                <div class="flex justify-between items-center">

                    <h2 class="font-bold text-xl text-[#146379]">

                        Total Sertifikat

                    </h2>

                    <select id="chartFilter" class="rounded-xl border-gray-300">

                        <option value="year">

                            Tahun Ini

                        </option>

                        <option value="month">

                            Bulan Ini

                        </option>

                        <option value="week">

                            Minggu Ini

                        </option>

                    </select>

                </div>

                <div class="h-96 mt-5">
                    <canvas id="certificateChart"></canvas>
                </div>
            </div>



            {{-- Recent --}}
            <div class="bg-white rounded-3xl shadow-lg p-6">

                <div class="flex justify-between">

                    <h2 class="font-bold text-xl text-[#146379]">

                        Sertifikat Terbaru

                    </h2>

                </div>

                <div class="mt-5 space-y-5">

                    @forelse($latestCertificates as $certificate)
                        <div class="border-b pb-3">

                            <h4 class="font-semibold">

                                
                            </h4>

                            <p class="text-sm text-gray-500">

                                

                            </p>

                            <p class="text-xs text-gray-400">

                             

                            </p>

                            <p class="text-xs text-gray-400 mt-1">

                                {{ $certificate->created_at->diffForHumans() }}

                            </p>

                        </div>

                    @empty

                        <p>

                            Belum ada data.

                        </p>
                    @endforelse

                </div>

            </div>

        </div>

    </div>
@endsection

@section('script')
    <script>
        const ctx = document.getElementById('certificateChart');

        let chart = new Chart(ctx, {

            type: 'line',

            data: {

                labels: [],

                datasets: [{

                    label: 'Jumlah Sertifikat',

                    data: [],

                    borderColor: '#199db7',

                    backgroundColor: 'rgba(25,157,183,.15)',

                    fill: true,

                    tension: .4,

                    pointRadius: 5,

                    pointHoverRadius: 7

                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                animation: {

                    duration: 1800

                },

                plugins: {

                    legend: {

                        display: false

                    }

                }

            }

        });

        function loadChart(type) {

            $.get(
                "{{ route('dashboard.chart') }}", {
                    type: type
                },
                function(res) {

                    chart.data.labels = res.labels;

                    chart.data.datasets[0].data = res.data;

                    chart.update();

                }
            );

        }

        loadChart('year');

        $('#chartFilter').change(function() {

            loadChart($(this).val());

        });
    </script>
@endsection
