@extends('layout.master')
@section('content')
    <div class="min-h-screen bg-white">

        {{-- Main Content --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Product Image (static) --}}
                <div class="space-y-4">
                    <div
                        class="relative group border border-pearl-bush-300 bg-gray-100 rounded-2xl overflow-hidden aspect-square">
                        @if ($product->productImages->count())
                            <img src="{{ $product->productImages->first()->large }}"
                                alt="{{ $product->productImages->first()->original_name }}"
                                class="w-full h-full object-cover object-center">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949"
                                alt="" class="w-full h-full object-cover object-center">
                        @endif
                    </div>

                    <div class="grid grid-cols-4 gap-4">

                        @if ($product->productImages->count())
                            @foreach ($product->productImages->skip(1) as $image)
                                <div class="aspect-square  border border-pearl-bush-300 rounded-xl overflow-hidden">
                                    <img src="{{ $image->preview }}" alt="{{ $image->original_name }}"
                                        class="w-full  h-full object-cover object-center">
                                </div>
                            @endforeach
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949"
                                alt="" class="w-full h-full object-cover object-center">
                        @endif

                    </div>
                </div>

                {{-- Product Info --}}
                <div class="space-y-8">
                    @include('components.breadcrumb', [
                        'currentPageTitle' => 'Product Detail',
                        'links' => [['name' => 'Shop', 'path' => route('shop.index')]],
                    ])
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2"> {{ $product->product_name }} </h1>
                        <div class="flex items-center space-x-4 mb-4">

                            {{-- rating --}}
                            {{-- <div class="flex items-center space-x-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400 fill-yellow-400"><!-- Star SVG --></svg>
                                @endfor
                            </div>
                            <span class="text-gray-600">(128 reviews)</span> --}}
                        </div>
                        <div class="flex items-center space-x-2 mb-6">
                            <span
                                class="bg-pearl-bush-100 text-pearl-bush-600 px-2.5 py-1 rounded-full text-xs font-medium">Product
                                Code</span>
                            <span class="text-gray-600 text-sm"> {{ $product->product_code }} </span>
                        </div>
                    </div>


                    {{-- Tags --}}
                    <div class="flex flex-wrap gap-2">

                        <span
                            class="bg-pearl-bush-400 text-white text-xs px-3 py-1 rounded-full  font-medium">{{ $product->brand->brand_name }}</span>

                        <span
                            class="bg-pearl-bush-400 text-white text-xs px-3 py-1 rounded-full  font-medium">{{ $product->gender }}</span>

                        <span
                            class="bg-pearl-bush-400 text-white text-xs px-3 py-1 rounded-full  font-medium">{{ $product->productCategory->category_name }}</span>

                        <span
                            class="bg-pearl-bush-400 text-white text-xs px-3 py-1 rounded-full  font-medium">{{ $product->productType->name }}</span>

                        @if ($product->fit)
                            <span
                                class="bg-pearl-bush-400 text-white text-xs px-3 py-1 rounded-full  font-medium">{{ $product->fit->fit_name }}</span>
                        @endif
                    </div>

                    {{-- Price --}}
                    <div class="space-y-2">
                        <div class="text-xl text-gray-800 space-x-2 ">

                            @if ($product->discount_percentage > 0)
                                <span class="line-through text-gray-500"> {{ $product->sale_price }} MMK </span>
                                <span> {{ $product->display_price }} MMK </span>

                            @else
                                <span> {{ $product->sale_price }} MMK </span>
                            @endif
                        </div>
                        {{-- <div class="text-gray-600">Free shipping on orders over 300,000 MMK</div> --}}
                    </div>

                    {{-- Size (static buttons) --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-gray-700 font-heading">Select Your Size</h3>
                            <span class="text-amber-600 text-sm  hover:text-amber-700  font-medium">Size Guide</span>
                        </div>


                        <div id="sizeButtons" class="flex flex-wrap items-center gap-3">
                            @if ($product->stocks->count())
                                @foreach ($product->stocks as $productStock)
                                    @php
                                        $isOutOfStock = $productStock->stock_quantity == 0;
                                    @endphp

                                    <button {{ $isOutOfStock ? 'disabled' : '' }}
                                        class="size-btn relative rounded-lg px-4 py-2 border text-xs font-medium
                                           {{ $isOutOfStock
                                               ? 'border-gray-300 text-gray-400 bg-gray-100 '
                                               : 'text-pearl-bush-700 border-pearl-bush-400 hover:border-pearl-bush-300 hover:bg-pearl-bush-50 cursor-pointer' }}"
                                        data-size="{{ $productStock->size->size_name }}"
                                        data-stock="{{ $productStock->stock_quantity }}">
                                        {{ $productStock->size->size_name }}

                                        {{-- Slash Cross for Out of Stock --}}
                                        @if ($isOutOfStock)
                                            <span class="absolute w-full h-full left-0 top-0 pointer-events-none">
                                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                                    <line x1="0" y1="100" x2="100" y2="0"
                                                        stroke="#d1d5db" stroke-width="5" />
                                                </svg>
                                            </span>
                                        @endif
                                        {{-- <span
                                            class="selected-size-check border-pearl-bush-400 hidden  absolute top-0 right-0 -translate-y-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-5 fill-pearl-bush-500 stroke-white ">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>



                                        </span> --}}
                                    </button>
                                @endforeach
                            @endif

                        </div>

                    </div>


                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">Quantity</h3>
                        <div class="flex items-center border border-gray-300 rounded-lg w-fit">
                            <button id="decreaseQty" class="cursor-pointer p-2 hover:bg-gray-50 text-gray-600">−</button>
                            <span id="quantityValue" class="px-4 py-2 font-medium">1</span>
                            <button id="increaseQty" class="cursor-pointer p-2 hover:bg-gray-50 text-gray-600">+</button>
                        </div>
                        <div>
                            <p id="stockInfo" class="text-sm text-gray-500">Please select a size to see stock info.</p>
                            <p id="errorMsg" class="text-sm text-red-500 hidden">Please select a size before changing
                                quantity.
                            </p>
                        </div>
                    </div>


                    {{-- Buttons --}}
                    <div class="flex items-center gap-3">
                        <button
                        data-product="{{ $product }}"

                            class="add-to-cart-btn cursor-pointer bg-pearl-bush-500 hover:bg-pearl-bush-700 text-white py-2.5  rounded-full px-5 text-sm gap-x-3  inline-flex items-center justify-center transition duration-300 ">
                            <span>Add to Cart</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>


                        </button>
                        <button
                            class="cursor-pointer font-semibold text-gray-700 py-2  rounded-lg px-4 gap-x-1.5  inline-flex items-center justify-center transition duration-300 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 stroke-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>

                            <span>Add to Wishlist</span>


                        </button>
                    </div>


                    {{-- Features --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-8 border-t border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600"><!-- Truck Icon --></svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Free Shipping</div>
                                <div class="text-sm text-gray-600">Orders over 300K MMK</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600"><!-- Shield Icon --></svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Secure Payment</div>
                                <div class="text-sm text-gray-600">100% protected</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600"><!-- Return Icon --></svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Easy Returns</div>
                                <div class="text-sm text-gray-600">30 days policy</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="mt-16 max-w-4xl">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Product Description</h2>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3"> {{ $product->product_name }} -
                            {{ $product->product_code }} </h3>
                        <p class="text-gray-700 leading-relaxed">

                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Key Features</h4>
                            <ul class="space-y-2 text-gray-700 list-disc list-inside">
                                <li>Slim fit</li>
                                <li>Flat-knit collar</li>
                                <li>Number of buttons: 2</li>
                                <li>Short sleeves</li>
                                <li>No cuffs</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Material & Care</h4>
                            <ul class="space-y-2 text-gray-700 list-disc list-inside">
                                <li>100% Mercerised Cotton</li>
                                <li>Machine wash cold</li>
                                <li>Do not bleach</li>
                                <li>Tumble dry low</li>
                                <li>Iron on medium heat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/shop-product/shopProductList.js'])
        @vite(['resources/js/shop-product/sortProduct.js'])
        @vite(['resources/js/shop-product/getProductCategory.js'])
        @vite(['resources/js/shop-product/product-type/getProductType.js'])
        --}}

    @vite(['resources/js/shop-product/product-detail/addToCart.js'])
@endpush
