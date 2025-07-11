@extends('layout.dashboard')



@section('content')
    <div class="mt-5 py-5">

        <form method="GET" action="{{ route('dashboard.index') }}" class="mb-4 ">
            <select name="filter" onchange="this.form.submit()" class="border p-2 rounded w-40">
                <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Today</option>
                <option value="yesterday" {{ $filter == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                <option value="last_7_days" {{ $filter == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="last_month" {{ $filter == 'last_month' ? 'selected' : '' }}>Last Month</option>
                <option value="this_year" {{ $filter == 'this_year' ? 'selected' : '' }}>This Year</option>
                <option value="last_year" {{ $filter == 'last_year' ? 'selected' : '' }}>Last Year</option>
            </select>
        </form>

        <div class="grid grid-cols-4 gap-5">

            <!-- Example Card -->
            {{-- @php
                $cards = [
                    [
                        'title' => 'Total Revenue',
                        'value' => number_format($totalRevenue) . ' MMK',
                        'change' => $revenueChange,
                    ],
                    [
                        'title' => 'Total Orders',
                        'value' => number_format($totalOrder),
                        'change' => $orderChange,
                    ],
                    [
                        'title' => 'Total Products',
                        'value' => number_format($totalProduct),
                        'change' => null,
                    ],
                    [
                        'title' => 'Total Customers',
                        'value' => number_format($totalCustomer),
                        'change' => $customerChange,
                    ],
                ];
            @endphp --}}

            @php
                $cards = [
                    [
                        'title' => 'Total Revenue',
                        'value' => number_format($totalRevenue) . ' MMK',
                        'change' => $revenueChange,
                        'sparkline_data' => $sparklineRevenue,
                    ],
                    [
                        'title' => 'Total Orders',
                        'value' => $totalOrder,
                        'change' => $orderChange,
                        'sparkline_data' => $sparklineOrders,
                    ],
                    [
                        'title' => 'Total Products',
                        'value' => number_format($totalProduct),
                        'change' => null,
                        'sparkline_data' => null,
                    ],
                    [
                        'title' => 'Total Customers',
                        'value' => $totalCustomer,
                        'change' => $customerChange,
                        'sparkline_data' => $sparklineCustomers,
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="bg-white shadow p-5 space-y-3 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <!-- Replace with relevant icon for each card if needed -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 stroke-blue-500 stroke-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>

                        @if (!is_null($card['change']))
                            <div>
                                <p class="flex items-center">
                                    @if ($card['change'] > 0)
                                        <div class="bg-green-100 inline-flex items-center gap-2 py-1 px-2 rounded-full ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4 text-green-700">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                                            </svg>

                                            <span class="text-green-700 text-xs font-semibold">
                                                {{ number_format($card['change'], 1) }}%</span>

                                        </div>
                                    @elseif ($card['change'] == 0)
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15" />
                                        </svg> --}}
                                        <div
                                            class="bg-gray-200 px-3 py-1 inline-flex justify-center items-center rounded-full">
                                            <span class="text-gray-700 text-xs"> 0 % </span>
                                        </div>
                                    @else
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25 12 15.75 4.5 8.25" />
                                        </svg>
                                        <span class="text-red-500 text-sm"> {{ number_format($card['change'], 1) }}%</span> --}}

                                        <div class="bg-red-100 inline-flex items-center gap-2 py-1 px-2 rounded-full ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4 text-red-700">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                                            </svg>


                                            <span class="text-red-700 text-xs font-semibold">
                                                {{ number_format($card['change'], 1) }}%</span>
                                        </div>
                                    @endif
                                </p>
                            </div>
                        @else
                            <p class="text-xs text-gray-500">No data for selected period</p>
                        @endif
                    </div>

                    <div>
                        <p class="text-2xl font-semibold">{{ $card['value'] }}</p>
                        <p class="text-stone-600 text-sm">{{ $card['title'] }}</p>
                    </div>

                    {{--  Sparkline container --}}
                    {{-- <div id="sparkline-{{ $index }}"></div> --}}
                </div>
            @endforeach

        </div>

        {{-- monthly orders --}}

        {{-- @foreach ($monthlyOrders as $order)
            {{ $order }}
        @endforeach --}}

        {{-- <div class="grid grid-cols-2 gap-5">
            <div class="col-span-1 space-y-3">

                @foreach ($monthlyOrders as $monthlyOrder)
                    @foreach ($monthlyOrder as $order)
                        <div class="flex items-center">
                            <p> {{ $order }} </p>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div> --}}


        {{-- latest order --}}

        <div id="order-list-container">
            <section class="mt-10   drop-down-modal ">
                <h1 class="text-xl font-heading mb-3 text-gray-700 font-semibold"> Latest Orders </h1>
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 ">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50 sorting-wrapper">
                            <tr>
                                <th data-sortby="id" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    @include('components.admin.sortTable', ['sortTitle' => 'ID'])

                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    Order By

                                </th>

                                <th data-sortby="total_amount" scope="col"
                                    class="px-4 py-3 flex justify-end text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', ['sortTitle' => 'Total'])

                                </th>

                                <th scope="col" class="px-4 py-3 text-end text-sm font-medium text-gray-500">

                                    Item Count

                                </th>



                                <th scope="col" class="px-4 py-3 text-end text-sm font-medium text-gray-500">
                                    Coupon Discount
                                </th>


                                <th scope="col" class="px-4 py-3  text-sm font-medium text-gray-500">

                                    Order Status

                                </th>

                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Created
                                    </div>
                                </th>

                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-center cursor-pointer">
                                        Action
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">


                            @foreach ($orders as $order)
                                <tr>
                                    <td class="whitespace-nowrap  px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div class="flex gap-x-3">
                                            <div>
                                                <img src="{{ $order->customer->profile_image ? $order->customer->profile_image : 'https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1≈' }}"
                                                    class="size-10 rounded-full"
                                                    alt="{{ $order->customer->customer_name }}">
                                            </div>
                                            <div class="flex flex-col">
                                                <a href="{{ route('customer.show', ['customer' => $order->customer->id]) }}"
                                                    class="text-base underline underline-offset-2 ">{{ $order->customer->customer_name }}</a>
                                                <span class="text-xs text-stone-500">
                                                    {{ $order->customerAddress->address_detail }} </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        {{ $order->total_amount }}
                                    </td>


                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        {{ $order->orderItems->count() }}
                                    </td>

                                    <td class="whitespace-nowrap flex justify-end px-4 py-4 text-sm text-gray-900">
                                        @if ($order->coupon)
                                            <div class="flex flex-col items-end justify-center">
                                                <span class="text-lg"> {{ $order->coupon->coupon_discount }} % </span>
                                                <span class="text-xs  text-gray-500">
                                                    {{ $order->coupon->coupon_code }}</span>
                                            </div>
                                        @else
                                            <div class="flex flex-col items-end justify-center ">
                                                <span class="text-lg"> 0 % </span>
                                                <span class="text-xs  text-gray-500"> No coupon code </span>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        @include('components.admin.orderStatusBadge', [
                                            'orderStatus' => $order->order_status,
                                            'style' => 'justify-center',
                                        ])
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                        <div class="">
                                            <p> {{ date('j M Y', strtotime($order->created_at)) }} </p>
                                            <p> {{ date('g:i A', strtotime($order->created_at)) }} </p>
                                        </div>
                                    </td>


                                    <td
                                        class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex items-center justify-center">

                                        <a href ="{{ route('order.show', $order->id) }}"
                                            class="px-2 py-1 hover:bg-gray-100 inline-flex justify-center items-center"
                                            href="{{ route('order.show', $order->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5 text-gray-600">
                                                <path fill-rule="evenodd"
                                                    d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </a>


                                    </td>
                                </tr>
                            @endforeach

                            @empty($orders)
                                <tr>
                                    <td colspan="5" class="text-center text-gray-700"> There are no orders.
                                        <a href="{{ route('order.index') }}"> Add Customer </a>
                                    </td>
                                </tr>
                            @endempty

                        </tbody>
                    </table>
                </div>
            </section>
        </div>



        <div class="grid grid-cols-2 gap-5 mt-8">

            {{-- low stock alert --}}
            <div class="bg-white rounded-lg shadow">
                <div class="border-b border-stone-100  p-5 mb-3">
                    <p class="text-gray-800 text-lg font-semibold font-heading flex items-center gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 stroke-2 text-yellow-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>

                        Low Stock Alert
                    </p>
                </div>

                <div class="p-5 ">
                    @foreach ($lowStockProducts as $product)
                        <div class="border-l-3 border-red-500 px-5 mb-5">
                            <a href="{{ route('manage-stock.create', ['id' => $product->id]) }}"
                                class="text-sm font-medium text-gray-800 underline underline-offset-4">
                                {{ $product->product_name }} </a>
                            <div class="flex gap-x-5">
                                @foreach ($product->stocks as $stock)
                                    <div>
                                        <span class="text-xs text-gray-500"> {{ $stock->size->size_name }} </span> :
                                        <span
                                            class="text-xs {{ $stock->stock_quantity <= 3 ? 'text-red-500' : 'text-gray-500' }} font-semibold">(
                                            {{ $stock->stock_quantity }} )</span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- top categories --}}
            <div class="bg-white rounded-lg shadow">
                <div class="border-b border-stone-100  p-5 mb-3">
                    <p class="text-gray-800 text-lg font-semibold font-heading flex items-center gap-3">



                        Top Categories
                    </p>
                </div>
                <div class="p-5">

                </div>

            </div>


            {{-- recent customers --}}
            {{-- top categories --}}
        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

        <!-- Import compatible ChartDataLabels plugin -->
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
        </script>

        {{-- apexchart --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


        <script>
            const ctx = document.getElementById('topCategoriesChart').getContext('2d');





            const topCategoriesChart = new Chart(ctx, {
                type: 'bar', // ✅ vertical bar chart by default
                data: {
                    labels: @json($categoryNames),
                    datasets: [{
                        label: 'Total Sales',
                        data: @json($categorySales),
                        backgroundColor: '#ccb6a5'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: { // ✅ vertical axis for values
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
     {{-- @foreach ($cards as $index => $card)


         var options{{ $index }} = {
             series: [{
                 data: @json($card['sparkline_data'] ? $card['sparkline_data'] : [10, 15, 12, 18, 20, 19, 25])  use your data key here
             }],
             chart: {
                 type: 'line',
                 height: 60,
                 sparkline: {
                     enabled: true
                 }
             },
             stroke: {
                 curve: 'smooth',
                 width: 2
             },
             colors: [
                 "{{ $card['change'] > 0 ? '#22c55e' : ($card['change'] < 0 ? '#ef4444' : '#9ca3af') }}"
             ],  green, red, gray
         };

         console.log(options)

         var chart{{ $index }} = new ApexCharts(document.querySelector("#sparkline-{{ $index }}"),
             options{{ $index }});
         chart{{ $index }}.render();
     @endforeach --}}
