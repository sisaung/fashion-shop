@extends('layout.master')
@section('content')
    <section>

        {{-- toast success --}}

        <div id="toast-success"
            class="transition fixed top-5  left-1/2 -translate-x-1/2  ease-out  transform opacity-0 -translate-y-10  duration-500">
            <div id="toast-success" class=" max-w-sm mx-auto bg-white border border-gray-200 rounded-xl shadow-lg  "
                role="alert" tabindex="-1" aria-labelledby="hs-toast-success-example-label">
                <div class="flex p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                            </path>
                        </svg>
                    </div>
                    <div class="ms-3">
                        <p id="hs-toast-success-example-label" class="text-sm text-gray-700 ">
                            <span id="toast-success-message"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- toast error --}}

        <div id="toast-error"
            class="transition fixed top-5 z-50 left-1/2 -translate-x-1/2  ease-out  transform opacity-0 -translate-y-10  duration-500">
            <div class="max-w-sm  mx-auto bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg  " role="alert"
                tabindex="-1" aria-labelledby="hs-toast-soft-color-red-label">
                <div id="hs-toast-soft-color-red-label" class="flex p-4">
                    <span id="toast-error-message">San tar</span>

                    <div class="ms-auto">
                        <button type="button"
                            class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-red-800 opacity-50 hover:opacity-100 focus:outline-hidden focus:opacity-100 "
                            aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="min-h-screen overflow-y-scroll hide-scrollbar pb-14">
            <div class="max-w-7xl mx-auto py-8 px-5">
                {{-- current user --}}
                <input type="hidden" name="user" value="{{ auth()->user() }}" class="current-user">
                {{-- <form action="#" method="POST">
                    @csrf --}}
                <div class="grid lg:grid-cols-3 gap-8 px:5">
                    {{-- Left Column --}}
                    <div class="lg:col-span-2  space-y-8 h-auto lg:h-screen overflow-y-auto hide-scrollbar">

                        <template id="ordered-product-list-template">
                            <div class="flex gap-4 pb-6">
                                <div
                                    class="w-30 flex justify-center items-center bg-black/4 border border-pearl-bush-300  rounded-lg overflow-hidden">
                                    <img class="ordered-product-image" alt="BOSS Polo Penrose 38"
                                        class="w-42 aspect-square object-cover object-center" />
                                </div>

                                <div class="flex-1">
                                    <h3
                                        class="font-medium text-gray-800 font-heading md:text-lg mb-2 max-[375px]:line-clamp-1 ordered-product-name ">
                                    </h3>
                                    <p class="text-amber-600 text-sm mb-2 ordered-product-code max-[375px]:line-clamp-1">
                                    </p>
                                    <p class="text-sm text-gray-400 ordered-product-sale-price line-through">
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
                                            class="ordered-product-remove text-gray-500 max-[375px]:text-xs hover:text-gray-700 text-sm underline transition-colors">
                                            Remove
                                        </button>
                                        <button type="button"
                                            class="redirect-to-detail text-nowrap bg-pearl-bush-400 hover:bg-pearl-bush-600 text-white px-4 py-2 rounded-full cursor-pointer  font-medium transition-colors text-xs">
                                            See More
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- Ordered Products List --}}
                        <h2 class="font-heading text-gray-700 mb-3">Ordered Products List</h2>
                        <div class="bg-white  rounded-lg   ordered-products-list-container">

                        </div>

                        {{-- empty card --}}

                        <template id="empty-cart-template">
                            <div class="w-full flex justify-center items-center py-20">
                                Your cart is empty
                            </div>
                        </template>


                        {{-- Delivery Info --}}
                        <div class="bg-white rounded-lg ">
                            <h2 class="text-gray-600 font-heading mb-3">Delivery Information</h2>
                            <div class="space-y-4">


                                <div class="delivery-address-container space-y-4">
                                    @if (Auth::check() && Auth::user()->address->count() > 0)
                                        @foreach (Auth::user()->address as $address)
                                            <div data-address-id="{{ $address->id }}"
                                                class="border border-pearl-bush-300 rounded-lg px-6 py-4 select-address active:scale-80 duration-300 ">
                                                <div class="mb-3">
                                                    <div class="flex justify-between items-center">
                                                        <h3 class="font-heading font-semibold"> Customer Contact </h3>
                                                        <div class="relative">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-10 stroke-pearl-bush-500 stroke-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
                                                            </svg>

                                                            {{-- check --}}
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-5 absolute top-0 left-0 translate-x-1/2 translate-y-1/2 stroke-pearl-bush-500 stroke-3 hidden select-check-icon">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m4.5 12.75 6 6 9-13.5" />
                                                            </svg>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex sm:flex-row flex-col items-start sm:items-center gap-3 sm:gap-5 ">
                                                        <div class="flex items-center gap-x-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-5 text-pearl-bush-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>

                                                            @if ($address->name)
                                                                <p class="text-sm shipping-address-name">
                                                                    {{ $address->name }} </p>
                                                            @else
                                                                <p class="text-sm shipping-address-name">
                                                                    {{ Auth::user()->name }} </p>
                                                            @endif

                                                        </div>
                                                        <div class="flex items-center gap-x-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-5 text-pearl-bush-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                                            </svg>

                                                            <p class="text-sm"> {{ Auth::user()->email }} </p>
                                                        </div>
                                                        <div class="flex items-center gap-x-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-5 text-pearl-bush-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                                            </svg>

                                                            <p class="text-sm"> {{ $address->phone_number }} </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <h1 class="font-heading font-semibold"> Shipping Address </h1>
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-5 text-pearl-bush-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                        </svg>

                                                        <p class="text-sm"> {{ $address->address_detail }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <a href="{{ route('account.goToManageAddress') }}"
                                            class="py-1 px-3 text-xs font-medium text-pearl-bush-400 bg-white rounded-lg border border-pearl-bush-400 hover:bg-pearl-bush-50 focus:z-10 focus:ring-1">
                                            Manage Address</a>
                                    @else
                                        <form method="POST" class="space-y-5" action="{{ route('address.store') }}">
                                            @csrf
                                            <div class="grid md:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="name" id="name"
                                                        class="@error('name')
                                                    text-red-500
                                                        @enderror leading-7 text-sm text-gray-600">Full
                                                        Name</label>
                                                    <input type="text" name="name" id="name"
                                                        class="@error('name')

                                                    is-invalid
                                                @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @error('name')
                                                        <p class="text-sm text-red-500"> {{ $message }} </p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label id="phone_number"
                                                        class="@error('phone_number')
                                                    text-red-500
                                                        @enderror leading-7 text-sm text-gray-600">Phone
                                                        Number</label>
                                                    <input type="text" name="phone_number"
                                                        class="@error('phone_number')
                                                    is-invalid
                                                @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @error('phone_number')
                                                        <p class="text-sm text-red-500"> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="grid md:grid-cols-2 gap-4">
                                                <div>
                                                    <label el for="city"
                                                        class="@error('city')
                        text-red-500
                    @enderror leading-7 text-sm text-gray-600">City</label>
                                                    <input type="text" name="city"
                                                        class="@error('city')
                                                    is-invalid
                                                @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @error('city')
                                                        <p class="text-sm text-red-500"> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label
                                                        class="@error('township')
                                                    text-red-500
                                                @enderror leading-7 text-sm text-gray-600">Township</label>
                                                    <input type="text" name="township"
                                                        class="@error('township')
                                                    is-invalid
                                                @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @error('township')
                                                        <p class="text-sm text-red-500"> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div>
                                                <label
                                                    class="@error('address_detail')
                                                text-red-500
                                            @enderror leading-7 text-sm text-gray-600">Full
                                                    Address</label>
                                                <textarea name="address_detail" rows="4"
                                                    class="@error('address_detail')

                                                is-invalid
                                            @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                                @error('address_detail')
                                                    <p class="text-sm text-red-500"> {{ $message }} </p>
                                                @enderror
                                            </div>



                                            <div class="flex items-center gap-2 pt-2">
                                                <input name="set_default" disabled checked type="checkbox"
                                                    id="set_default"
                                                    class="w-4 h-4 text-pearl-bush-600 focus:ring-pearl-bush-500 border-gray-300 rounded">
                                                <label for="set_default" class="text-sm text-gray-700">Set as default
                                                    address</label>
                                            </div>

                                            <button type="submit"
                                                class="bg-pearl-bush-500 hover:bg-pearl-bush-600 text-white px-6 py-3 text-sm cursor-pointer rounded-lg font-medium transition-colors">
                                                Save Information
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="bg-white rounded-lg  py-6">
                            <h2 class="text-gray-600 mb-3 font-heading font-medium">Payment Method</h2>
                            <div class="border border-pearl-bush-400 rounded-lg p-4 flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-pearl-bush-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                <span class="font-medium text-gray-700">Cash On Delivery</span>
                            </div>
                        </div>

                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-4">
                        <div class=" rounded-2xl bg-white  xl:px-6 py-6 space-y-4 summary-container">
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
                                        <input type="hidden" class="coupon-id">
                                        <input type="text" id="coupon_code" name="coupon_code"
                                            class="w-full coupon_code bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out ps-5 placeholder:text-gray-400 placeholder:text-sm"
                                            placeholder="Enter Coupon">
                                        <button disabled
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
                            <a href="{{ route('shop.index') }}"
                                class="flex items-center gap-2 text-pearl-bush-400 hover:text-pearl-bush-600 font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M15 19l-7-7 7-7" />
                                </svg>
                                Back to shop
                            </a>

                            <button
                                class="confirm-order bg-pearl-bush-400 hover:bg-pearl-bush-600 text-white px-5 cursor-pointer py-3 rounded-lg text-sm transition-colors shadow-md hover:shadow-lg">
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
    @vite(['resources/js/order-confirmation/deliveryInformation.js'])
    @vite(['resources/js/order-confirmation/confirmOrder.js'])
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        // Show success messages
        @if (session('success'))
            Toastify({
                text: @json(session('success')),
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                style: {
                    background: "#ecfdf3",
                    fontSize: "14px",
                    color: "#008a2e",
                    display: "flex",
                    alignItems: "center",
                    gap: "5px",
                },
                avatar: "/icons/check.png",
            }).showToast();
        @endif
    </script>
@endpush
