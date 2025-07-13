@php
    $selectProducts = [
        'is_new_arrival&desc' => 'Newest',
        'id&desc' => 'Latest to Oldest',
        'id&asc' => 'Oldest to Latest',
        'sale_price&desc' => 'Price: High to Low',
        'sale_price&asc' => 'Price: Low to High',
        'discount_value&asc' => 'Discount: Low to High',
        'discount_value&desc' => 'Discount: High to Low',
    ];

@endphp

@extends('components.public.pagelayout')
@section('container')
    <div class="mt-8">
        <div class="flex lg:flex-row flex-col justify-start lg:justify-between items-start lg:items-center lg:gap-0 gap-5">


            @php
                $item = request()->query('item');
                $gender = request()->query('gender');
                $currentPageTitle = 'Shop'; // default

                // Determine title based on query
                if ($item) {
                    if ($item === 'new_arrival') {
                        $currentPageTitle = 'New Arrival';
                    } else {
                        $currentPageTitle = ucwords(str_replace('-', ' ', $item));
                    }
                }

                if ($gender) {
                    if ($gender === 'male') {
                        $currentPageTitle = 'Male';
                    } elseif ($gender === 'female') {
                        $currentPageTitle = 'Female';
                    } elseif ($gender === 'unisex') {
                        $currentPageTitle = 'Unisex';
                    }
                }

                // Prepare breadcrumb links
                $links = [['name' => 'Shop', 'path' => route('shop.index')]];
            @endphp

            <div class="flex items-center gap-x-3 justify-center">
                <div class="mt-3">
                    <button id="openSidebar" class="cursor-pointer lg:**:hidden inline-flex justify-center items-center"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>

                    </button>
                </div>
                <div>
                    @include('components.breadcrumb', [
                        'currentPageTitle' => $currentPageTitle,
                        'links' => $currentPageTitle !== 'Shop' ? $links : null,
                        'totalProduct' => $products->count(),
                    ])
                </div>
            </div>

            {{-- sidebar overlay --}}
            <div id="sidebarOverlay" class="fixed inset-0 bg-black/10 bg-opacity-50 z-40 hidden"></div>


            <div class="flex items-center gap-3">

                <button data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                    data-drawer-placement="right" aria-controls="drawer-right-example"
                    class="bg-gray-50
                    border border-gray-300  focus:ring-1 focus:ring-pearl-bush-400 text-gray-900 inline-flex items-center
                    text-sm rounded-lg gap-x-2 px-4 py-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-list-filter group-active:scale-75 duration-300">
                        <path d="M3 6h18"></path>
                        <path d="M7 12h10"></path>
                        <path d="M10 18h4"></path>
                    </svg>
                    <span class="filter-product-text"> Filter Product</span>
                    <span
                        class="total-filter-product text-xs bg-pearl-bush-100 text-pearl-bush-800 font-medium  px-2.5 py-0.5 rounded-md hidden">
                    </span>
                </button>


                <button id="dropdownDefaultButton1" data-dropdown-toggle="dropdown1"
                    class=" focus:ring-1 border border-gray-200 bg-gray-50 focus:ring-gray-400  text-gray-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center flex items-center justify-between gap-x-5 "
                    type="button">

                    <p class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4.5  stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                        </svg>

                        <span class="sort-product-btn"> Sort Product</span>
                    </p>

                    <p>
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </p>
                </button>




                {{-- <select id="select-product"
                    class="sort-product bg-gray-50 border border-gray-300 focus:ring-1 focus:ring-gray-400  text-gray-900 text-sm rounded-lg  block w-52 p-2.5 ">
                    <option>Select Product</option>

                    @foreach ($selectProducts as $key => $product)
                        <option value="{{ $key }}"> {{ $product }} </option>
                    @endforeach

                </select> --}}


            </div>
        </div>

        <template id="product-template">
            @include('public.shop.components.productList')

        </template>

        <template id="product-empty-template">
            <div class="w-full gap-5 flex flex-col mt-5 items-center justify-center">
                <h1 class="text-3xl font-heading text-gray-800"> Nothing Found Products </h1>
                <p class="text-sm text-gray-500"> Please check back </p>
                <button data-go-shop="{{ route('shop.index') }}"
                    class="back-shop-now bg-pearl-bush-500 text-white px-5 hover:bg-pearl-bush-600 py-2 rounded-full">Shop
                    Now</button>
            </div>
        </template>

        {{-- product list --}}
        <section>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mt-8" id="product-container">


            </div>
        </section>

        {{-- empty section --}}
        <div id="empty-product-container"></div>

        <section class="pt-10 ">
            <div id="pagination-container" class="flex justify-center pb-10"></div>
        </section>

        <template id="pagination-template">
            @include('components.public.paginationTest')

        </template>

        {{-- filter product menu --}}
        <div id="drawer-right-example"
            class="fixed top-0 right-0 z-50 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 "
            tabindex="-1" aria-labelledby="drawer-right-label">
            <h5 id="drawer-right-label" class="inline-flex items-center gap-x-2 mb-4 text-base font-semibold text-gray-700">
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
                    class=" text-white  cursor-pointer bg-pearl-bush-300 px-4 py-2 rounded-full text-sm">
                    Clear
                    Filters </button>
                <button id="apply-filters-btn"
                    class=" text-white   cursor-pointer bg-pearl-bush-500 px-4 py-2 rounded-full text-sm">
                    Filter
                    Products
                </button>

            </div>

        </div>

        {{-- sort product menu --}}
        <!-- Dropdown menu -->
        <div id="dropdown1"
            class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-52 dark:bg-gray-700">
            <div class="sort-product py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton1">
                @foreach ($selectProducts as $key => $product)
                    <button data-sort-product="{{ $key }}"
                        class="sort-item flex justify-between items-center  hover:bg-gray-100 cursor-pointer w-full ">
                        <p class=" px-4 py-2 flex justify-start">{{ $product }}</p>
                        <span class="px-3 active-sort-product">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="size-3.5">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                    clip-rule="evenodd" />
                            </svg> --}}

                        </span>

                    </button>
                @endforeach


            </div>
        </div>
    @endsection

    @push('scripts')
        {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
        @vite(['resources/js/sidebar/toggleResponsiveSidebar.js'])
        @vite(['resources/js/shop-product/shopProductList.js'])
        @vite(['resources/js/shop-product/sortProduct.js'])
        @vite(['resources/js/shop-product/getProductCategory.js'])
        @vite(['resources/js/shop-product/product-type/getProductType.js'])
        {{-- @vite(['resources/js/shop-product/product-detail/redirect.js']) --}}
        @vite(['resources/js/shop-product/product-detail/redirect.js'])
        @vite(['resources/js/shop-product/wishlist/addWishlist.js'])
        @vite(['resources/js/shop-product/countFilterNumber/countFilterNumber.js'])


        {{-- @vite(['resources/js/shop-product/setUpFilterEvent.js']) --}}

        {{-- @vite(['resources/js/sidebar/renderShopBrand.js']) --}}
    @endpush
