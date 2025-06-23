@extends('layout.master')
@section('content')
    <div class="min-h-screen bg-gray-50">

        {{-- Main Content --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 p-8">
                {{-- Cart Items --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        {{-- Table Header --}}
                        <div
                            class="grid grid-cols-12 gap-6 pb-4 border-b border-gray-200 text-xs font-medium text-gray-600 uppercase tracking-wider">
                            <div class="col-span-6">Product</div>
                            <div class="col-span-3 text-center">Price</div>
                            <div class="col-span-3 text-center">Total</div>
                        </div>

                        {{-- Demo Cart Items --}}
                        <div class="divide-y divide-gray-100">
                            {{-- Item 1 --}}
                            <div class="flex items-center gap-6 py-6">
                                {{-- Product Image --}}
                                <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="https://via.placeholder.com/100" alt="Product 1"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>

                                {{-- Product Info --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-900 text-lg mb-2">Cool Sneakers</h3>
                                    <div class="flex items-center gap-4 text-sm text-gray-600">
                                        <span>Size: 42</span>

                                    </div>

                                    {{-- Quantity --}}
                                    <div class="flex items-center gap-3 mt-4">
                                        <button
                                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-gray-400 hover:bg-gray-50">−</button>
                                        <span class="w-8 text-center font-medium">2</span>
                                        <button
                                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:border-gray-400 hover:bg-gray-50">＋</button>
                                    </div>

                                    {{-- Remove --}}
                                    <button
                                        class="text-gray-400 hover:text-gray-600 text-sm mt-3 transition-colors">Remove</button>
                                </div>

                                {{-- Price --}}
                                <div class="text-right flex-shrink-0">
                                    <div class="text-sm text-gray-600 mb-1">Price</div>
                                    <div class="space-y-1">
                                        <div class="text-sm text-gray-400 line-through">$120.00</div>
                                        <div class="font-semibold text-gray-900">$100.00</div>
                                    </div>
                                </div>

                                {{-- Total --}}
                                <div class="text-right flex-shrink-0 w-24">
                                    <div class="text-sm text-gray-600 mb-1">Total</div>
                                    <div class="font-semibold text-gray-900">$200.00</div>
                                </div>
                            </div>

                            {{-- Item 2 --}}

                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900 border-b pb-4">Order Summary</h2>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>$230.00</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Shipping</span>
                            <span>$10.00</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Tax</span>
                            <span>$5.00</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between font-semibold text-gray-900">
                            <span>Total</span>
                            <span>$245.00</span>
                        </div>
                        <button
                            class="w-full mt-4 bg-pearl-bush-500 text-white text-sm py-3 rounded-lg hover:bg-pearl-bush-700 cursor-pointer transition">Proceed
                            to Checkout</button>
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
@endpush
