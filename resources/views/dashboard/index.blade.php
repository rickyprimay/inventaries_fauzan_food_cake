<x-layout>
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="flex justify-start">
                <h1 class="text-black font-bold text-2xl mb-2">Selamat Datang <span
                        class="text-red-500 font-outline-1">{{ $name }}</span></h1>
            </div>
            <div class="flex justify-start">
                <h1 class="text-black font-bold text-2xl mb-2">Dari Outlet {{ $outlet }}</span></h1>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <div class="rounded-xl border border-stroke bg-white px-7.5 py-6 shadow-default">
                    <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 ">
                        <i class="fa-solid fa-bag-shopping text-blue-500"></i>
                    </div>
                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black">
                                {{ $countProducts }}
                            </h4>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium">Total Barang</span>
                        <a href="{{ route('product') }}" class="hover:text-black text-sm font-medium text-primary">Lihat
                            Semua</a>
                    </div>
                </div>

                <div class="rounded-xl border border-stroke bg-white px-7.5 py-6 shadow-default">
                    <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                        <i class="fa-solid fa-truck text-red-500"></i>
                    </div>
                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black">
                                {{ $countDeliveries }}
                            </h4>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium">Total Pengiriman</span>
                        <a href="{{ route('delivery') }}"
                            class="hover:text-black text-sm font-medium text-primary">Lihat Semua</a>
                    </div>
                </div>

                <div class="rounded-xl border border-stroke bg-white px-7.5 py-6 shadow-default">
                    <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                        <i class="fa-solid fa-cart-shopping text-green-500"></i>
                    </div>
                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black">
                                {{ $countTransactions }}
                            </h4>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium">Total Transaksi</span>
                        <a href="{{ route('transactions') }}"
                            class="hover:text-black text-sm font-medium text-primary">Lihat Semua</a>
                    </div>
                </div>

                <div class="rounded-xl border border-stroke bg-white px-7.5 py-6 shadow-default">
                    <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2">
                        <i class="fa-solid fa-file-signature text-yellow-500"></i>
                    </div>
                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <h4 class="text-title-md font-bold text-black">
                                {{ $countStokist }}
                            </h4>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium">Total Laporan Stokist</span>
                        <a href="{{ route('stokist-report') }}"
                            class="hover:text-black text-sm font-medium text-primary">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-6 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
                <div
                    class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default sm:px-7.5 xl:col-span-8">
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
                        <div class="flex w-full flex-wrap gap-3 sm:gap-5">
                            <div class="flex min-w-47.5">
                                <span
                                    class="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-red-500">
                                    <span class="block h-2.5 w-full max-w-2.5 rounded-full bg-red-500"></span>
                                </span>
                                <div class="w-full">
                                    <p class="font-semibold text-red-500">Total Pengiriman</p>
                                    <p class="text-sm font-medium date_range">{{ $startDateFormat }} - {{ $endDateFormat }}</p>
                                </div>
                            </div>
                            <div class="flex min-w-47.5">
                                <span
                                    class="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-yellow-500">
                                    <span class="block h-2.5 w-full max-w-2.5 rounded-full bg-yellow-500"></span>
                                </span>
                                <div class="w-full">
                                    <p class="font-semibold text-yellow-500">Total Transkasi</p>
                                    <p class="text-sm font-medium date_range">{{ $startDateFormat }} - {{ $endDateFormat }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full max-w-xs justify-end">
                            <div class="inline-flex items-center rounded-md bg-gray-400 p-1.5">
                                <button
                                    class="rounded px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white hover:shadow-card"
                                    id="weekButton" onclick="applyFilter('week')">Minggu
                                </button>
                                <button
                                    class="rounded px-3 py-1 text-xs font-medium text-black hover:bg-white hover:shadow-card"
                                    id="monthButton" onclick="applyFilter('month')">Bulan
                                </button>
                                <button
                                    class="rounded px-3 py-1 text-xs font-medium text-black hover:bg-white hover:shadow-card"
                                    id="yearButton" onclick="applyFilter('year')">Tahun
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="chart-container" style="position: relative; height:60vh; width: 100%;">
                        <canvas id="myChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
    
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($days),
                datasets: [{
                    label: 'Pengiriman',
                    data: @json($deliveriesData),
                    borderColor: 'rgb(239, 68, 68)',
                    tension: 0.3
                }, {
                    label: 'Transaksi',
                    data: @json($transactionsData),
                    borderColor: 'rgb(234, 179, 8)',
                    tension: 0.3
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.formattedValue;
                            }
                        }
                    }
                },
                scales: {
                    x: { title: { display: true, text: 'Tanggal' } },
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah' },
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    
        function applyFilter(filter) {
            const startDate = getStartDate(filter);
            const endDate = getEndDate();
            setActiveButton(filter);
    
            fetch(`/dashboard/filter?filter=${filter}&start_date=${startDate}&end_date=${endDate}`)
                .then(response => response.json())
                .then(data => {
                    myChart.data.labels = data.labels;
                    myChart.data.datasets[0].data = data.deliveriesData;
                    myChart.data.datasets[1].data = data.transactionsData;
                    myChart.update();
    
                    document.querySelectorAll('.date_range').forEach(el => {
                        el.innerText = `${data.startDate} - ${data.endDate}`;
                    });
                });
        }

        function setActiveButton(active) {
        const buttons = {
            week: document.getElementById("weekButton"),
            month: document.getElementById("monthButton"),
            year: document.getElementById("yearButton")
        };

        for (const key in buttons) {
            if (buttons[key]) {
                buttons[key].classList.remove("bg-white", "shadow-card");
            }
        }

        if (buttons[active]) {
            buttons[active].classList.add("bg-white", "shadow-card");
        }
    }
    
        function getStartDate(filter) {
            let today = new Date();
            if (filter === 'week') {
                today.setDate(today.getDate() - 7);
            } else if (filter === 'month') {
                today.setMonth(today.getMonth() - 1);
            } else if (filter === 'year') {
                today.setFullYear(today.getFullYear() - 1);
            }
            return today.toISOString().split('T')[0];
        }
    
        function getEndDate() {
            return new Date().toISOString().split('T')[0];
        }
    </script>
    


</x-layout>
