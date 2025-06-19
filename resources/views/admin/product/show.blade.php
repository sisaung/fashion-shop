@extends('layout.dashboard')



@section('content')
    <div class="flex justify-between items-center ">
        <div>
            @include('components.admin.breadcrumb', [
                'currentPageTitle' => 'Product Detail',
                'links' => [
                    [
                        'name' => 'Product List',
                        'path' => route('product.index'),
                    ],
                ],
            ])
        </div>

        <div class="px-5">
            <div class="flex gap-x-3 justify-center items-center">

                {{-- edit product --}}
                <div>
                    <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                        class="size-12 border-2 border-pearl-bush-300  inline-flex justify-center items-center   bg-pearl-bush-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>
                </div>

                <div class="border-t-2 border-t-pearl-bush-500 border-dashed w-10"></div>

                {{-- manage product image --}}
                <div>
                    <a href="{{ route('manage-image.edit', ['id' => $product->id]) }}"
                        class="cursor-pointer size-12 border-2 border-pearl-bush-300  inline-flex justify-center items-center bg-pearl-bush-500    rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>

                    </a>
                </div>

                <div class="border-t-2 border-t-pearl-bush-500 border-dashed w-10"></div>

                {{-- manage stock --}}
                <div>
                    <a href="{{ route('manage-stock.store', ['id' => $product->id]) }}"
                        class="size-12 border-2 border-pearl-bush-300  inline-flex justify-center items-center   bg-pearl-bush-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                        </svg>

                    </a>
                </div>

                <div class="border-t-2 border-t-pearl-bush-500 border-dashed w-10"></div>


                {{-- product detail --}}

                <div>
                    <p
                        class="size-12 border-2 border-pearl-bush-300  inline-flex justify-center items-center   bg-pearl-bush-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>

                    </p>
                </div>

            </div>
        </div>
    </div>

    <h1 class="mt-10 text-xl px-5"> Product Detail </h1>
    <section class="mt-10 px-5">

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 2xl:grid-cols-6 gap-6">
            <div class="col-span-1 md:col-span-2 lg:col-span-3 w-full overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full divide-y divide-gray-200">
                    <tbody class="divide-y divide-gray-200 bg-white ">

                        <tr class="bg-stone-100">
                            <td colSpan="3" class=" px-4 py-4 text-start text-sm text-stone-600">
                                Product Title
                            </td>
                            <td class="  px-4 py-4 text-sm text-stone-600">Product Code</td>
                        </tr>
                        <tr>
                            <td colSpan="3" class=" px-4 py-4 text-start">
                                {{ $product->product_name }}
                            </td>
                            <td class=" px-4 py-4">
                                {{ $product->product_code }}
                            </td>
                        </tr>

                        {{-- Brand, Type, Category, Fitting } --}}
                        <tr class="bg-stone-100">
                            <td class=" px-4 py-4 text-sm text-stone-600">Brand</td>
                            <td class=" px-4 py-4 text-sm text-stone-600">Product Type</td>
                            <td class=" px-4 py-4 text-sm text-stone-600">Category</td>
                            <td class=" px-4 py-4 text-sm text-stone-600">Fitting</td>
                        </tr>
                        <tr>
                            <td class=" px-4 py-4">
                                <span class=" px-2 rounded-lg bg-pearl-bush-400 text-white py-2 text-sm">
                                    {{ $product->brand->brand_name }} </span>
                            </td>
                            <td class=" px-4 py-4">
                                <span class=" px-2 bg-pearl-bush-400 text-white py-2 text-sm rounded-lg ">

                                    {{ $product->productType->name }}
                                </span>
                            </td>
                            <td class=" px-4 py-4">
                                <span class=" px-2 rounded-lg bg-pearl-bush-400 text-white py-2 text-sm">

                                    {{ $product->productCategory->category_name }}
                                </span>
                            </td>
                            <td class=" px-4 py-4">
                                <span class=" px-2 rounded-lg bg-pearl-bush-400 text-white py-2 text-sm">

                                    @if ($product->fit)
                                        {{ $product->fit->fit_name }}
                                    @else
                                        There is no fit.
                                    @endif

                                </span>
                            </td>
                        </tr>

                        {{-- Price,sale,discount --}}
                        <tr class="bg-stone-100">
                            <td class=" px-4 py-4 text-sm text-stone-600">Original Price</td>

                            <td class=" px-4 py-4 text-sm text-stone-600" colSpan={2}>
                                Sale Price <span class="text-green-500 pl-1 "> Profit (
                                    {{ $product->sale_price - $product->original_price }} ) </span>
                            </td>
                            <td class=" px-4 py-4 text-sm text-stone-600">Discount</td>
                            <td class=" px-4 py-4 text-sm text-stone-600"></td>

                        </tr>
                        <tr>
                            <td class=" px-4 py-4 "> {{ number_format($product->original_price) }} MMK</td>
                            <td class=" px-4 py-4" colSpan={2}>
                                <p class="inline-flex gap-2">
                                    @if ($product->discount_percentage != 0)
                                        <span> {{ number_format($product->display_price) }} MMK </span>
                                    @endif
                                    <span class="{{ $product->discount_percentage ? 'line-through' : '' }}">
                                        {{ number_format($product->sale_price) }} MMK</span>
                                </p>
                            </td>
                            <td class=" px-4 py-4"> {{ $product->discount_percentage ?? 0 }} % </td>
                        </tr>

                        <tr class="bg-stone-100">
                            <td class=" px-4 py-4 text-sm text-stone-600">Gender</td>
                            <td class=" px-4 py-4 text-sm text-stone-600">New Arrival</td>
                            <td class=" px-4 py-4 text-sm text-stone-600">Created By</td>
                            <td class=" px-4 py-4 text-sm text-stone-600">Created At</td>
                        </tr>
                        <tr>
                            <td class=" px-4 py-4"> {{ $product->gender }} </td>
                            <td class=" px-4 py-4"> {{ $product->is_new_arrival ? 'Yes' : 'No' }} </td>
                            <td class=" px-4 py-4"> {{ $product->user->name }} </td>
                            <td class="text-nowrap px-4 py-4"> {{ date('j M Y', strtotime($product->created_at)) }}
                                {{ date('g:i A', strtotime($product->created_at)) }} </td>
                        </tr>

                        {{-- Product Description --}}
                        <tr class="bg-stone-100">
                            <td colSpan="4" class=" px-4 py-4 text-sm text-stone-600">
                                Product Description
                            </td>
                        </tr>
                        <tr>
                            <td colSpan="4" class=" px-4 py-4">
                                <p class="text-sm text-gray-700">
                                    {{ $product->description }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-span-1 lg:col-span-2">
                <div class="mb-7">
                    <div class="flex items-center mb-3">
                        <h3 class="text-sm font-semibold me-3 text-stone-600">
                            Product Image ( {{ $product->productImages->count() }} )
                        </h3>
                        <a href="{{ route('manage-image.edit', $product->id) }}"
                            class="py-1 px-3 text-xs font-medium text-pearl-bush-400 bg-white rounded-lg border border-pearl-bush-400 hover:bg-gray-100 focus:z-10 focus:ring-4">Manage
                            Image</a>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @if ($product->productImages->count())
                            @foreach ($product->productImages as $image)
                                <a href="{{ $image->large }}"
                                    class="border border-pearl-bush-300 rounded-lg overflow-hidden" target="_blank">
                                    <img class="h-20 w-18" src="{{ $image->thumbnail }}"
                                        alt="{{ $image->original_name }}" />
                                </a>
                            @endforeach
                        @else
                            <img class="h-20 rounded-md"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949"
                                alt="demo">
                        @endif


                    </div>
                </div>

                <div class="w-full mb-7">
                    <div class="col-span-full">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                            <div class="flex items-center mb-3">
                                <h3 class="text-sm font-semibold me-3 text-stone-600">
                                    Product Stock (<span> {{ $product->stocks->count() }} </span>)
                                </h3>
                            </div>
                            <table class=" w-full divide-y divide-gray-200 text-sm text-left  text-stone-500">
                                <thead class="divide-y divide-gray-200  bg-stone-100">
                                    <tr>
                                        <th scope="col" class="p-3">Size</th>
                                        <th scope="col" class="p-3">SKU</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @if ($product->stocks->count())
                                        @foreach ($product->stocks as $stock)
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm ">
                                                    {{ $stock->size->size_name }} </td>
                                                <td class="px-6 py-3 whitespace-nowrap text-sm "> {{ $stock->sku }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('product.create') }}"
                        class="text-white flex justify-center items-center gap-3 bg-pearl-bush-400 hover:bg-pearl-bush-600 font-medium rounded-lg text-sm px-5 py-2.5">
                        Add New Product
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path
                                d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                        </svg>

                    </a>
                    <a href="{{ route('product.index') }}"
                        class="text-white flex justify-center items-center gap-3 bg-pearl-bush-400 hover:bg-pearl-bush-600 font-medium rounded-lg text-sm px-5 py-2.5">
                        Manage Product
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
