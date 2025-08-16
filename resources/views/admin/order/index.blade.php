@extends('layout.dashboard')

@section('content')
    <div class="bg-white mt-5 py-5 rounded-md shadow">


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Order List',
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
                                <th scope="col" class="px-4 py-3  text-sm font-medium text-gray-500">

                                    Payment Received

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
                        <tbody class="divide-y divide-gray-200 bg-white overflow-hidden">


                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                            {{ $order->order_number }}
                                        </td>
                                        <td class="whitespace-wrap px-4 w-[230px] py-4 text-sm text-gray-900">
                                            <div class="grid grid-cols-4">

                                                <div class="">

                                                    @if ($order->customer->profile_image)
                                                        @if (Str::startsWith($order->customer->profile_image, 'https'))
                                                            <img src="{{ $order->customer->profile_image }}"
                                                                class="size-10
                                                            rounded-full"
                                                                alt="{{ $order->customer->customer_name }}" />
                                                        @else
                                                            <img src="{{ asset('/storage/' . $order->customer->profile_image) }}"
                                                                class="size-10
                                                            rounded-full object-cover object-center"
                                                                alt="{{ $order->customer->customer_name }}" />
                                                        @endif
                                                    @else
                                                        <img src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1≈"
                                                            class="size-10 rounded-full"
                                                            alt="{{ $order->customer->customer_name }}" />
                                                    @endif
                                                </div>
                                                <div class="flex flex-col col-span-3">
                                                    <a href="{{ route('customer.show', ['customer' => $order->customer->id]) }}"
                                                        class="text-base underline underline-offset-2 ">{{ $order->customer_name }}</a>
                                                    <span class="text-xs text-stone-500 line-clamp-1">
                                                        {{ $order->customerAddress->address_detail }} </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                            {{ number_format($order->total_amount) }} MMK
                                        </td>


                                        <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                            {{ $order->orderItems->count() }}
                                        </td>

                                        <td class="whitespace-nowrap flex justify-end px-4 py-4 text-sm text-gray-900">
                                            @if ($order->coupon)
                                                <div class="flex flex-col items-end justify-center">
                                                    <span class="text-lg">
                                                        {{ $order->coupon->discount_type == 'percentage' ? $order->coupon->coupon_discount . ' %' : number_format($order->coupon->coupon_discount) . ' Ks' }}
                                                    </span>
                                                    <span class="text-xs  text-gray-500">
                                                        {{ $order->coupon->coupon_code }}</span>
                                                </div>
                                            @else
                                                <div class="flex flex-col items-end justify-center ">
                                                    <span class="text-lg"> 0 </span>
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
                                        <td class="whitespace-nowrap flex justify-end px-4 py-4 text-sm text-gray-900">
                                            @if ($order->payment_received_at)
                                                <div class="flex flex-col items-end">
                                                    <p> {{ date('j M Y', strtotime($order->payment_received_at)) }} </p>
                                                    <p> {{ date('g:i A', strtotime($order->payment_received_at)) }} </p>
                                                </div>
                                            @else
                                                <span class="text-red-500 text-xs">Not Received</span>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                            <div class="">
                                                <p> {{ date('j M Y', strtotime($order->created_at)) }} </p>
                                                <p> {{ date('g:i A', strtotime($order->created_at)) }} </p>
                                            </div>
                                        </td>

                                        <td
                                            class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex items-center justify-center">



                                            <div class="flex items-center gap-x-3">

                                                <button id="dropdownDefaultButton-{{ $order->id }}"
                                                    data-dropdown-toggle="dropdown-{{ $order->id }}"
                                                    class="cursor-pointer" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                    </svg>

                                                </button>
                                            </div>


                                            <!-- Dropdown menu -->
                                            <div id="dropdown-{{ $order->id }}"
                                                class="z-10 hidden bg-white menu-box-shadow -translate-x-6 divide-y divide-gray-100 rounded-lg w-40">
                                                <div class="py-3 flex flex-col justify-start items-start text-sm text-gray-600"
                                                    aria-labelledby="dropdownDefaultButton-{{ $order->id }}">


                                                    @if ($order->is_paid != 1)
                                                        {{-- mark as paid btn for modal --}}
                                                        <button
                                                            onclick="document.getElementById('mark-as-paid-{{ $order->id }}').submit()"
                                                            class=" w-full px-5 hover:bg-gray-100 inline-flex py-2 items-center gap-x-3 cursor-pointer"
                                                            type="button">


                                                            Mark as Paid
                                                        </button>
                                                    @else
                                                        <span
                                                            class="inline-flex justify-start px-5 py-1 rounded-lg  text-green-500">Paid</span>
                                                    @endif

                                                    <form class="hidden" id="mark-as-paid-{{ $order->id }}"
                                                        action="{{ route('order.markAsPaid', ['id' => $order->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <input type="hidden" class="sort-by" name="sortBy">

                                                        <input type="hidden" class="sort-direction" name="sortDirection">

                                                        <input type="hidden" class="limit_value" name="limit">

                                                        <input type="hidden" class="page" name="page">


                                                        <button
                                                            class="px-2 py-1.5 border text-sm border-gray-200 cusor-pointer text-gray-500 hover:bg-green-400 hover:text-white cursor-pointer duration-300 inline-flex justify-center items-center">
                                                            Mark as Paid
                                                        </button>
                                                    </form>


                                                    <button type="button"
                                                        class="order-detail w-full px-5 hover:bg-gray-100 inline-flex py-2 items-center gap-x-3 cursor-pointer"
                                                        data-order-detail-url="{{ route('order.show', ['order' => $order->id]) }}">

                                                        Detail
                                                    </button>

                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="py-5 text-center text-sm text-gray-500"> There are no
                                        orders.

                                    </td>
                                </tr>
                            @endif



                        </tbody>
                    </table>
                </div>
            </section>



        </div>

        <div class="pagination-wrapper">
            @include('components.pagination', ['paginator' => $orders])

        </div>


    </div>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
    @vite(['resources/js/sorting.js'])
    @vite(['resources/js/search.js'])
    @vite(['resources/js/saveOrderCurrentParams.js'])
    @vite(['resources/js/filterOrder.js'])



    {{-- @vite(['resources/js/pagination.js']) --}}
@endpush
