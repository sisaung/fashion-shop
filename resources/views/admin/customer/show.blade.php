@extends('layout.dashboard')



@section('content')
    <div class="flex justify-between items-center ">
        <div>
            @include('components.admin.breadcrumb', [
                'currentPageTitle' => 'Customer Detail',
                'links' => [['name' => 'Customer List', 'path' => route('customer s.index')]],
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
                                <img src="{{ $customer->profile_image }}" alt="{{ $customer->customer_name }}">
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
                        <td class="px-6 py-3 border border-stone-200 text-start"> {{ $customer->created_at }} </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-span-1"></div>

        <div class="col-span-full">
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
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900"> {{ $address->id }} </td>
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
    </section>
@endsection
@push('scripts')
@endpush
