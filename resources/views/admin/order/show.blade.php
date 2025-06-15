@extends('layout.dashboard')



@section('content')
    <div class="flex justify-between items-center ">
        <div>
            @include('components.admin.breadcrumb', [
                'currentPageTitle' => 'Customer Detail',
                // 'links' => [['name' => 'Manage Product', 'path' => 'product.index']],
            ])
        </div>


    </div>

    <h1 class="mt-10 text-xl px-5"> Order Detail </h1>
    <section class="grid grid-cols-6 gap-x-5 mb-10">

        <div class="col-span-4">
            <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Product Name</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Size</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Price</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 w-[350px] "></th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                           @foreach ($order->orderItems as $item )
                           <tr>

                            <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                {{ $item->product->product_name }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                {{-- {{ $item->product->productType }} --}}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                {{ $item->city }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                {{ $item->township }}
                            </td>
                        </tr>
                           @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div></div>

    </section>
@endsection
@push('scripts')
@endpush
