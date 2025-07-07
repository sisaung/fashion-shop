@extends('layout.dashboard')

@section('content')
    <div class="mt-5 py-5">


        <div class="grid grid-cols-4 gap-5 ">
            <div class="bg-white shadow p-5 space-y-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-blue-500 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                    </div>


                    @if (!is_null($revenueChange))

                        <div>
                            <p class="flex items-center">
                                @if ($revenueChange >= 0)
                                    @if ($revenueChange > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                                        </svg>
                                    @endif
                                    <span class="text-green-500 text-sm"> +{{ number_format($revenueChange, 1) }}%</span>
                                @else
                                    <span class="text-sm text-green-500"> 0 % </span>
                                @endif
                            </p>
                        </div>
                    @else
                        <p class="text-xs text-gray-500">No data last month</p>
                    @endif
                </div>

                <div>
                    <p class="text-2xl font-semibold"> {{ number_format($totalRevenue) }} MMK </p>
                    <p class="text-stone-600 text-sm"> Total Revenue </p>
                </div>
            </div>

            <div class=" bg-white  shadow p-5 space-y-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-blue-500 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>



                    </div>

                    @if (!is_null($orderChange))
                        <div>
                            <p class="flex items-center">
                                @if ($orderChange >= 0)
                                    @if ($orderChange > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                                        </svg>
                                    @endif
                                    <span class="text-green-500 text-sm"> +{{ number_format($orderChange, 1) }}%</span>
                                @else
                                    0 %
                                @endif
                            </p>
                        </div>
                    @else
                        <p class="text-xs text-gray-500">No data last month</p>

                    @endif
                </div>

                <div>
                    <p class="text-2xl font-semibold"> {{ number_format($totalOrder) }} </p>

                    <p class="text-stone-600 text-sm"> Total Orders </p>
                </div>
            </div>

            <div class=" bg-white  shadow p-5 space-y-3 rounded-lg">
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

            <div class=" bg-white  shadow p-5 space-y-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-blue-500 stroke-2 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>


                    </div>
                    @if (!is_null($customerChange))
                        <div>
                            <p class="flex items-center">
                                @if ($customerChange >= 0)
                                    @if ($customerChange > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                                        </svg>
                                    @endif
                                    <span class="text-green-500 text-sm"> +{{ number_format($customerChange, 1) }}%</span>
                                @else
                                    <span class="text-sm text-green-500"> 0 % </span>
                                @endif
                            </p>
                        </div>
                    @else
                        <p class="text-xs text-gray-500">No data last month</p>

                    @endif
                </div>

                <div>
                    <p class="text-2xl font-semibold"> {{ number_format($totalCustomer) }} </p>
                    <p class="text-stone-600 text-sm"> Total Customers </p>
                </div>
            </div>


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
                <h1 class="text-xl font-heading mb-3 text-gray-700"> Latest Orders </h1>
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
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div class="flex flex-col">
                                            <a href="{{ route('customer.show', ['customer' => $order->customer->id]) }}"
                                                class="text-base underline underline-offset-2 ">{{ $order->customer->customer_name }}</a>
                                            <span class="text-xs text-stone-500">
                                                {{ $order->customerAddress->address_detail }} </span>
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

        <div class="grid grid-cols-2 gap-5">

        {{-- low stock alert --}}
        <div>
            
        </div>



        {{-- recent customers --}}
        {{-- top categories --}}
        </div>


    @endsection

    @push('scripts')
    @endpush
