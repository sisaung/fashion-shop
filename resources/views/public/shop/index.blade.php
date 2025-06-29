@php
    $selectProducts = [
        'is_new_arrival&desc' => 'Newest',
        'id&desc' => 'Latest to Oldest',
        'id&asc' => 'Oldest to Latest',
        'sale_price&desc' => 'Price: High to Low',
        'sale_price&asc' => 'Price: Low to High',
        'discount_percentage&asc' => 'Discount: Low to High',
        'discount_percentage&desc' => 'Discount: High to Low',
    ];

@endphp

@extends('components.public.pagelayout')
@section('container')
    <div class="mt-8">
        <div class="flex justify-between items-center">

            <div>
                @include('components.breadcrumb', [
                    'currentPageTitle' => 'Shop',
                    'totalProduct' => $products->count(),
                ])
            </div>
            <div class="flex items-center gap-3">

                <button data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                    data-drawer-placement="right" aria-controls="drawer-right-example"
                    class="bg-gray-50
                    border border-gray-300 focus:ring-1 focus:ring-pearl-bush-400 text-gray-900 inline-flex items-center
                    text-sm rounded-lg gap-x-2 px-4 py-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-list-filter group-active:scale-75 duration-300">
                        <path d="M3 6h18"></path>
                        <path d="M7 12h10"></path>
                        <path d="M10 18h4"></path>
                    </svg>
                    Filter Product </button>

                <div id="drawer-right-example"
                    class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 "
                    tabindex="-1" aria-labelledby="drawer-right-label">
                    <h5 id="drawer-right-label"
                        class="inline-flex items-center gap-x-2 mb-4 text-base font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 stroke-pearl-bush-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                        Filter Product
                    </h5>
                    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center ">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>



                    {{-- <div class="mb-6">
                        <h5 class="text-gray-700 font-heading font-semibold">Product Category Filter </h5>

                        <template id="filter-product-category-template">
                            <input type="radio" name="">
                            <span
                                class="filter-category-btn cursor-pointer  px-4 py-2 border border-pearl-bush-200 text-xs text-gray-500 rounded-lg">
                            </span>

                        </template>

                        <div id="filter-product-category-container" class="mt-2 flex flex-wrap gap-2">
                        </div>
                    </div> --}}

                    {{-- category with radio --}}
                    <div class="mb-6">
                        <h5 class="text-gray-700 font-heading font-semibold">Product Category Filter </h5>

                        <template id="filter-product-category-template">
                            <label class="cursor-pointer text-sm text-gray-600">
                                <input type="radio" name="product-category" class="filter-product-category-radio hidden"
                                    data-product-category="" />
                                <span
                                    class="filter-product-category-label inline-block px-4 py-2 border border-pearl-bush-200 text-xs text-gray-500 rounded-lg"></span>
                            </label>
                        </template>

                        <div id="filter-product-category-container" class="mt-2 flex flex-wrap gap-2"></div>
                    </div>


                    {{-- producttype with radio --}}

                    <div class="mb-6">
                        <h5 class="text-gray-700 font-heading font-semibold">Product Type Filter </h5>

                        <template id="filter-product-type-template">
                            <label class="cursor-pointer text-sm text-gray-600">
                                <input type="radio" name="product-type" class="filter-product-type-radio hidden"
                                    data-product-type="" />
                                <span
                                    class="filter-product-type-label inline-block px-4 py-2 border border-pearl-bush-200 text-xs text-gray-500 rounded-lg"></span>
                            </label>
                        </template>

                        <div id="filter-product-type-container" class="mt-2 flex flex-wrap gap-2"></div>
                    </div>


                    {{-- product fit with radio --}}

                    <div class="mb-6">
                        <h5 class="text-gray-700 font-heading font-semibold hidden fit-heading">Product Fit Filter </h5>

                        <template id="filter-product-fit-template">
                            <label class="cursor-pointer text-sm text-gray-600">
                                <input type="radio" name="product-fit" class="filter-product-fit-radio hidden"
                                    data-product-fit="" />
                                <span
                                    class="filter-product-fit-label inline-block px-4 py-2 border border-pearl-bush-200 text-xs text-gray-500 rounded-lg"></span>
                            </label>
                        </template>

                        <div id="filter-product-fit-container" class="mt-2 flex flex-wrap gap-2"></div>
                    </div>


                    <div class="mb-6">
                        <h5 class="text-gray-700 font-heading font-semibold hidden size-heading">Product Size Filter </h5>

                        <template id="filter-product-size-template">
                            <label class="cursor-pointer text-sm text-gray-600">
                                <input type="radio" name="product-size" class="filter-product-size-radio hidden"
                                    data-product-size="" />
                                <span
                                    class="filter-product-size-label inline-block px-4 py-2 border border-pearl-bush-200 text-xs text-gray-500 rounded-lg"></span>
                            </label>
                        </template>

                        <div id="filter-product-size-container" class="mt-2 flex flex-wrap gap-2"></div>
                    </div>


                    <div class="flex items-center gap-x-3">
                        <button id="apply-clears-btn"
                            class=" text-white cursor-pointer bg-pearl-bush-300 px-4 py-2 rounded-full text-sm">
                            Clear
                            Filters </button>
                        <button id="apply-filters-btn"
                            class=" text-white cursor-pointer bg-pearl-bush-500 px-4 py-2 rounded-full text-sm">
                            Filter
                            Products
                        </button>

                    </div>

                </div>




                <select id="select-product"
                    class="sort-product bg-gray-50 border border-gray-300 focus:ring-1 focus:ring-gray-400  text-gray-900 text-sm rounded-lg  block w-52 p-2.5 ">
                    <option>Select Product</option>

                    @foreach ($selectProducts as $key => $product)
                        <option value="{{ $key }}"> {{ $product }} </option>
                    @endforeach

                </select>


            </div>
        </div>

        <template id="product-template">
            @include('public.shop.components.productList')

        </template>

        {{-- product list --}}
        <section>
            <div class="grid grid-cols-4 gap-5 mt-8" id="product-container">


            </div>
        </section>

        <template id="pagination-template">
            @include('components.public.paginationTest')

        </template>

        <div class="flex justify-center items-center pb-10" id="pagination-container">
        </div>
    @endsection

    @push('scripts')
        {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
        @vite(['resources/js/shop-product/shopProductList.js'])
        @vite(['resources/js/shop-product/sortProduct.js'])
        @vite(['resources/js/shop-product/getProductCategory.js'])
        @vite(['resources/js/shop-product/product-type/getProductType.js'])
        @vite(['resources/js/shop-product/product-detail/redirect.js'])


        {{-- @vite(['resources/js/shop-product/setUpFilterEvent.js']) --}}

        {{-- @vite(['resources/js/sidebar/renderShopBrand.js']) --}}
    @endpush
