@extends('layout.dashboard')
@section('content')
    <div class="mt-5">
        <div>
            <div class="bg-white p-4 rounded shadow mb-8 ">
                <h2 class="text-lg font-semibold mb-4"> Order Counts</h2>
                <form method="GET" action="{{ route('report.order.index') }}" class="text-end mb-3">
                    <div class="relative inline-block w-42">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-500 absolute left-3  transform translate-y-1/2 pointer-events-none">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6v-1.5m7.5 1.5V4.5M3.75 9h16.5M4.5 7.5h15a.75.75 0 0 1 .75.75v12a.75.75 0 0 1-.75.75h-15a.75.75 0 0 1-.75-.75v-12a.75.75 0 0 1 .75-.75z" />
                        </svg>
                        <select name="time_filter" onchange="this.form.submit()"
                            class="appearance-none border rounded-md p-2 pl-10 cursor-pointer border-gray-200 text-gray-600  w-full">
                            @foreach (['today', 'yesterday', 'last_7_days', 'this_month', 'last_month', 'this_year', 'last_year'] as $filter)
                                <option value="{{ $filter }}" {{ $timeFilter == $filter ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $filter)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
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
        const ctx = document.getElementById('orderRevenueChart').getContext('2d');

        const orderCounts = @json($orderCounts);
        const sales = @json($sales);
        const labels = @json($labels);

        const data = {
            labels: labels,
            datasets: [{
                    label: 'Orders',
                    data: orderCounts,
                    backgroundColor: 'rgba(204, 182, 165, 0.6)', // Tailwind blue-500 with opacity
                    borderRadius: 4, // rounded bar corners
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#1f2937', // gray-800
                        font: {
                            weight: 'bold'
                        },
                        formatter: Math.round
                    },
                    yAxisID: 'orders'
                },
                {
                    label: 'Sale (MMK)',
                    data: sales,
                    type: 'line',
                    borderColor: 'rgba(239, 68, 68, 1)', // Tailwind red-500
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.3, // smooth curve
                    fill: false,
                    pointBackgroundColor: 'rgba(239, 68, 68, 1)',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    borderWidth: 2,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: '#ef4444',
                        font: {
                            weight: 'bold'
                        },
                        formatter: function(value) {
                            return value.toLocaleString(); // formatted MMK value
                        }
                    },
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
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                if (context.dataset.label === 'Sale (MMK)') {
                                    return 'Sale: ' + context.parsed.y.toLocaleString() + ' MMK';
                                }
                                return context.dataset.label + ': ' + context.parsed.y;
                            }
                        }
                    },
                    datalabels: {
                        display: true
                    }
                },
                scales: {
                    orders: {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        suggestedMax: 5,
                        title: {
                            display: true,
                            text: 'Orders'
                        },
                        grid: {
                            color: 'rgba(209, 213, 219, 0.3)' // Tailwind gray-300
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
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        };


        //order status chart

        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');

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
