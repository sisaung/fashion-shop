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
            <div>

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

        <div class="flex justify-center items-center pb-10">
            @include('components.public.pagination', ['paginator' => $products])
        </div>
    @endsection

    @push('scripts')
        @vite(['resources/js/shop-product/shopProductList.js'])
        @vite(['resources/js/shop-product/sortProduct.js'])
        {{-- @vite(['resources/js/sidebar/renderShopBrand.js']) --}}
    @endpush
