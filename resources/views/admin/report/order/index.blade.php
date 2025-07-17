@extends('layout.dashboard')
@section('content')
    <div class="mt-5">
        <div>
            <div class="bg-white p-4 rounded shadow mb-8 ">
                <h2 class="text-lg font-semibold mb-4"> Monthly Order Count</h2>
                <form method="GET" action="{{ route('report.order.index') }}">
                    <select name="time_filter" onchange="this.form.submit()">
                        @foreach (['today', 'yesterday', 'last_7_days', 'this_month', 'last_month', 'this_year', 'last_year'] as $filter)
                            <option value="{{ $filter }}" {{ $timeFilter == $filter ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $filter)) }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <canvas id="orderRevenueChart" width="800" height="400"></canvas>
                {{-- <canvas id="monthlyOrderChart"></canvas> --}}

            </div>

            <div class="bg-white rounded shadow h-[450px] mb-10">
                <div class=" p-4  mb-8 max-w-2xl max-h-[380px]">
                    <h2 class="text-lg font-semibold mb-4">Order Status Summary</h2>
                    <canvas id="orderStatusChart" height="80"></canvas>
                </div>
            </div>
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
        // const ctx = document.getElementById('monthlyOrderChart').getContext('2d');
        const ctx = document.getElementById('orderRevenueChart').getContext('2d');
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');

        const orderCounts = @json($orderCounts);
        const sales = @json($sales);
        const labels = @json($labels);

        // order and sale count chart
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Orders',
                    data: orderCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    yAxisID: 'orders'
                },
                {
                    label: 'Sale (MMK)',
                    data: sales,
                    type: 'line',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false,
                    yAxisID: 'sale'
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                stacked: false,
                scales: {
                    orders: {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Orders'
                        }
                    },
                    sale: {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Sale (MMK)'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        };


        //order status chart

        const dataValues = {!! json_encode($orderedStatus->values()) !!};
        const dataLabels = {!! json_encode($orderedStatus->keys()) !!};
        const total = dataValues.reduce((a, b) => a + b, 0);


        const orderStatusData = {
            labels: {!! json_encode($orderedStatus->keys()) !!}, // ['pending', 'confirmed', ...]
            datasets: [{
                label: 'Order Status Summary',
                data: dataValues, // [10, 5, ...]
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
        };

        const orderStatusConfig = {
            type: 'pie',
            data: orderStatusData,
            options: {
                plugins: {
                    datalabels: {
                        color: '#fff',
                        formatter: function(value, context) {
                            const percentage = (value / total * 100).toFixed(1);
                            // Show label only if percentage >= 5%
                            return percentage >= 5 ? percentage + '%' : '';
                        }
                    },
                    legend: {
                        position: 'top',
                    }
                }
            },
            plugins: [ChartDataLabels]
        };





        new Chart(ctx, config);
        new Chart(orderStatusCtx, orderStatusConfig);
    </script>
@endpush
{{-- const monthlyOrderChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Monthly Order Count',
            data: @json($orders),
            borderColor: 'blue',
            backgroundColor: 'lightblue',
            fill: false,
            tension: 0.2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                stepSize: 10
            }
        }
    }
});

order status summary
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
}); --}}
