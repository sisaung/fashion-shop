@extends('layout.dashboard')
@section('content')
    <div class="max-w-7xl mx-auto mt-8">

        <h1 class="text-2xl font-bold mb-6">Shop Reports Dashboard</h1>

        {{-- Line Chart: Monthly Sales Revenue --}}
        <div class="bg-white p-4 rounded shadow mb-8">
            <h2 class="text-lg font-semibold mb-4">Monthly Sales Revenue</h2>
            <canvas id="salesRevenueChart" height="100"></canvas>
        </div>

        {{-- Bar Chart: Best-Selling Products --}}
        <div class="bg-white p-4 rounded shadow mb-8 ">
            <h2 class="text-lg font-semibold mb-4">Best-Selling Products</h2>
            <canvas id="bestSellingChart" height="150"></canvas>
        </div>

        {{-- Pie Chart: Order Status --}}
        <div class="bg-white rounded shadow h-[450px] mb-10">
            <div class=" p-4  mb-8 max-w-2xl max-h-[380px]">
                <h2 class="text-lg font-semibold mb-4">Order Status Summary</h2>
                <canvas id="orderStatusChart" height="80"></canvas>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    @vite(['resources/js/chart/chart.umd.min.js'])

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> --}}

    <!-- Import Chart.js v4 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <!-- Import compatible ChartDataLabels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
    </script>


    <script>
        // Chart.register(ChartDataLabels)
        //  Line Chart: Monthly Sales Revenue
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


        // ✅ Bar Chart: Best-Selling Products with different colors
        // const bestSellingCtx = document.getElementById('bestSellingChart').getContext('2d');

        // const bestSellingLabels = {!! json_encode($bestSellingLabels) !!};
        // const bestSellingData = {!! json_encode($bestSellingData) !!};

        // // Generate different colors dynamically
        // const backgroundColors = [
        //     'rgba(255, 99, 132, 0.7)',
        //     'rgba(54, 162, 235, 0.7)',
        //     'rgba(255, 206, 86, 0.7)',
        //     'rgba(75, 192, 192, 0.7)',
        //     'rgba(153, 102, 255, 0.7)',
        //     'rgba(255, 159, 64, 0.7)',
        //     'rgba(199, 199, 199, 0.7)'
        // ];

        // const borderColors = [
        //     'rgba(255, 99, 132, 1)',
        //     'rgba(54, 162, 235, 1)',
        //     'rgba(255, 206, 86, 1)',
        //     'rgba(75, 192, 192, 1)',
        //     'rgba(153, 102, 255, 1)',
        //     'rgba(255, 159, 64, 1)',
        //     'rgba(199, 199, 199, 1)'
        // ];

        // new Chart(bestSellingCtx, {
        //     type: 'bar',
        //     data: {
        //         labels: bestSellingLabels,
        //         datasets: [{
        //             label: 'Units Sold',
        //             data: bestSellingData,
        //             backgroundColor: backgroundColors.slice(0, bestSellingLabels.length),
        //             borderColor: borderColors.slice(0, bestSellingLabels.length),
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             legend: {
        //                 position: 'top'
        //             }
        //         },
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });


        //  Horizontal Bar Chart: Best-Selling Products
        //  Register ChartDataLabels plugin
        // Chart.register(ChartDataLabels);

        //  Horizontal Bar Chart: Best-Selling Products
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


        // with label
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');

        const orderStatusLabels = {!! json_encode($orderStatusLabels) !!};
        const orderStatusData = {!! json_encode($orderStatusData) !!};

        new Chart(orderStatusCtx, {
            type: 'pie',
            data: {
                labels: orderStatusLabels,
                datasets: [{
                    label: 'Orders',
                    data: orderStatusData,
                    backgroundColor: [
                        'rgba(255, 205, 86, 0.7)', // pending
                        'rgba(54, 162, 235, 0.7)', // confirmed
                        'rgba(153, 102, 255, 0.7)', // delivered
                        'rgba(75, 192, 192, 0.7)', // completed
                        'rgba(255, 99, 132, 0.7)' // cancelled
                    ],
                    borderColor: [
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    },
                    datalabels: { // Configuration for the datalabels plugin
                        color: '#555',
                        formatter: (value, context) => {
                            const data = context.chart.data.datasets[0].data;
                            const total = data.reduce((sum, val) => sum + val, 0);
                            // Handle division by zero
                            if (total === 0) {
                                return '0%';
                            }
                            const percentage = ((value / total) * 100).toFixed(0);
                            return `${percentage}%`;
                        },
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },

            plugins: [ChartDataLabels]
        });
    </script>
@endpush
