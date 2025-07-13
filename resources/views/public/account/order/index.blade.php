@extends('components.public.accountLayout')
@section('container')
    <div class="pb-10">
        <div class="flex items-center my-5 justify-between">
            <div>
                <h1 class="font-heading px-5 "> Your Orders </h1>
            </div>
            <div class="flex items-center justify-between px-5">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-semibold">{{ $orders->firstItem() ?? 0 }}</span>
                    to <span class="font-semibold">{{ $orders->lastItem() ?? 0 }}</span>
                    of <span class="font-semibold">{{ $orders->total() ?? 0 }}</span> entries
                </div>
                <div>
                    @include('components.public.pagination', ['paginator' => $orders])

                </div>
            </div>
        </div>
        @if ($orders->count() > 0)
            <div class="px-5 space-y-3">
                @foreach ($orders as $order)
                    <div class="border border-pearl-bush-400 rounded-md space-y-5 px-5 py-5">
                        <div class="grid grid-cols-4">
                            <div class="space-y-1.5">
                                <h3 class="font-heading font-semibold">Status</h3>
                                @if ($order->is_cancel)
                                    @include('components.public.orderStatusBadge', [
                                        'orderStatus' => 'Cancel',
                                    ])
                                @else
                                    @include('components.public.orderStatusBadge', [
                                        'orderStatus' => $order->order_status,
                                    ])
                                @endif
                            </div>
                            <div class="space-y-1.5">
                                <h3 class="font-heading font-semibold"> Order ID </h3>
                                <p class="text-pearl-bush-500 text-sm"> {{ $order->order_number }} </p>
                            </div>
                            <div class="space-y-1.5">
                                <h3 class="font-heading font-semibold"> Order At </h3>
                                <p class="text-pearl-bush-500 text-sm"> {{ date('j M Y', strtotime($order->created_at)) }}
                                    {{ date('g:i A', strtotime($order->created_at)) }} </p>
                            </div>
                            <div class="flex items-end flex-col">
                                <h3 class="font-heading font-semibold"> Total Cost </h3>
                                <p class="text-pearl-bush-500 text-sm">
                                    MMK {{ number_format($order->total_amount) }}
                                </p>
                            </div>

                        </div>
                        <div class="grid grid-cols-4">
                            <div class="space-y-1 col-span-2">
                                @if ($order->is_cancel)
                                    <p class="text-red-500 text-sm">Your order is cancelled</p>
                                @else
                                    <div class="flex items-center gap-x-2 mb-3">
                                        <div
                                            class="size-10 rounded-full border border-stone-400 flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-5 text-stone-500 stroke-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                            </svg>

                                        </div>
                                        <div>
                                            <h3 class="text-xs text-stone-400">Esimate Delivery</h3>
                                            {{-- @if ($order->delivery_start_date && $order->delivery_end_date)
                                                <p class="text-xs text-stone-700"> Wil Deliver between
                                                    {{ $order->delivery_start_date }} and {{ $order->delivery_end_date }}
                                                </p> --}}
                                            @if ($order->order_status === 'confirmed')
                                                <p class="text-xs text-stone-700"> Wil Deliver between
                                                    {{ $order->delivery_start_date }} and {{ $order->delivery_end_date }}
                                                </p>
                                            @elseif($order->order_status === 'delivered')
                                                <p class="text-xs text-stone-700"> Out for deliver </p>
                                            @elseif($order->order_status === 'completed')
                                                <p class="text-xs text-stone-700"> Your order is completed </p>
                                            @else
                                                <p class="text-xs text-stone-700"> not confirm yet </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-x-2">
                                        <div
                                            class="size-10 rounded-full border border-stone-400 flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-5 text-stone-500 stroke-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                            </svg>


                                        </div>
                                        <div>
                                            <p class="text-xs text-stone-500"> {{ $order->customerAddress->address_detail }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="flex items-center gap-2">
                                @foreach ($order->orderItems as $item)
                                    @if ($item->stock->product->productImages->count() > 0)
                                        @foreach ($item->stock->product->productImages->take(1) as $image)
                                            <div class="size-10 border border-pearl-bush-300 rounded-lg overflow-hidden">
                                                <img src="{{ $image->thumbnail ? $image->thumbnail : 'https://www.mooreseal.com/wp-content/uploads/2013/11/dummy-image-square-300x300.jpg' }}"
                                                    alt="{{ $image->original_name }}"
                                                    class="w-full aspect-square object-cover object-top">
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>

                            <div class="text-end justify-end flex items-center col-span-1">
                                <a href="{{ route('account.showOrder', $order->order_number) }}"
                                    class="bg-pearl-bush-500 text-white px-4 py-2.5 rounded-full hover:bg-pearl-bush-600 cursor-pointer text-xs">Order
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-stone-100 py-10 rounded px-5 mx-5 flex justify-center items-center ">
                <p>You haven’t placed any orders yet. Ready to shop? <a href="{{ route('shop.index') }}"
                        class="text-pearl-bush-500 underline-offset-4 underline hover:text-pearl-bush-700">Go to shop</a>
                </p>
            </div>
        @endif
    </div>
@endsection
