@extends('layout.dashboard')



@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        <div class="flex justify-between items-center  ">
            <div>
                @include('components.admin.breadcrumb', [
                    'currentPageTitle' => 'Customer Detail',
                    'links' => [['name' => 'Customer List', 'path' => route('customer.index')]],
                ])
            </div>


        </div>

        <h1 class="mt-10 text-xl px-5"> Customer Detail </h1>
        <section class="px-5 grid grid-cols-2 gap-x-5">


            <div class="col-span-1 mt-5">
                <h3 class="text-sm font-semibold me-3 text-stone-600 mb-3">
                    Customer Information

                </h3>

                <table class="w-full text-sm text-left rtl:text-right text-stone-600 mb-10">
                    <tbody>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">Image</td>
                            <td class="px-6 py-3 border border-stone-200 text-start">

                                @if ($customer->profile_image)
                                    @if (Str::startsWith($customer->profile_image, 'https'))
                                        <img class="w-20 rounded-full" src="{{ $customer->profile_image }}" alt="Demo" />
                                    @else
                                        <img class="w-20 rounded-full"
                                            src="{{ asset('storage/' . $customer->profile_image) }}" alt="Demo" />
                                    @endif
                                @else
                                    <img class="w-20 rounded-full"
                                        src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1"
                                        alt="Demo" />
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">User Name</td>
                            <td class="px-6 py-3 border border-stone-200 text-start">{{ $customer->customer_name }} </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">User Email</td>
                            <td class="px-6 py-3 border border-stone-200 text-start"> {{ $customer->customer_email }} </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">Created</td>
                            <td class="px-6 py-3 border border-stone-200 text-start text-nowrap">
                                {{ date('j M Y', strtotime($customer->created_at)) }} -
                                {{ date('h:i A', strtotime($customer->created_at)) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-span-1"></div>


            <div class="col-span-full mb-5">
                <h3 class="text-sm font-semibold me-3 text-stone-600 mb-3">
                    Customer Addresses
                </h3>
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">#</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Phone</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Full Address</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">City</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Township</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">


                            @foreach ($customer->addresses as $address)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $address->id }} </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $address->phone_number }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $address->address_detail }}
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $address->city }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $address->township }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-span-full">
                <h3 class="text-sm font-semibold me-3 text-stone-600 mb-3">
                    Customer Orders
                </h3>
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 ">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50 sorting-wrapper">
                            <tr>
                                <th data-sortby="id" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    @include('components.admin.sortTable', ['sortTitle' => 'ID'])

                                </th>


                                <th data-sortby="total_amount" scope="col"
                                    class="px-4 py-3 flex justify-end text-sm font-medium text-gray-500">
                                    {{-- @include('components.admin.sortTable', ['sortTitle' => 'Total']) --}}
                                    Total

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
                        <tbody class="divide-y divide-gray-200 bg-white">


                            @foreach ($customer->orders as $order)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $order->order_number }}
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

                                                @if ($order->coupon->discount_type == 'percentage')
                                                    <span class="text-lg"> {{ $order->coupon->coupon_discount }} % </span>
                                                @else
                                                    <span class="text-lg"> {{ $order->coupon->coupon_discount }} Ks </span>
                                                @endif

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
                                                data-dropdown-toggle="dropdown-{{ $order->id }}" class="cursor-pointer"
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
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

                                                    <input type="hidden" class="limit" name="limit">

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



                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
@push('scripts')
@endpush
