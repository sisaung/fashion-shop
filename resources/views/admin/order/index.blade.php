@extends('layout.dashboard')

@section('content')
    <div>


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Customer List',
        ])

        @include('admin.order.header')

        <div id="order-list-container">
            <section class="mt-10 px-5  drop-down-modal ">
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

                                <th scope="col" class="px-4 py-3 text-end text-sm font-medium text-gray-500">

                                    Item Count

                                </th>


                                <th scope="col" class="px-4 py-3 text-end text-sm font-medium text-gray-500">
                                    Total
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
                        <tbody class="divide-y divide-gray-200 bg-white body-container">


                            @foreach ($orders as $order)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div>
                                            <span>{{ $order->customer->customer_name }}</span>
                                            {{-- <span>({{ $order->customer->addresses->first()->address_detail }})</span> --}}
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        {{ $order->orderItems->count() }}
                                    </td>


                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        {{ $order->total_amount }}
                                    </td>

                                    <td class="whitespace-nowrap flex justify-end px-4 py-4 text-sm text-gray-900">
                                        @if ($order->coupon)
                                            <div class="flex flex-col items-end justify-center">
                                                <span class="text-lg"> {{ $order->coupon->coupon_discount }} % </span>
                                                <span class="text-xs  text-gray-500"> {{ $order->coupon->coupon_code }}</span>
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

                                        <button data-order-detail="{{ route('order.show', $order->id) }}"
                                            class="px-2 py-1 hover:bg-gray-100 inline-flex justify-center items-center"
                                            href="{{ route('order.show', $order->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-5 text-gray-600">
                                                <path fill-rule="evenodd"
                                                    d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </button>


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


            {{-- <div class="pagination-wrapper">
                @include('components.pagination', ['paginator' => $orders])

            </div> --}}
        </div>



    </div>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
    @vite(['resources/js/sorting.js'])
    @vite(['resources/js/search.js'])
    {{-- @vite(['resources/js/pagination.js']) --}}
    @vite(['resources/js/orderDetail.js'])
@endpush
