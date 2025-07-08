@extends('layout.dashboard')
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
    <!-- Import Chart.js v4 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <!-- Import compatible ChartDataLabels plugin -->
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
@endpush
