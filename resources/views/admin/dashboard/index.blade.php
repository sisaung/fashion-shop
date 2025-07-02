@extends('layout.dashboard')

@section('content')
    <div class="px-5">


        <div class="grid grid-cols-4 gap-5 ">
            <div class="border border-gray-200 p-5 space-y-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-blue-500 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    </div>
                </div>

                <div>
                    <p class="text-2xl font-semibold"> {{ number_format($totalRevenue) }} MMK </p>
                    <p class="text-stone-600 text-sm"> Total Revenue </p>
                </div>
            </div>

            <div class="border border-gray-200 p-5 space-y-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-blue-500 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>


                    </div>
                </div>

                <div>
                    <p class="text-2xl font-semibold"> {{ number_format($totalOrder) }} </p>
                    <p class="text-stone-600 text-sm"> Total Orders </p>
                </div>
            </div>

            <div class="border border-gray-200 p-5 space-y-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-blue-500 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>


                    </div>
                </div>

                <div>
                    <p class="text-2xl font-semibold"> {{ number_format($totalProduct) }} </p>
                    <p class="text-stone-600 text-sm"> Total Products </p>
                </div>
            </div>

            <div class="border border-gray-200 p-5 space-y-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-blue-500 stroke-2 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>


                    </div>
                </div>

                <div>
                    <p class="text-2xl font-semibold"> {{ number_format($totalCustomer) }} </p>
                    <p class="text-stone-600 text-sm"> Total Customers </p>
                </div>
            </div>


        </div>

        {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-600">Total Revenue</p>
                <p class="text-xl font-semibold">${{ number_format($totalRevenue, 2) }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-600">Total Orders</p>
                <p class="text-xl font-semibold">{{ $totalOrder }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-600">Total Products</p>
                <p class="text-xl font-semibold">{{ $totalProduct }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-gray-600">Total Customers</p>
                <p class="text-xl font-semibold">{{ $totalCustomer }}</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-4">Monthly Revenue & Orders</h3>
            <canvas id="revenueOrdersChart" height="100"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = @json($monthlyData);

            const labels = data.map(item => item.month);
            const orderCounts = data.map(item => item.order_count);
            const revenues = data.map(item => item.total_revenue);

            const ctx = document.getElementById('revenueOrdersChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Orders',
                            data: orderCounts,
                            backgroundColor: 'rgba(59, 130, 246, 0.5)', // blue-500
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1,
                            yAxisID: 'y-orders',
                        },
                        {
                            label: 'Revenue',
                            data: revenues,
                            backgroundColor: 'rgba(16, 185, 129, 0.5)', // emerald-500
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 2,
                            type: 'line',
                            yAxisID: 'y-revenue',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    stacked: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Monthly Revenue and Orders (Last 6 Months)',
                            font: {
                                size: 18
                            }
                        }
                    },
                    scales: {
                        y - orders: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Orders'
                            },
                            beginAtZero: true
                        },
                        y - revenue: {
                            type: 'linear',
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Revenue ($)'
                            },
                            grid: {
                                drawOnChartArea: false
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script> --}}
@endsection

@push('scripts')
@endpush
