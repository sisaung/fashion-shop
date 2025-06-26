@extends('layout.master')
@section('content')
    <section>
        <div class="min-h-screen bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 py-8">
                {{-- <form action="#" method="POST">
                    @csrf --}}
                <div class="grid lg:grid-cols-3 gap-8">
                    {{-- Left Column --}}
                    <div class="lg:col-span-2 space-y-8 h-screen overflow-y-auto hide-scrollbar">

                        <template id="ordered-product-list-template">
                            <div class="flex gap-4 pb-6">
                                <div
                                    class="w-30 h-30 border border-pearl-bush-300  bg-red-500 rounded-lg overflow-hidden flex-shrink-0">
                                    <img class="ordered-product-image" alt="BOSS Polo Penrose 38"
                                        class="w-full h-full object-cover" />
                                </div>

                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800 text-lg mb-2 ordered-product-name "></h3>
                                    <p class="text-amber-600 text-sm mb-2 ordered-product-code"></p>
                                    <p class="text-sm text-gray-400 mb-3 ordered-product-sale-price line-through">
                                    </p>

                                    <p class=" text-gray-700 mb-3 ordered-product-display-price">
                                    </p>

                                    <div class="flex items-center gap-4 mb-4">
                                        <span
                                            class="bg-amber-50 text-amber-700 px-3 py-1 rounded-full text-sm font-medium ordered-product-size ">
                                            Size: </span>
                                        <span class="text-bearl-bush-500 text-sm font-medium ordered-quantity-value">
                                            Qty:</span>
                                    </div>

                                    <div class="flex gap-3">
                                        <button type="button"
                                            class="ordered-product-remove text-gray-500 hover:text-gray-700 text-sm underline transition-colors">
                                            Remove
                                        </button>
                                        <button type="button"
                                            class="redirect-to-detail bg-pearl-bush-400 hover:bg-pearl-bush-600 text-white px-4 py-2 rounded-full cursor-pointer  font-medium transition-colors text-xs">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        {{-- Ordered Products List --}}
                        <div class="bg-white rounded-lg shadow-sm p-6 ordered-products-list-container">
                            <h2 class="font-heading text-gray-700 text-lg mb-6">Ordered Products List</h2>

                        </div>


                        {{-- Delivery Info --}}
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Delivery Information</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <input type="text" name="full_name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <input type="email" name="email"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                        <input type="tel" name="phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                        <input type="text" name="city"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Township</label>
                                        <input type="text" name="township"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Address</label>
                                    <textarea name="address" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500"></textarea>
                                </div>

                                <div class="flex items-center gap-2 pt-2">
                                    <input type="checkbox" name="set_default" id="set_default"
                                        class="w-4 h-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                                    <label for="set_default" class="text-sm text-gray-700">Set as default
                                        address</label>
                                </div>

                                <button type="submit"
                                    class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                    Save Information
                                </button>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Payment Methods</h2>
                            <div class="border border-gray-200 rounded-lg p-4 bg-amber-50 flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 8c1.1 0 2 .9 2 2s-.9 2-2 2m0-4V6m0 6v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                </svg>
                                <span class="font-medium text-gray-800">Cash On Delivery</span>
                            </div>
                        </div>

                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-4">
                        <div class=" rounded-2xl bg-white shadow-sm  p-6 space-y-4 summary-container">
                            <h2 class="text-lg font-semibold text-gray-900 border-b pb-4">Order Summary</h2>


                            <div class="summary-output">

                                <!-- JavaScript will render values here -->
                            </div>

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
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>Coupon Discount</span>
                                        <span class="coupon-discount">0 MMK</span>
                                    </div>
                                    <div class="flex gap-x-3 items-center">
                                        <input type="text" id="coupon_code" name="coupon_code"
                                            class="w-full coupon_code bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out ps-5 placeholder:text-gray-400 placeholder:text-sm"
                                            placeholder="Enter Coupon">
                                        <button
                                        disabled
                                            class="pointer-events-none disabled:opacity-50 text-white bg-pearl-bush-500 border-0 py-2.5 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-xs cursor-pointer duration-300 coupon-apply-btn">Apply</button>
                                    </div>
                                    <div class="border-t pt-4 flex justify-between font-semibold text-gray-900">
                                        <span>Net Total</span>
                                        <span class="net-total">0 MMK</span>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>

                    {{-- Bottom Actions - Sticky --}}
                    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-md px-4 py-4 z-50">
                        <div class="max-w-7xl mx-auto flex justify-between items-center">
                            <a href="#"
                                class="flex items-center gap-2 text-amber-600 hover:text-amber-700 font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M15 19l-7-7 7-7" />
                                </svg>
                                Back to shop
                            </a>

                            <button type="submit"
                                class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-md hover:shadow-lg">
                                Confirm Order
                            </button>
                        </div>
                    </div>

                    {{-- </form> --}}
                </div>
            </div>

    </section>
@endsection
@push('scripts')
    @vite(['resources/js/order-confirmation/orderConfirmationList.js'])
    @vite(['resources/js/order-confirmation/applyCoupon.js'])

@endpush
