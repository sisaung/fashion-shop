@extends('layout.master')
@section('content')
    <div class="min-h-screen bg-gray-50">

        {{-- Main Content --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
            <div class=" clear-cart-container px-5 absolute">
                <button
                    class="clear-all-btn flex text-stone-500  hover:text-stone-600 hover:underline-offset-4 hover:underline cursor-pointer text-sm px-4 py-2 rounded-full">Clear
                    All</button>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 md:gap-12 gap-12 p-8">

                {{-- Cart Items --}}
                <div class="lg:col-span-2 h-auto  lg:h-screen overflow-y-auto hide-scrollbar">

                    <div class="empty-cart-output">

                    </div>

                    {{-- empty cart --}}
                    <template id="empty-cart-template">
                        <div class="w-full border border-pearl-bush-400 rounded-lg flex justify-center items-center h-72">
                            Your cart is empty
                        </div>
                    </template>
                    <div class="cart-items-header bg-white rounded-2xl shadow-sm  border border-gray-100 p-6">
                        {{-- Table Header --}}

                        <div
                            class=" grid grid-cols-12 gap-6 pb-4 border-b border-gray-200 text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <div class="col-span-6">Product</div>
                            <div class="col-span-3 text-end sm:block hidden">Price</div>
                            <div class="col-span-2 text-end sm:block hidden">Total</div>
                        </div>




                        {{-- Demo Cart Items --}}

                        <template id="cart-item-template">
                            {{-- <div class="flex  gap-6 py-6">

                                <div class="w-20 sm:w-28 bg-gray-50  sm:aspect-square  rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="https://via.placeholder.com/100" alt="Product 1"
                                        class="cart-product-image w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
                                </div>


                                <div class="flex-1 md:flex-row flex-col min-w-0 ">
                                    <h3 class="font-semibold text-gray-900 text-wrap text-base md:text-lg mb-2 cart-product-name">Cool Sneakers
                                    </h3>
                                    <div class="flex sm:flex-row flex-col items-center gap-4 text-sm text-gray-600">
                                        <p>Size: <span class="cart-product-size"></span></p>
                                        <p>Stock: <span class="cart-product-stock"></span></p>

                                    </div>


                                    <div class="flex items-center gap-3 mt-4">
                                        <button
                                            class="cart-decrease-qty w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-gray-400 hover:bg-gray-50">−</button>
                                        <span class="w-8 text-center font-medium cart-quantity-value"></span>
                                        <button
                                            class="cart-increase-qty w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-gray-400 hover:bg-gray-50">＋</button>
                                    </div>


                                    <button
                                        class="cart-item-remove cursor-pointer text-gray-400 hover:text-gray-600 text-sm mt-3 transition-colors">Remove</button>
                                </div>


                                <div class="" >

                                    <div class="space-y-1">
                                        <div class="text-sm text-gray-400 line-through cart-product-sale-price"></div>
                                        <div class="font-semibold text-gray-900 cart-product-display-price"></div>
                                    </div>
                                </div>


                                <div class="text-right  mt-1 ">

                                    <div class="font-semibold  text-gray-900 cart-total"></div>
                                </div>
                            </div> --}}

                            <div class="flex flex-col sm:flex-row gap-6 py-6">
                                {{-- Product Image --}}
                                <div
                                    class="w-20 sm:w-28 bg-gray-50 sm:aspect-square rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="https://via.placeholder.com/100" alt="Product 1"
                                        class="cart-product-image w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
                                </div>

                                {{-- Product Info + Price + Total --}}
                                <div class="flex flex-col sm:flex-row flex-1 gap-4">
                                    {{-- Product Info --}}
                                    <div class="flex-1 min-w-0">
                                        <h3
                                            class="font-semibold text-gray-900 text-wrap text-base md:text-lg mb-2 cart-product-name">
                                            Cool Sneakers
                                        </h3>
                                        <div
                                            class="flex sm:flex-row flex-col items-start sm:items-center gap-4 text-sm text-gray-600">
                                            <p>Size: <span class="cart-product-size"></span></p>
                                            <p>Stock: <span class="cart-product-stock"></span></p>
                                        </div>

                                        {{-- Quantity --}}
                                        <div class="flex items-center gap-3 mt-4">
                                            <button
                                                class="cart-decrease-qty w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-gray-400 hover:bg-gray-50">−</button>
                                            <span class="w-8 text-center font-medium cart-quantity-value"></span>
                                            <button
                                                class="cart-increase-qty w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-gray-400 hover:bg-gray-50">＋</button>
                                        </div>

                                        {{-- Remove --}}
                                        <button
                                            class="cart-item-remove cursor-pointer text-gray-400 hover:text-gray-600 text-sm mt-3 transition-colors">Remove</button>
                                    </div>

                                    {{-- Price --}}
                                    <div class="flex gap-x-3 items-center sm:items-start">
                                        <p class="sm:hidden">Price:</p>
                                        <div class="space-y-1">
                                            <div class="text-sm text-gray-400 line-through cart-product-sale-price"></div>
                                            <div class="font-semibold text-gray-900 cart-product-display-price"></div>
                                        </div>
                                    </div>

                                    {{-- Total --}}
                                    <div class="flex gap-x-3 items-center sm:items-start sm:mt-1 mt-0">
                                        <p class="sm:hidden">Total: </p>
                                        <div class="font-semibold text-gray-900 cart-total"></div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="divide-y divide-gray-100 cart-container">


                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4 summary-container">
                        <h2 class="text-lg font-semibold text-gray-900 border-b pb-4">Order Summary</h2>

                        <div class="summary-output">
                            <!-- JavaScript will render values here -->
                        </div>

                        @auth
                            <a href="{{ route('order-confirmation.index') }}"
                                class="w-full mt-4 block text-center bg-pearl-bush-500 text-white text-sm py-3 rounded-lg hover:bg-pearl-bush-700 cursor-pointer transition">
                                Proceed to Checkout
                            </a>
                        @endauth
                        {{-- @guest
                            <a href="{{ route('login') }}?next={{ route('order-confirmation.index') }}"
                                class="w-full block text-center mt-4 bg-pearl-bush-500 text-white text-sm py-3 rounded-lg hover:bg-pearl-bush-700 cursor-pointer transition px-4">
                                Login to Checkout
                            </a>
                        @endguest --}}
                        @guest
                            <form id="checkout-login-form" action="{{ route('next-and-login') }}" method="POST">
                                @csrf
                                <input type="hidden" name="next" value="{{ route('order-confirmation.index') }}">
                                <button type="submit"
                                    class="w-full block text-center mt-4 bg-pearl-bush-500 text-white text-sm py-3 rounded-lg hover:bg-pearl-bush-700 cursor-pointer transition px-4">
                                    Login to Checkout
                                </button>
                            </form>
                        @endguest
                    </div>
                </div>

                {{-- Template --}}
                <template id="summary-template">
                    <div class="space-y-5">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span class="sub-total">0 MMK</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Shipping</span>
                            <span class="shipping">Free shipping</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Tax</span>
                            <span class="tax">0 MMK</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between font-semibold text-gray-900">
                            <span>Net Total</span>
                            <span class="net-total">0 MMK</span>
                        </div>
                    </div>
                </template>

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

    @vite(['resources/js/cart/cartList.js'])
@endpush
