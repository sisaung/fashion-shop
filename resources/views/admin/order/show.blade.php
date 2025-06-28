@php

    $orderCancellationReasons = [
        [
            'id' => 1,
            'tag' => 'customer_cancelled',
            'description' => 'The customer cancelled the order',
        ],
        [
            'id' => 2,
            'tag' => 'payment_failed',
            'description' => 'Payment was not successful',
        ],
        [
            'id' => 3,
            'tag' => 'out_of_stock',
            'description' => 'Product was out of stock',
        ],
        [
            'id' => 4,
            'tag' => 'delayed_shipping',
            'description' => 'Shipping was taking too long',
        ],
        [
            'id' => 5,
            'tag' => 'duplicate_order',
            'description' => 'Duplicate order placed',
        ],
        [
            'id' => 6,
            'tag' => 'wrong_item_ordered',
            'description' => 'Customer ordered the wrong item',
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
                            <th class="px-4 py-3 text-end text-sm font-medium text-gray-500">Quantity</th>

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
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-end font-medium text-gray-900">
                                    {{ $item->quantity }}
                                </td>


                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ number_format($item->sale_price) }} MMK
                                </td>


                            </tr>
                        @endforeach

                    </tbody>

                    <tfoot class="divide-y divide-gray-200 bg-stone-50 font-mono">
                        <tr>

                            <td colspan="3" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900"><strong>Total
                                </strong>
                            </td>
                            <td> {{ number_format($order->total_amount) }} MMK </td>

                        </tr>
                        <tr>
                            <td colspan="3" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900"><strong>Tax
                                    amount</strong>
                            </td>
                            <td> {{ number_format($order->tax_amount ?? 0) }} MMK </td>

                        </tr>

                        <tr>
                            <td colspan="3" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900">
                                <strong>Coupon Dis</strong>
                                (%)
                            </td>
                            <td> {{ number_format($order->coupon->coupon_discount ?? 0) }} %</td>

                        </tr>

                        <tr>
                            <td colspan="3" class=" whitespace-nowrap px-4 py-4  font-medium text-gray-900">
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
            <h1 class="mb-2"> Order Summary </h1>
            <div class="w-full overflow-x-auto mb-5 rounded-lg border border-gray-200">

                <table class=" w-full divide-y divide-gray-200 ">
                    <tr class="divide-y divide-gray-200">
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700"><strong>Order Number</strong>
                        </td>
                        <td class="text-gray-500">{{ $order->order_number }}</td>
                    </tr>
                    <tr class="divide-y divide-gray-200 bg-stone-50">
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700">Order At</td>
                        <td class="text-gray-500"> {{ date('j M Y', strtotime($order->created_at)) }}
                            {{ date('g:i A', strtotime($order->created_at)) }} </td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700">Order Status</td>
                        <td>

                            @include('components.admin.orderStatusBadge', [
                                'orderStatus' => $order->order_status,
                            ])
                        </td>
                    </tr>
                    <tr class="divide-y divide-gray-200 bg-stone-50">
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700">Item Count</td>
                        <td class="text-gray-500">{{ $order->orderItems->count() }}</td>
                    </tr>
                </table>


            </div>
            <h1 class="mb-2"> Deliver Information </h1>
            <div class="w-full overflow-x-auto rounded-lg border border-gray-200">

                <table class=" w-full divide-y divide-gray-200 mt-5">
                    <tr class="divide-y divide-gray-200">
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700">Name</td>
                        <td class="text-gray-500 underline underline-offset-4"> <a
                                href="{{ route('customer.show', ['customer' => $order->customer->id]) }}">{{ $order->customer->customer_name }}</a>
                        </td>
                    </tr>
                    <tr class="divide-y divide-gray-200 bg-stone-50">
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700">Email</td>
                        <td class="text-gray-500 ">{{ $order->customer->customer_email }}</td>
                    </tr>
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700">Phone</td>
                        <td class="text-gray-500">

                            {{ $order->customerAddress->phone_number }}
                        </td>
                    </tr>
                    <tr class="divide-y divide-gray-200 bg-stone-50">
                        <td class="whitespace-nowrap px-4 py-2  font-medium text-gray-700">Item Count</td>
                        <td>{{ $order->orderItems->count() }}</td>
                    </tr>
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

                <div class="cancel-order-form grid grid-cols-1">
                    <div class="col-span-1">
                        <form action="{{ route('order.cancel', ['id' => $order->id]) }}" method="POST">
                            @csrf

                            <textarea name="reason"
                                class="reason-input border border-pearl-bush-400 rounded focus:ring-1 focus:ring-pearl-bush-500"
                                name="cancel_reason" id="cancel_reason" cols="30" rows="4"></textarea>

                            @error('reason')
                                <p class="text-xs text-red-500"> {{ $message }} </p>
                            @enderror

                            <div class="flex  flex-wrap gap-3">
                                @foreach ($orderCancellationReasons as $reason)
                                    <p data-reason="{{ $reason['description'] }}"
                                        class="cancel-reason-tag cursor-pointer text-xs border text-pearl-bush-500 border-pearl-bush-400  px-2 py-1 rounded-full">
                                        {{ $reason['tag'] }} </p>
                                @endforeach
                            </div>

                            <div class="mt-3">
                                <input type="checkbox"
                                    class="toggle-cancellation-order-form text-sm  focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                                    name="sure_cancel_order" id="sure_cancel_order">
                                <label for="sure_cancel_order" class=" leading-7 select-none text-sm text-gray-600">

                                    Check this box if you want to cancel the order

                                </label>
                                @error('sure_cancel_order')
                                    <p class="text-xs text-red-500"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit"
                                    class="text-white bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm  cursor-pointer duration-300">
                                    Cancel
                                </button>
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
