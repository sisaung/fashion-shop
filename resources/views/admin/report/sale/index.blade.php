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

        <select name="timefilter" id="time-filter">
            @foreach ($timefilter as $filter)
                <option value="{{ $filter['value'] }}" {{ $timefilter == $filter['value'] ? 'selected' : '' }}>
                    {{ $filter['label'] }}</option>
            @endforeach
        </select>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-green-100 rounded p-4">
            <div class="text-sm text-gray-600">Total Sale</div>


            <div class="text-2xl font-bold">{{ number_format(array_sum($monthlySalesData->toArray()), 2, '') }} MMK</div>

        </div>
        <div class="bg-blue-100 rounded p-4">
            <div class="text-sm text-gray-600">Total Orders</div>
            <div class="text-2xl font-bold">{{ array_sum($monthlyOrdersData->toArray()) }}</div>
        </div>
        <div class="bg-yellow-100 rounded p-4">
            <div class="text-sm text-gray-600">Avg Order Value</div>
            <div class="text-2xl font-bold">
                {{ number_format(array_sum($monthlySalesData->toArray()) / max(array_sum($monthlyOrdersData->toArray()), 1), 2, '') }}
                MMK </div>
        </div>
    </div>

    {{-- Monthly Sales Revenue Chart --}}
    <div class="bg-white shadow rounded p-4 mb-8">
        <h2 class="text-lg font-semibold mb-2">Monthly Sales</h2>
        <canvas id="monthlySalesChart"></canvas>
    </div>

    {{-- Best Selling Products --}}

    <div class="bg-white shadow rounded p-4 mb-8">
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
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthlySalesLabels),
                datasets: [{
                        label: 'This Year Sale',
                        data: @json($monthlySalesData),
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Last Year Sale',
                        data: @json($monthlyLastYearData),
                        borderColor: 'rgb(255, 99, 132)',
                        tension: 0.3,
                        fill: false
                    }
                ]
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

        const ctxBestSelling = document.getElementById('bestSellingChart').getContext('2d');

        const labels = {!! json_encode($bestSellingProducts->pluck('product_name')) !!};
        const quantities = {!! json_encode($bestSellingProducts->pluck('total_sold')) !!};

        // const colors = [
        //     '#f9f6f3',
        //     '#ebe3db',
        //     '#e0d3c8',
        //     '#ccb6a5',
        //     '#b79580',
        //     '#a87d67',
        //     '#9b6c5b',
        //     '#81584d',
        //     '#694943',
        //     '#563e38',
        //     '#2e1f1c',
        // ];

        const colors = [


            '#a87d67',
            '#b79580',
            '#ccb6a5',
            '#e0d3c8',
            '#ebe3db',
            '#f9f6f3',


        ];

        // Use first N colors based on products count
        const barColors = colors.slice(0, quantities.length);

        const data = {
            labels: labels,
            datasets: [{
                label: 'Units Sold',
                data: quantities,
                backgroundColor: barColors,
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y', // horizontal bar chart
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        };

        new Chart(ctxBestSelling, config);
    </script>
    @vite(['resources/js/timeFilter.js'])
@endpush
