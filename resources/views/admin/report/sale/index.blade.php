{{-- @extends('layout.dashboard')
@section('content')
    <div class="mt-5">
        <div class="bg-white p-4 rounded shadow mb-8">
            <h2 class="text-lg font-semibold mb-4">Monthly Sales Revenue</h2>
            <canvas id="salesRevenueChart" height="100"></canvas>
        </div>

        <div class="bg-white p-4 rounded shadow mb-8 ">
            <h2 class="text-lg font-semibold mb-4">Best-Selling Products</h2>
            <canvas id="bestSellingChart" height="150"></canvas>
        </div>
    </div>
@endsection
@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <script>
        // monthly revenue
        const salesRevenueCtx = document.getElementById('salesRevenueChart').getContext('2d');
        new Chart(salesRevenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlySalesLabels) !!},
                datasets: [{
                    label: 'Revenue ($)',
                    data: {!! json_encode($monthlySalesData) !!},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // best selling products
        const bestSellingCtx = document.getElementById('bestSellingChart').getContext('2d');

        const bestSellingLabels = {!! json_encode($bestSellingLabels) !!};
        const bestSellingData = {!! json_encode($bestSellingData) !!};

        const barColors = [
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 159, 64, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 205, 86, 0.8)'
        ];

        new Chart(bestSellingCtx, {
            type: 'bar',
            data: {
                labels: bestSellingLabels,
                datasets: [{
                    label: 'Units Sold',
                    data: bestSellingData,
                    backgroundColor: barColors.slice(0, bestSellingLabels.length),
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', //  horizontal
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true
                    },
                    datalabels: { //  Data labels configuration
                        anchor: 'end',
                        align: 'right',
                        formatter: function(value) {
                            return value;
                        },
                        color: '#000',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Units Sold'
                        }
                    },
                    y: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]

        });
    </script>
@endpush --}}

@extends('layout.dashboard')

@php
    $timefilter = [
        ['value' => 'today', 'label' => 'Today'],
        ['value' => 'yesterday', 'label' => 'Yesterday'],
        ['value' => 'last_7_days', 'label' => 'Last 7 Days'],
        ['value' => 'this_month', 'label' => 'This Month'],
        ['value' => 'last_month', 'label' => 'Last Month'],
        ['value' => 'this_year', 'label' => 'This Year'],
        ['value' => 'last_year', 'label' => 'Last Year'],
    ];
@endphp

@section('content')
    <div class="mt-5 -mx-5 mb-5">
        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Sales Report',
        ])
    </div>
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">Sales Report</h1>
        {{-- <form method="GET" action="{{ route('dashboard.index') }}" class="mb-4 ">
            <select name="filter" onchange="this.form.submit()" class="border p-2 rounded w-40">
                <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Today</option>
                <option value="yesterday" {{ $filter == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                <option value="last_7_days" {{ $filter == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="last_month" {{ $filter == 'last_month' ? 'selected' : '' }}>Last Month</option>
                <option value="this_year" {{ $filter == 'this_year' ? 'selected' : '' }}>This Year</option>
                <option value="last_year" {{ $filter == 'last_year' ? 'selected' : '' }}>Last Year</option>
            </select>
        </form> --}}

        <div class="relative inline-block w-42">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 text-gray-500 absolute left-3  transform translate-y-1/2 pointer-events-none">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 6v-1.5m7.5 1.5V4.5M3.75 9h16.5M4.5 7.5h15a.75.75 0 0 1 .75.75v12a.75.75 0 0 1-.75.75h-15a.75.75 0 0 1-.75-.75v-12a.75.75 0 0 1 .75-.75z" />
            </svg>
            <select name="timefilter" id="time-filter"
                class="appearance-none border rounded-md p-2 pl-10 cursor-pointer border-gray-200 text-gray-600  w-full">
                @foreach ($timefilter as $filter)
                    <option value="{{ $filter['value'] }}" {{ $timefilter == $filter['value'] ? 'selected' : '' }}>
                        {{ $filter['label'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-white shadow  rounded-lg p-5">

            <div class="bg-blue-50 p-3 rounded-lg inline-flex mb-3">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 stroke-2 stroke-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                </svg>

            </div>

            <div class="text-2xl font-bold">{{ number_format(array_sum($monthlySalesData->toArray())) }} MMK</div>
            <div class="text-sm text-gray-600">Total Sale</div>

        </div>
        <div class="bg-white shadow rounded-lg p-5">

            <div class="bg-blue-50 p-3 rounded-lg inline-flex mb-3">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 stroke-2 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

            </div>

            <div class="text-2xl font-bold">{{ array_sum($monthlyOrdersData->toArray()) }}</div>
            <div class="text-sm text-gray-600">Total Orders</div>
        </div>
        <div class="bg-white shadow rounded-lg p-5">

            <div class="bg-blue-50 p-3 rounded-lg inline-flex mb-3">

                <span class="text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-shopping-bag-icon lucide-shopping-bag">
                        <path d="M16 10a4 4 0 0 1-8 0" />
                        <path d="M3.103 6.034h17.794" />
                        <path
                            d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                    </svg>
                </span>

            </div>

            <div class="text-2xl font-bold">
                {{ number_format(array_sum($monthlySalesData->toArray()) / max(array_sum($monthlyOrdersData->toArray()), 1)) }}
                MMK </div>
            <div class="text-sm text-gray-600">Avg Order Value</div>

        </div>
    </div>

    {{-- Monthly Sales Revenue Chart --}}
    <div class="bg-white shadow rounded p-4 mb-8">
        <h2 class="text-lg font-semibold mb-2"> Sale Trends</h2>
        <canvas id="monthlySalesChart"></canvas>
    </div>

    {{-- Best Selling Products --}}

    <div class="bg-white shadow rounded p-4 mb-8 h-[400px]">
        {{-- <div class="w-full md:w-1/2 mx-auto"> --}}
        <canvas id="bestSellingChart"></canvas>
        {{-- </div> --}}
    </div>

    <div class="bg-white shadow rounded p-4">
        <h2 class="text-lg font-semibold mb-2">Best Selling Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($bestSellingProducts as $product)
                <div class="flex items-center gap-4 border border-pearl-bush-100 shadow px-3 py-2 rounded-md">
                    <div class="relative">
                        <img src="{{ $product->preview ? asset('/storage/' . $product->preview) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949' }}"
                            class="size-16 object-cover object-center rounded">
                        <div class="absolute top-0 left-0 w-full h-full bg-black/4"></div>
                    </div>
                    <div>
                        <div class="font-semibold">{{ $product->product_name }}</div>
                        <div class="text-sm text-gray-500">Sold: {{ $product->total_sold }}</div>
                        <div class="text-sm text-gray-500">Sale: {{ $product->total_sale }} </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <script>
        // const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        // new Chart(ctx, {
        //     type: 'line',
        //     data: {
        //         labels: @json($monthlySalesLabels),
        //         datasets: [{
        //                 label: 'This Year Sale',
        //                 data: @json($monthlySalesData),
        //                 borderColor: 'rgb(75, 192, 192)',
        //                 tension: 0.3,
        //                 fill: true
        //             },
        //             {
        //                 label: 'Last Year Sale',
        //                 data: @json($monthlyLastYearData),
        //                 borderColor: 'rgb(255, 99, 132)',
        //                 tension: 0.3,
        //                 fill: false
        //             }
        //         ]
        //     }
        // });



        // production lakh
        // const ctx = document.getElementById('monthlySalesChart').getContext('2d');

        // new Chart(ctx, {
        //     type: 'line',
        //     data: {
        //         labels: @json($monthlySalesLabels),
        //         datasets: [{
        //                 label: 'This Year Sale',
        //                 data: @json($monthlySalesData),
        //                 borderColor: '#4bc0c0',
        //                 backgroundColor: 'rgba(75, 192, 192, 0.1)',
        //                 tension: 0.3,
        //                 fill: false,
        //                 pointRadius: 3,
        //                 pointHoverRadius: 5,
        //             },
        //             {
        //                 label: 'Last Year Sale',
        //                 data: @json($monthlyLastYearData),
        //                 borderColor: '#ff6384',
        //                 tension: 0.3,
        //                 fill: false,
        //                 borderDash: [4, 4],
        //                 pointRadius: 3,
        //                 pointHoverRadius: 5,
        //             }
        //         ]
        //     },
        //     options: {
        //         responsive: true,
        //         // maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 position: 'top',
        //             },
        //             tooltip: {
        //                 callbacks: {
        //                     label: function(context) {
        //                         const value = context.parsed.y;
        //                         if (value >= 10000000) {
        //                             return (value / 10000000).toFixed(1) + ' Cr Ks';
        //                         } else if (value >= 100000) {
        //                             return (value / 100000).toFixed(1) + ' Lakh Ks';
        //                         } else if (value >= 1000) {
        //                             return (value / 1000).toFixed(1) + ' K Ks';
        //                         }
        //                         return value + ' Ks';
        //                     }
        //                 }
        //             },
        //         },
        //         scales: {
        //             x: {
        //                 grid: {
        //                     display: false
        //                 },
        //             },
        //             y: {
        //                 beginAtZero: true,
        //                 ticks: {
        //                     callback: function(value) {
        //                         if (value >= 10000000) {
        //                             return (value / 10000000).toFixed(1) + ' Cr';
        //                         } else if (value >= 100000) {
        //                             return (value / 100000).toFixed(1) + ' Lakh';
        //                         } else if (value >= 1000) {
        //                             return (value / 1000).toFixed(1) + ' K';
        //                         }
        //                         return value + ' Ks';
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // });

        // const ctx = document.getElementById('monthlySalesChart').getContext('2d');

        // new Chart(ctx, {
        //     type: 'line',
        //     data: {
        //         labels: @json($monthlySalesLabels),
        //         datasets: [{
        //                 label: 'This Year Sale',
        //                 data: @json($monthlySalesData),
        //                 borderColor: '#4bc0c0',
        //                 backgroundColor: 'rgba(75, 192, 192, 0.1)',
        //                 tension: 0.3,
        //                 fill: true,
        //                 pointRadius: 3,
        //                 pointHoverRadius: 5,
        //             },
        //             {
        //                 label: 'Last Year Sale',
        //                 data: @json($monthlyLastYearData),
        //                 borderColor: '#ff6384',
        //                 tension: 0.3,
        //                 fill: false,
        //                 borderDash: [4, 4],
        //                 pointRadius: 3,
        //                 pointHoverRadius: 5,
        //             }
        //         ]
        //     },
        //     options: {
        //         responsive: true,
        //         // maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 position: 'top'
        //             },
        //             tooltip: {
        //                 callbacks: {
        //                     label: function(context) {
        //                         const value = context.parsed.y;
        //                         if (value >= 1000) {
        //                             return context.dataset.label + ': ' + (value / 1000).toFixed(1) + ' K Ks';
        //                         }
        //                         return context.dataset.label + ': ' + value + ' Ks';
        //                     }
        //                 }
        //             },
        //         },
        //         scales: {
        //             x: {
        //                 grid: {
        //                     display: false
        //                 }
        //             },
        //             y: {
        //                 beginAtZero: true,
        //                 ticks: {
        //                     callback: function(value) {
        //                         if (value >= 1000) {
        //                             return (value / 1000).toFixed(1) + ' K';
        //                         }
        //                         return value + ' Ks';
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // });

        // const ctx = document.getElementById('monthlySalesChart').getContext('2d');

        // new Chart(ctx, {
        //     type: 'line',
        //     data: {
        //         labels: @json($monthlySalesLabels),
        //         datasets: [{
        //                 label: 'This Year Sale',
        //                 data: @json($monthlySalesData), // include nulls for future months
        //                 borderColor: '#4bc0c0',
        //                 backgroundColor: 'rgba(75, 192, 192, 0.1)',
        //                 tension: 0.3,
        //                 fill: true,
        //                 pointRadius: 3,
        //                 pointHoverRadius: 5,
        //                 spanGaps: false
        //             },
        //             {
        //                 label: 'Last Year Sale',
        //                 data: @json($monthlyLastYearData),
        //                 borderColor: '#ff6384',
        //                 borderDash: [6, 6],
        //                 tension: 0.3,
        //                 fill: false,
        //                 pointRadius: 3,
        //                 pointHoverRadius: 5,
        //             }
        //         ]
        //     },
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             legend: {
        //                 position: 'top'
        //             },
        //             tooltip: {
        //                 callbacks: {
        //                     label: function(context) {
        //                         const value = context.parsed.y;
        //                         if (value >= 1000000) return context.dataset.label + ': ' + (value / 1000000)
        //                             .toFixed(1) + ' M Ks';
        //                         if (value >= 1000) return context.dataset.label + ': ' + (value / 1000).toFixed(
        //                             1) + ' K Ks';
        //                         return context.dataset.label + ': ' + value + ' Ks';
        //                     }
        //                 }
        //             }
        //         },
        //         scales: {
        //             x: {
        //                 grid: {
        //                     display: false
        //                 }
        //             },
        //             y: {
        //                 beginAtZero: true,
        //                 ticks: {
        //                     callback: function(value) {
        //                         if (value >= 1000000) return (value / 1000000).toFixed(1) + ' M Ks';
        //                         if (value >= 1000) return (value / 1000).toFixed(1) + ' K Ks';
        //                         return value + ' Ks';
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // });




        //sure
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthlySalesLabels),
                datasets: [{
                        label: 'This Year Sale',
                        data: @json($monthlySalesData),
                        borderColor: '#4bc0c0',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        tension: 0.3,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        spanGaps: false
                    },
                    {
                        label: 'Last Year Sale',
                        data: @json($monthlyLastYearData),
                        borderColor: '#ff6384',
                        borderDash: [6, 6],
                        tension: 0.3,
                        fill: false,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed.y;
                                return context.dataset.label + ': ' + value.toLocaleString() + ' Ks';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' Ks';
                            }
                        }
                    }
                }
            }
        });


        // const ctxBestSelling = document.getElementById('bestSellingChart').getContext('2d');

        // const data = {
        //     labels: {!! json_encode($bestSellingProducts->pluck('product_name')) !!},
        //     datasets: [{
        //         label: 'Units Sold',
        //         data: {!! json_encode($bestSellingProducts->pluck('total_sold')) !!},
        //         backgroundColor: 'rgba(54, 162, 235, 0.6)',
        //         borderColor: 'rgba(54, 162, 235, 1)',
        //         borderWidth: 1
        //     }]
        // };

        // const config = {
        //     type: 'bar',
        //     data: data,
        //     options: {
        //         indexAxis: 'y', // horizontal bar chart
        //         scales: {
        //             x: {
        //                 beginAtZero: true
        //             }
        //         },
        //         plugins: {
        //             legend: {
        //                 display: true
        //             },
        //             tooltip: {
        //                 callbacks: {
        //                     label: function(context) {
        //                         return context.parsed.x + ' units sold';
        //                     }
        //                 }
        //             }
        //         }
        //     },
        // };

        // new Chart(ctxBestSelling, config);

        // best selling early setup

        // const ctxBestSelling = document.getElementById('bestSellingChart').getContext('2d');

        // const labels = {!! json_encode($bestSellingProducts->pluck('product_name')) !!};
        // const quantities = {!! json_encode($bestSellingProducts->pluck('total_sold')) !!};

        // const colors = [


        //     '#a87d67',
        //     '#b79580',
        //     '#ccb6a5',
        //     '#e0d3c8',
        //     '#ebe3db',
        //     '#f9f6f3',


        // ];

        // // Use first N colors based on products count
        // const barColors = colors.slice(0, quantities.length);

        // const data = {
        //     labels: labels,
        //     datasets: [{
        //         label: 'Units Sold',
        //         data: quantities,
        //         backgroundColor: barColors,
        //         borderWidth: 1

        //     }]
        // };

        // const config = {
        //     type: 'bar',
        //     data: data,
        //     options: {
        //         indexAxis: 'y', // horizontal bar chart
        //         scales: {
        //             x: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // };

        // new Chart(ctxBestSelling, config);

        // production

        const ctxBestSelling = document.getElementById('bestSellingChart').getContext('2d');

        const labels = {!! json_encode($bestSellingProducts->pluck('product_name')) !!};
        const quantities = {!! json_encode($bestSellingProducts->pluck('total_sold')) !!};

        const colors = [
            '#a87d67', '#b79580', '#ccb6a5',
            '#e0d3c8', '#ebe3db', '#f9f6f3',
        ];

        const barColors = colors.slice(0, quantities.length);

        const data = {
            labels: labels,
            datasets: [{
                label: 'Units Sold',
                data: quantities,
                backgroundColor: barColors,
                borderWidth: 1,
                borderRadius: 6,
                barThickness: 50, // larger thickness for bigger bars
                maxBarThickness: 70, // max cap
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Best Selling Products',
                        align: 'start',
                        color: '#333',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#555',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    y: {
                        ticks: {
                            color: '#333',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: false
                        },
                        categoryPercentage: 1.0,
                        barPercentage: 1.0,
                    }
                }
            }
        };

        new Chart(ctxBestSelling, config);
    </script>
    @vite(['resources/js/timeFilter.js'])
@endpush
