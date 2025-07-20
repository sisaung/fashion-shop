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

                                        {{-- <button data-detail="{{ route('order.show', $order->id) }}"
                                            class="px-2 py-1 hover:bg-gray-100 inline-flex justify-center items-center"
                                            href="{{ route('order.show', $order->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-5 text-gray-600">
                                                <path fill-rule="evenodd"
                                                    d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </button> --}}

                                        <a href ="{{ route('order.show', $order->id) }}"
                                            class="px-2 py-1 hover:bg-gray-100 inline-flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-5 text-gray-600">
                                                <path fill-rule="evenodd"
                                                    d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </a>


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
