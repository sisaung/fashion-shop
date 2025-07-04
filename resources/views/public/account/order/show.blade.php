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
@extends('components.public.accountLayout')
@section('container')
    <div class="min-h-screen bg-white overflow-y-scroll hide-scrollbar mt-5">
        <div>

            <div class="grid lg:grid-cols-3 gap-8 px-5">
                {{-- Left Column --}}
                <div class="lg:col-span-2  space-y-8 h-screen overflow-y-auto hide-scrollbar pb-10">


                    {{-- Ordered Products List --}}
                    <h2 class="font-heading text-gray-700 mb-3">Ordered Products List</h2>
                    @foreach ($order->orderItems as $item)
                        <div class="bg-white border border-pearl-bush-100 rounded-lg  p-6 ordered-products-list-container">
                            <div class="flex gap-4 pb-6">
                                <div
                                    class="w-50 relative h-50 inline-flex justify-center items-center rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ $item->stock->product->productImages->first()->preview }}"
                                        class="ordered-product-image" alt="BOSS Polo Penrose 38"
                                        class="w-full h-full object-cover" />
                                        <div class="absolute top-0 left-0 w-full h-full bg-black/4"></div>
                                </div>

                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800 text-lg mb-2 ordered-product-name ">
                                        {{ $item->stock->product->product_name }} </h3>
                                    <p class="text-amber-600 text-sm mb-2 ordered-product-code">
                                        {{ $item->stock->product->product_code }}
                                    </p>
                                    <p class="text-sm text-gray-400 ordered-product-sale-price line-through">
                                        @if ($item->stock->product->discount_percentage)
                                            {{ number_format($item->stock->product->sale_price) }}
                                        @endif
                                    </p>

                                    <p class=" text-gray-700 mb-3 ordered-product-display-price">
                                        {{ number_format($item->stock->product->display_price) }} MMK
                                    </p>

                                    <div class="flex items-center gap-4 mb-4">
                                        <span
                                            class="bg-amber-50 text-amber-700 px-3 py-1 rounded-full text-sm font-medium ordered-product-size ">
                                            Size: {{ $item->stock->size->size_name }} </span>
                                        <span class="text-bearl-bush-500 text-sm font-medium ordered-quantity-value">
                                            Qty: {{ $item->quantity }} </span>
                                    </div>

                                    <div class="flex gap-3">

                                        <a href="{{ route('shop.show', ['slug' => $item->stock->product->slug]) }}"
                                            class="redirect-to-detail bg-pearl-bush-400 hover:bg-pearl-bush-600 text-white px-4 py-2 rounded-full cursor-pointer  font-medium transition-colors text-xs">
                                            See More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                    {{-- Delivery Info --}}
                    <div class="bg-white rounded-lg ">
                        <h2 class="  text-gray-600 font-heading mb-3">Delivery Information</h2>
                        <div class="space-y-4">

                            <div class="delivery-address-container space-y-4">

                                <div class="border border-pearl-bush-300 rounded-lg px-6 py-4 select-address">
                                    <div class="mb-3">
                                        <h3 class="font-heading font-semibold"> Customer Contact </h3>
                                        <div class="flex items-center gap-x-5 ">
                                            <div class="flex items-center gap-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="size-5 text-pearl-bush-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>


                                                <p class="text-sm">
                                                    {{ $order->customer->customer_name }} </p>
                                            </div>
                                            <div class="flex items-center gap-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="size-5 text-pearl-bush-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                                </svg>

                                                <p class="text-sm"> {{ $order->customer->customer_email }}</p>
                                            </div>
                                            <div class="flex items-center gap-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="size-5 text-pearl-bush-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                                </svg>

                                                <p class="text-sm"> {{ $order->customerAddress->phone_number }} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h1 class="font-heading font-semibold"> Shipping Address </h1>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5 text-pearl-bush-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                            </svg>

                                            <p class="text-sm"> {{ $order->customerAddress->address_detail }} </p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="bg-white rounded-lg  py-6">
                        <h2 class="text-gray-600 mb-3 font-heading font-medium">Payment Method</h2>
                        <div class="border border-pearl-bush-400 rounded-lg p-4 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-pearl-bush-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <span class="font-medium text-gray-700">Cash On Delivery</span>
                        </div>
                    </div>

                </div>

                {{-- Right Column --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-x-2  ">
                        <p class="font-heading text-gray-700">Ordered Summary
                            @if ($order->is_cancel)
                                @include('components.public.orderStatusBadge', [
                                    'orderStatus' => 'cancel',
                                ])
                            @else
                                @include('components.public.orderStatusBadge', [
                                    'orderStatus' => $order->order_status,
                                ])
                            @endif
                        </p>
                    </div>
                    <div class=" rounded-2xl bg-white border border-pearl-bush-300 mt-5 p-6 space-y-4 summary-container">


                        <div class="summary-output">

                            <div class="space-y-5">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="sub-total">{{ number_format($order->total_amount) }} MMK</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Shipping</span>
                                    <span class="shipping">Free shipping</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Tax</span>
                                    <span class="tax"> {{ number_format($order->tax_amount) }} MMK</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Coupon Discount</span>
                                    <span class="coupon-discount"> {{ number_format($order->coupon_discount) }} MMK</span>
                                </div>

                                <div class="border-t pt-4 flex justify-between font-semibold text-gray-900">
                                    <span>Net Total</span>
                                    <span class="net-total"> {{ number_format($order->net_total) }} MMK</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div>
                        <h3 class="font-heading text-gray-700 mb-2">Order Status</h3>
                        @if ($order->is_cancel)
                            <p class="bg-red-100 text-red-600 px-4 py-2 rounded-lg font-heading"> Your ordrer is cancelled
                            </p>
                        @elseif ($order->order_status === 'pending')
                            <div class="flex items-center gap-x-2 mb-5">
                                <div
                                    class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                    <span class="text-pearl-bush-600 text-sm">1</span>
                                </div>
                                <div>
                                    <p class="text-sm text-pearl-bush-500">Pending</p>
                                    <p class="text-xs text-stone-400"> Order At
                                        {{ date('j M Y', strtotime($order->created_at)) }}
                                        {{ date('g:i A', strtotime($order->created_at)) }} </p>
                                </div>
                            </div>


                            <div>
                                <label for="cancel_order"
                                    class="leading-7 select-none text-stone-500 text-sm font-heading"> Order Cancellation
                                    Form </label>
                                <input type="checkbox"
                                    class="toggle-cancellation-order-form text-sm  focus:ring-2 focus:ring-pearl-bush-500 font-medium text-pearl-bush-500 "
                                    name="cancel_order" id="cancel_order">
                            </div>
                            <form action="{{ route('account.cancelOrder', ['id' => $order->id]) }}" method="POST"
                                class="cancel-order-form">
                                @csrf
                                @method('PATCH')

                                <textarea class="reason-input border border-pearl-bush-400 rounded focus:ring-1 focus:ring-pearl-bush-500"
                                    name="cancel_reason" id="cancel_reason" cols="30" rows="4"></textarea>

                                @error('cancel_reason')
                                    <p class="text-xs text-red-500"> {{ $message }} </p>
                                @enderror

                                {{-- <div class="flex  flex-wrap gap-3">
                                    @foreach ($orderCancellationReasons as $reason)
                                        <p data-reason="{{ $reason['description'] }}"
                                            class="cancel-reason-tag cursor-pointer text-xs border text-pearl-bush-500 border-pearl-bush-400  px-2 py-1 rounded-full">
                                            {{ $reason['tag'] }} </p>
                                    @endforeach
                                </div> --}}

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
                        @elseif ($order->order_status === 'confirmed')
                            <div class="space-y-2">
                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">1</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Pending</p>
                                        <p class="text-xs text-stone-400"> Order At
                                            {{ date('j M Y', strtotime($order->created_at)) }}
                                            {{ date('g:i A', strtotime($order->created_at)) }} </p>
                                    </div>
                                </div>

                                <div class="border-l border-l-pearl-bush-500 py-3 h-5 mx-5"></div>

                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">2</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Confirmed</p>
                                        <p class="text-xs text-stone-400"> Wil Deliver between
                                            {{ $order->delivery_start_date }} and {{ $order->delivery_end_date }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @elseif ($order->order_status === 'delivered')
                            <div class="space-y-2">
                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">1</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Pending</p>
                                        <p class="text-xs text-stone-400"> Order At
                                            {{ date('j M Y', strtotime($order->created_at)) }}
                                            {{ date('g:i A', strtotime($order->created_at)) }} </p>
                                    </div>
                                </div>

                                <div class="border-l border-l-pearl-bush-500 py-3 h-5 mx-5"></div>

                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">2</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Confirmed</p>
                                        <p class="text-xs text-stone-400"> Wil Deliver between
                                            {{ $order->delivery_start_date }} and {{ $order->delivery_end_date }}
                                        </p>
                                    </div>
                                </div>

                                <div class="border-l border-l-pearl-bush-500 py-3 h-5 mx-5"></div>

                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">3</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Delivering</p>
                                        <p class="text-xs text-stone-400"> Out for deliver
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-2">
                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">1</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Pending</p>
                                        <p class="text-xs text-stone-400"> Order At
                                            {{ date('j M Y', strtotime($order->created_at)) }}
                                            {{ date('g:i A', strtotime($order->created_at)) }} </p>
                                    </div>
                                </div>

                                <div class="border-l border-l-pearl-bush-500 py-3 h-5 mx-5"></div>

                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">2</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Confirmed</p>
                                        <p class="text-xs text-stone-400"> Wil Deliver between
                                            {{ $order->delivery_start_date }} and {{ $order->delivery_end_date }}
                                        </p>
                                    </div>
                                </div>

                                <div class="border-l border-l-pearl-bush-500 py-3 h-5 mx-5"></div>

                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">3</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Delivering</p>
                                        <p class="text-xs text-stone-400"> Out for deliver
                                        </p>
                                    </div>
                                </div>

                                <div class="border-l border-l-pearl-bush-500 py-3 h-5 mx-5"></div>

                                <div class="flex items-center gap-x-2">
                                    <div
                                        class="bg-pearl-bush-200  size-10 border border-pearl-bush-600 inline-flex justify-center items-center rounded-full">
                                        <span class="text-pearl-bush-600 text-sm">4</span>
                                    </div>
                                    <div>
                                        <p class="text-sm text-pearl-bush-500">Completed</p>
                                        <p class="text-xs text-stone-400"> Your order is completed
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>



            </div>
        </div>
    @endsection
    @push('scripts')
        @vite(['resources/js/orders/cancelOrder.js'])
    @endpush
