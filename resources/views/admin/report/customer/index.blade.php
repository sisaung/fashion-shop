@extends('layout.dashboard')
@section('content')
    <div class="mt-5">

        <form method="GET" action="{{ route('report.customer.index') }}" style="margin-bottom: 20px;">
            <label for="filter">Select Time Filter:</label>
            <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Today</option>
                <option value="last_7_days" {{ $filter == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="last_month" {{ $filter == 'last_month' ? 'selected' : '' }}>Last Month</option>
                <option value="this_year" {{ $filter == 'this_year' ? 'selected' : '' }}>This Year</option>
                <option value="last_year" {{ $filter == 'last_year' ? 'selected' : '' }}>Last Year</option>
            </select>
        </form>

        <div>
            <div class="bg-white p-4 rounded shadow mb-8 ">
                <h2 class="text-lg font-semibold mb-4"> Top Customer </h2>
                {{-- <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Total Orders</th>
                            <th>Total Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topCustomers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->customer->customer_name ?? 'N/A' }}</td>
                                <td>{{ $customer->customer->customer_email ?? 'N/A' }}</td>
                                <td>{{ $customer->total_orders }}</td>
                                <td>${{ number_format($customer->total_spent, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}


                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 ">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50 sorting-wrapper">
                            <tr>
                                <th data-sortby="id" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    {{-- @include('components.admin.sortTable', ['sortTitle' => 'ID']) --}}
                                    ID

                                </th>
                                <th data-sortby="customer_name" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    {{-- @include('components.admin.sortTable', [
                                        'sortTitle' => 'Customer Name',
                                    ]) --}}

                                    Customer

                                </th>


                                <th data-sortby="customer_email" scope="col"
                                    class="px-4 py-3 text-end text-sm font-medium text-gray-500">
                                    {{-- @include('components.admin.sortTable', [
                                    'sortTitle' => 'Customer Email',
                                ]) --}}

                                    Total Orders

                                </th>


                                <th data-sortby="customer_email" scope="col"
                                    class="px-4 py-3 text-end text-sm font-medium text-gray-500">
                                    {{-- @include('components.admin.sortTable', [
                                'sortTitle' => 'Customer Email',
                            ]) --}}

                                    Total Spent
                                </th>


                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">


                            @foreach ($topCustomers as $index => $customer)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $index + 1 }}


                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div class="flex gap-x-3">
                                            <div>
                                                <img src="{{ $customer->customer->profile_image ? $customer->customer->profile_image : 'https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1≈' }}"
                                                    class="size-10 rounded-full"
                                                    alt="{{ $customer->customer->customer_name }}">
                                            </div>

                                            <div class="flex flex-col">
                                                <a href="{{ route('customer.show', ['customer' => $customer->customer_id]) }}"
                                                    class="underline underline-offset-4 hover:text-stone-700 duration-300">
                                                    {{ $customer->customer->customer_name ?? 'N/A' }}</a>
                                                <span class="text-stone-500 text-xs">
                                                    {{ $customer->customer->customer_email ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        {{ $customer->total_orders }}</td>
                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        ${{ number_format($customer->total_spent, 2, '', ',') }} MMK</td>

                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>

            </div>

            {{-- <div class="bg-white p-4 rounded shadow mb-8  pb-20">
                <h2 class="text-lg font-semibold mb-4">Repeat vs New Customers</h2>

                <canvas id="customerChart" height="100"></canvas>
            </div> --}}

            <div class="bg-white rounded shadow h-[500px] mb-10">
                <div class=" p-4  mb-8 max-w-2xl max-h-[380px]">
                    <h2 class="text-lg font-semibold mb-4"> Repeat vs New Customers </h2>
                    <canvas id="customerChart" height="80"></canvas>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <!-- Import compatible ChartDataLabels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <script>
        const ctx = document.getElementById('customerChart').getContext('2d');
        const newCustomers = {{ $newCustomers }};
        const repeatCustomers = {{ $repeatCustomers }};
        const totalCustomers = newCustomers + repeatCustomers;


        // Calculate percentages
        const newPercent = totalCustomers ? (newCustomers / totalCustomers) * 100 : 0;
        const repeatPercent = totalCustomers ? (repeatCustomers / totalCustomers) * 100 : 0;

        // const data = {
        //     labels: ['New Customers', 'Repeat Customers'],
        //     datasets: [{
        //         data: [{{ $newCustomers }}, {{ $repeatCustomers }}],
        //         backgroundColor: ['#36A2EB', '#FF6384']
        //     }]
        // };

        // const customerChart = new Chart(ctx, {
        //     type: 'pie',
        //     data: data,
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             datalabels: {
        //                 formatter: (value, context) => {
        //                     const dataArray = context.chart.data.datasets[0].data;
        //                     const total = dataArray.reduce((sum, val) => sum + val, 0);
        //                     const percentage = ((value / total) * 100).toFixed(1)
        //                     return percentage >= 5 ? percentage + '%' : '';
        //                 },
        //                 color: '#fff',
        //                 font: {
        //                     weight: 'bold',
        //                     size: 14
        //                 }
        //             },
        //             legend: {
        //                 position: 'top'
        //             }
        //         }
        //     },
        //     plugins: [ChartDataLabels]
        // });

        // Data for pie chart
        const data = {
            labels: ['New Customers', 'Repeat Customers'],
            datasets: [{
                data: [newCustomers, repeatCustomers],
                backgroundColor: ['#4caf50', '#2196f3'],
                hoverOffset: 30
            }]
        };

        // Plugin to show percentage labels only if above 5%
        const dataLabelPlugin = {
            id: 'dataLabelPlugin',
            afterDatasetsDraw(chart) {
                const ctx = chart.ctx;
                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach((element, index) => {
                        const value = dataset.data[index];
                        const percent = totalCustomers ? (value / totalCustomers) * 100 : 0;

                        if (percent > 5) {
                            const fontSize = 14;
                            const fontStyle = 'bold';
                            ctx.font = fontStyle + ' ' + fontSize + 'px Arial';
                            ctx.fillStyle = '#fff';
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';

                            const label = percent.toFixed(1) + '%';
                            const position = element.tooltipPosition();
                            ctx.fillText(label, position.x, position.y);
                        }
                    });
                });
            }
        };

        // Create pie chart
        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            },
            plugins: [dataLabelPlugin]
        });
    </script>
@endpush
