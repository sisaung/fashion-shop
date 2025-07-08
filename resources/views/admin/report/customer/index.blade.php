@extends('layout.dashboard')
@section('content')
    <div class="mt-5">
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
                                                    class="size-10 rounded-full" alt="{{ $customer->customer->customer_name }}">
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

            <div class="bg-white p-4 rounded shadow mb-8  pb-20">
                <h2 class="text-lg font-semibold mb-4">Repeat vs New Customers</h2>

                <canvas id="customerChart" height="100"></canvas>
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

        const data = {
            labels: ['New Customers', 'Repeat Customers'],
            datasets: [{
                data: [{{ $newCustomers }}, {{ $repeatCustomers }}],
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        };

        const customerChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        formatter: (value, context) => {
                            const dataArray = context.chart.data.datasets[0].data;
                            const total = dataArray.reduce((sum, val) => sum + val, 0);
                            const percentage = ((value / total) * 100).toFixed(1) + '%';
                            return percentage;
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    },
                    legend: {
                        position: 'top'
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endpush
