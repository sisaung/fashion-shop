@php

    $cancelReasons = [
        [
            'id' => 1,
            'description' => 'Customer requested cancellation',
        ],
        [
            'id' => 2,
            'description' => 'Item is out of stock',
        ],
        [
            'id' => 3,
            'description' => 'Payment was not completed',
        ],
        [
            'id' => 4,
            'description' => 'Incorrect shipping address',
        ],
        [
            'id' => 5,
            'description' => 'Pricing error on product',
        ],
        [
            'id' => 6,
            'description' => 'Delivery would be delayed',
        ],
        [
            'id' => 7,
            'description' => 'Other reason',
        ],
    ];

@endphp

@extends('layout.dashboard')



@section('content')
    <div class="flex justify-between items-center ">
        <div>
            @include('components.admin.breadcrumb', [
                'currentPageTitle' => 'Order Detail',
                'links' => [['name' => 'Order List', 'path' => route('order.index')]],
            ])
        </div>


    </div>

    <h1 class="mt-10 text-xl px-5 mb-5"> Order Detail </h1>
    <section class="grid grid-cols-7 gap-x-5 mb-10 px-5 ">

        <div class="col-span-3">
            <h1 class="mb-2"> Order Items </h1>
            <div class="w-full overflow-x-auto rounded-lg border border-gray-200">

                <table class=" w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Product Name</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Size</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Price</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 ">
                        @foreach ($order->orderItems as $item)
                            <tr>

                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $item->stock->product->product_name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $item->stock->size->size_name }}
                                </td>


                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ number_format($item->sale_price) }} MMK
                                </td>


                            </tr>
                        @endforeach

                    </tbody>

                    <tfoot class="divide-y divide-gray-200 bg-stone-50 font-mono">
                        <tr>

                            <td colspan="2" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900"><strong>Total
                                </strong>
                            </td>
                            <td> {{ number_format($order->total_amount) }} MMK </td>

                            {{-- <td rowspan="4" class="">


                            </td> --}}


                        </tr>
                        <tr>
                            <td colspan="2" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900"><strong>Tax
                                    amount</strong>
                            </td>
                            <td> {{ number_format($order->tax_amount ?? 0) }} MMK </td>

                        </tr>

                        <tr>
                            <td colspan="2" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900">
                                <strong>Coupon Dis</strong>
                                (%)
                            </td>
                            <td> {{ number_format($order->coupon->coupon_discount ?? 0) }} %</td>

                        </tr>

                        <tr>
                            <td colspan="2" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900">
                                <strong>Net Total</strong>
                                (%)
                            </td>
                            <td> {{ number_format($order->net_total) }}</td>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-span-2 mt-8">
            @if ($order->is_cancel === '1')
                <span class="text-sm text-red-500">This order is cancelled because {{ $order->cancel_message }}</span>
            @elseif ($order->order_status === 'pending')
                <form action="{{ route('order.confirm', ['id' => $order->id]) }}" method="POST">
                    @csrf
                    <div class="space-y-5">

                        <div>
                            <label for="start_date" class="leading-7  text-sm block text-gray-600">Delivery Start Date
                            </label>

                            <input type="date"
                                class="text-sm w-full border border-gray-300 rounded focus:ring-2 focus:ring-pearl-bush-500 font-medium text-gray-500 "
                                name="start_date" id="start_date">
                            @error('start_date')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="leading-7  text-sm block text-gray-600">Delivery End Date
                            </label>

                            <input type="date"
                                class="text-sm w-full border border-gray-300 rounded focus:ring-2 focus:ring-pearl-bush-500 font-medium text-gray-500 "
                                name="end_date" id="end_date">
                            @error('end_date')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit"
                                class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-full cursor-pointer duration-300">Confirm
                                Order</button>
                        </div>
                    </div>
                </form>
            @elseif ($order->order_status === 'confirmed')
                <form action="{{ route('order.deliver', ['id' => $order->id]) }}" method="POST">
                    @csrf
                    <div class="space-y-2">
                        <div class="flex gap-x-2  items-center">
                            <input type="checkbox"
                                class="text-sm  focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                                name="deliver_order" id="deliver_order">
                            <label for="deliver_order" class=" leading-7 select-none text-sm text-gray-600">Package is
                                picked
                                it
                                up
                                by delivery.

                            </label>
                        </div>
                        @error('deliver_order')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-full cursor-pointer duration-300">Deliver
                            Order</button>
                    </div>
                </form>
            @elseif ($order->order_status === 'delivered')
                <form action="{{ route('order.complete', ['id' => $order->id]) }}" method="POST">
                    @csrf
                    <div class="space-y-2">
                        <div class="flex gap-x-2  items-center">
                            <input type="checkbox"
                                class="text-sm  focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                                name="complete_order" id="complete_order">
                            <label for="complete_order" class=" leading-7 select-none text-sm text-gray-600">Package is
                                delivered and payment is collected

                            </label>
                        </div>
                        @error('complete_order')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-full cursor-pointer duration-300">Complete
                            Order</button>
                    </div>
                </form>
            @elseif ($order->order_status === 'completed')
                <button type="submit"
                    class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm w-full cursor-pointer duration-300">Order
                    Completed
                </button>
            @endif
        </div>
        <div class="col-span-2">
            <h1 class="mb-2"> Order Items </h1>
            <div class="w-full overflow-x-auto rounded-lg border border-gray-200">

                <table class=" w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Product Name</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Size</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Price</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 ">
                        @foreach ($order->orderItems as $item)
                            <tr>

                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $item->stock->product->product_name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $item->stock->size->size_name }}
                                </td>


                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ number_format($item->sale_price) }} MMK
                                </td>


                            </tr>
                        @endforeach

                    </tbody>

                    <tfoot class="divide-y divide-gray-200 bg-stone-50 font-mono">
                        <tr>

                            <td colspan="2" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900"><strong>Total
                                </strong>
                            </td>
                            <td> {{ number_format($order->total_amount) }} MMK </td>

                        </tr>
                        <tr>
                            <td colspan="2" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900"><strong>Tax
                                    amount</strong>
                            </td>
                            <td> {{ number_format($order->tax_amount ?? 0) }} MMK </td>

                        </tr>

                        <tr>
                            <td colspan="2" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900">
                                <strong>Coupon Dis</strong>
                                (%)
                            </td>
                            <td> {{ number_format($order->coupon->coupon_discount ?? 0) }} %</td>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>
    <div class="px-5">
        @if ($order->is_cancel === '0')
            <div class="flex flex-col  justify-end  w-full ">
                <div class="flex gap-x-2  items-center">
                    <input type="checkbox"
                        class="toggle-cancellation-order-form text-sm  focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                        name="cancel_order" id="cancel_order">
                    <label for="cancel_order" class=" leading-7 select-none text-sm text-gray-600">

                        Cancellation Order Form

                    </label>
                </div>

                <div class="cancel-order-form grid-cols-1">
                    <div class="col-span-1">
                        <form action="">
                            <textarea class="border border-pearl-bush-400 rounded focus:ring-1 focus:ring-pearl-bush-500" name="cancel_reason"
                                id="cancel_reason" cols="30" rows="4"></textarea>

                            <div class="flex flex-wrap gap-3">
                                @foreach ($cancelReasons as $cancelReason)
                                    <p data-reason={{$cancelReason['description']}}
                                        class="cancle-reason-tag cursor-pointer text-xs border text-pearl-bush-500 border-pearl-bush-400  px-2 py-1 rounded-full">
                                        {{ $cancelReason['description'] }} </p>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    @vite(['resources/js/cancelOrder.js'])
@endpush
