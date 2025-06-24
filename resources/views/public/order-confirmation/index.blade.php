@extends('layout.master')
@section('content')
    <section>
        <div class="min-h-screen bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <form action="#" method="POST">
                    @csrf
                    <div class="grid lg:grid-cols-3 gap-8">
                        {{-- Left Column --}}
                        <div class="lg:col-span-2 space-y-8">

                            <template id="ordered-product-list-template">
                                <div class="flex gap-4 pb-6">
                                    <div class="w-32 h-40 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="https://images.pexels.com/photos/1043473/pexels-photo-1043473.jpeg?auto=compress&cs=tinysrgb&w=400&h=500&fit=crop"
                                            alt="BOSS Polo Penrose 38" class="w-full h-full object-cover" />
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800 text-lg mb-2">BOSS Polo Penrose 38</h3>
                                        <p class="text-amber-600 text-sm mb-2">🏷️ 58469368 001</p>
                                        <p class="text-xl font-bold text-gray-800 mb-3">550,000 MMK</p>

                                        <div class="flex items-center gap-4 mb-4">
                                            <span
                                                class="bg-amber-50 text-amber-700 px-3 py-1 rounded-full text-sm font-medium">M</span>
                                            <span class="text-green-600 text-sm font-medium">In Stock</span>
                                        </div>

                                        <div class="flex gap-3">
                                            <a href="#"
                                                class="text-gray-500 hover:text-gray-700 text-sm underline transition-colors">
                                                Remove
                                            </a>
                                            <a href="#"
                                                class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                                See More
                                            </a>
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
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path
                                            d="M12 8c1.1 0 2 .9 2 2s-.9 2-2 2m0-4V6m0 6v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                    </svg>
                                    <span class="font-medium text-gray-800">Cash On Delivery</span>
                                </div>
                            </div>

                        </div>

                        {{-- Right Column --}}
                        <div class="space-y-6">

                            {{-- Order Summary --}}
                            <div class="bg-white rounded-lg shadow-sm p-6">
                                <h2 class="text-xl font-semibold text-gray-800 mb-6">Ordered Summary</h2>

                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Total Cost</span>
                                        <span class="font-semibold">550,000 MMK</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Free Shipping</span>
                                        <span class="font-semibold">0 MMK</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Coupon Dis</span>
                                        <span class="font-semibold">- 0 MMK</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <input type="text" name="coupon" placeholder="ENTER COUPON"
                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                        <button type="button"
                                            class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-medium text-sm">
                                            Apply
                                        </button>
                                    </div>
                                    <hr class="my-4" />
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>Net Total Cost</span>
                                        <span>550,000 MMK</span>
                                    </div>
                                </div>
                            </div>

                            {{-- More Information --}}
                            <div class="bg-white rounded-lg shadow-sm p-6">
                                <h2 class="text-xl font-semibold text-gray-800 mb-6">More Information</h2>

                                <div class="space-y-6">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-3">Shipping & Delivery</h3>
                                        <ul class="space-y-2 text-sm text-gray-600">
                                            <li>• We offer home delivery to all locations in Myanmar.</li>
                                            <li>• Delivery times will be within 2 days.</li>
                                            <li>• Delivery costs will be free of charge.</li>
                                            <li>• Delays may occur due to unforeseen circumstances.</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-3">Returns & Refunds</h3>
                                        <ul class="space-y-2 text-sm text-gray-600">
                                            <li>• We accept exchanges within one week of purchase for unused items in
                                                original condition if the sizes are not fitted.</li>
                                            <li>• The right-sized item will be re-delivered with delivery charges.</li>
                                            <li>• Refunds will not be paid.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

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

                </form>
            </div>
        </div>

    </section>
@endsection
@push('scripts')

@endpush
