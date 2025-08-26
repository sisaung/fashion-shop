@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Invoice List',
        ])

        @include('admin.invoices.header')

        <div id="invoice-list-container">
            <section class="mt-10 px-5  drop-down-modal ">
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 ">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50 sorting-wrapper">
                            <tr>
                                {{-- <th data-sortby="id" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    @include('components.admin.sortTable', ['sortTitle' => 'ID'])

                                </th> --}}
                                <th data-sortby="invoice_number" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Invoice Number',
                                    ])

                                </th>

                                <th data-sortby="customer_name" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Customer',
                                    ])

                                </th>

                                <th data-sortby="status" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Status',
                                    ])

                                </th>

                                <th data-sortby="total_amount" scope="col"
                                    class="px-4 py-3 flex justify-end text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Total',
                                    ])

                                </th>

                                <th data-sortby="item_count" scope="col"
                                    class="px-4 py-3 text-end text-sm font-medium text-gray-500">

                                    Item

                                </th>

                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Created
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Updated
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


                            @foreach ($invoices as $invoice)
                                <tr>
                                    {{-- <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $index + 1 }}
                                    </td> --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        {{ $invoice->invoice_number }}
                                    </td>

                                    <td class="whitespace-wrap px-4 w-[230px] py-4 text-sm text-gray-900">
                                        <div class="grid grid-cols-4">

                                            <div class="">

                                                @if ($invoice->order->customer->profile_image)
                                                    @if (Str::startsWith($invoice->order->customer->profile_image, 'https'))
                                                        <img src="{{ $invoice->order->customer->profile_image }}"
                                                            class="size-10
                                                        rounded-full"
                                                            alt="{{ $invoice->order->customer->customer_name }}" />
                                                    @else
                                                        <img src="{{ asset('/storage/' . $invoice->order->customer->profile_image) }}"
                                                            class="size-10
                                                        rounded-full object-cover object-center"
                                                            alt="{{ $invoice->order->customer->customer_name }}" />
                                                    @endif
                                                @else
                                                    <img src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1≈"
                                                        class="size-10 rounded-full"
                                                        alt="{{ $invoice->order->customer->customer_name }}" />
                                                @endif
                                            </div>
                                            <div class="flex flex-col col-span-3">
                                                <a href="{{ route('customer.show', ['customer' => $invoice->order->customer->id]) }}"
                                                    class="text-base underline underline-offset-2 ">{{ $invoice->order->customer_name }}</a>
                                                <span class="text-xs text-stone-500 line-clamp-1">
                                                    {{ $invoice->order->customer->customer_email }} </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        @include('components.admin.invoiceStatusBadge', [
                                            'invoiceStatus' => $invoice->status,
                                        ])
                                    </td>


                                    <td class="whitespace-nowrap px-4 py-4 text-end text-sm text-gray-900">
                                        {{ number_format($invoice->order->total_amount) }} MMK
                                    </td>

                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        {{ $invoice->order->orderItems->count() }}
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                        <div class="">
                                            <p> {{ date('j M Y', strtotime($invoice->created_at)) }} </p>
                                            <p> {{ date('g:i A', strtotime($invoice->created_at)) }} </p>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                        <div class="">
                                            <p> {{ date('j M Y', strtotime($invoice->created_at)) }} </p>
                                            <p> {{ date('h:i A', strtotime($invoice->created_at)) }} </p>
                                        </div>
                                    </td>

                                    <td
                                        class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex items-center justify-center">

                                        <a href="{{ route('invoice.show', $invoice->id) }}"
                                            class="px-2 py-1 hover:bg-gray-100 inline-flex justify-center items-center"
                                            href="{{ route('invoice.show', $invoice->id) }}">
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

            </section>


            <div class="pagination-wrapper">
                @include('components.pagination', ['paginator' => $invoices])

            </div>
        </div>



    </div>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
    @vite(['resources/js/sorting.js'])
    @vite(['resources/js/search.js'])
    {{-- @vite(['resources/js/pagination.js']) --}}
    {{-- @vite(['resources/js/redirectToDetail.js']) --}}
@endpush
