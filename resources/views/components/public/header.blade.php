<header>
    <div class="bg-white shadow border-pearl-bush-400  sticky top-0 left-0 w-full">
        <div class="max-w-7xl mx-auto flex justify-between items-center h-18">
            <a href="{{ url('/') }}" class="flex items-center gap-x-3">
                <p>logo</p>
                <div class="flex flex-col ">
                    <h1 class="text-2xl font-medium text-gray-700 font-heading uppercase">
                        Fashion Shop
                    </h1>

                </div>
            </a>
            {{-- main menu item  --}}
            <div class="flex gap-x-7">
                <a href="{{ route('shop.index') }}"
                    class="text-gray-700 hover:text-black font-medium transition-colors text-sm">
                    Shop</a>
                <a href="{{ route('shop.index', ['item' => 'new_arrival']) }}"
                    class="text-gray-700 hover:text-black font-medium transition-colors text-sm">New
                    Arrival</a>

                <a href="{{ route('shop.index', ['gender' => 'male']) }}"
                    class="text-gray-700 hover:text-black font-medium transition-colors text-sm">Men</a>

                <a href="{{ route('shop.index', ['gender' => 'female']) }}"
                    class="text-gray-700 hover:text-black font-medium transition-colors text-sm">Women</a>
                <a href="{{ route('shop.index', ['gender' => 'unisex']) }}"
                    class="text-gray-700 hover:text-black font-medium transition-colors text-sm">Unisex</a>

            </div>


            <div class="flex items-center gap-x-3">
                <button data-modal-target="small-modal-1" data-modal-toggle="small-modal-1"
                    class="hover:border cursor-pointer  inline-flex justify-center items-center hover:border-pearl-bush-400 rounded-full size-10 ">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </span>
                </button>


                <a href="{{ route('wishlist.showWishlistShow') }}"
                    class="hover:border relative  inline-flex justify-center items-center hover:border-pearl-bush-400 rounded-full size-10 ">
                    <p>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                    </p>
                    <p class="hidden wishlist-count">
                        <span
                            class="bg-red-500 text-xs text-white absolute top-0 right-0 rounded-full px-1  inline-flex justify-center items-center border border-white translate-y-1/3 -translate-x-1 total-wishlist-count"></span>
                    </p>
                </a>

                <a href="{{ route('cart.index') }}"
                    class="hover:border  inline-flex justify-center items-center hover:border-pearl-bush-400 rounded-full size-10 ">
                    <div class="cart-header relative inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <p class="hidden cart-items">
                            <span
                                class="absolute top-0 right-0 translate-x-1/3 -translate-y-1/3 border border-white  bg-red-500 text-xs size-4 rounded-full inline-flex justify-center items-center text-white total-cart-items">
                                1 </span>
                        </p>

                    </div>
                </a>

                {{-- account and dashboard --}}
                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="cursor-pointer "
                        type="button" class="inline-flex  justify-center items-center">
                        @auth
                            @if (Auth::user()->profile_image)
                                <span
                                    class="inline-flex justify-center items-center size-10  border border-pearl-bush-300 rounded-full overflow-hidden">
                                    <img src="{{ Auth::user()->profile_image }}" alt="avatar" />
                                </span>
                            @else
                                <span
                                    class="inline-flex  justify-center items-center size-10 border border-pearl-bush-300 rounded-full overflow-hidden">

                                    <img src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1"
                                        alt="placeholder" class="size-8 object-center object-cover rounded-full">
                                </span>
                            @endif
                        @endauth
                        @guest
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        @endguest
                    </button>
                </div>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        @auth
                            @if (Auth::user()->is_admin === 'admin')
                                <li>
                                    <a href="{{ route('dashboard.index') }}"
                                        class="block px-4 py-2  hover:bg-stone-100 hover:text-stone-600">Dasboard</a>
                                </li>
                            @else
                                <li class="hover:bg-stone-100 hover:text-stone-600 px-2 py-2">
                                    <a href="{{ route('account.showProfileInformation') }}"
                                        class="text-nowrap inline-flex items-center px-2 gap-x-2 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>

                                        Profile
                                    </a>
                                </li>
                                <li class="hover:bg-stone-100 hover:text-stone-600 px-2 py-2">
                                    <a href="{{ route('account.orders') }}" class="inline-flex items-center gap-x-2 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                        </svg>

                                        Your Orders
                                    </a>
                                </li>
                                <li>
                                    <form class="block hover:bg-stone-100 hover:text-stone-600"
                                        action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="gap-x-2 py-2 inline-flex items-center px-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                            </svg>
                                            Logout</button>
                                    </form>
                                </li>
                            @endif

                        @endauth
                        @guest
                            <li>
                                <a href="{{ route('login') }}"
                                    class="block px-4 py-2  hover:bg-stone-100 hover:text-stone-600">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}"
                                    class="block px-4 py-2  hover:bg-stone-100 hover:text-stone-600">Register</a>
                            </li>
                        @endguest

                    </ul>
                </div>

            </div>

        </div>

    </div>

    <div id="small-modal-1" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto  max-h-full ">
        {{-- md:inset-0 h-[calc(100%-1rem)] --}}
        <div class="relative w-full max-w-xl max-h-full ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:px-5 py-3">
                    <h3 class=" font-heading font-medium text-stone-700 ">
                        Search Products
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm size-8 ms-auto inline-flex justify-center items-center "
                        data-modal-hide="small-modal-1">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->

                <div class="px-5 mb-5">
                    <input type="text" id="search-product" name="search-product"
                        class="w-full bg-white rounded border border-pearl-bush-400 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-400 text-base outline-none text-gray-700 py-1 ps-5 px-3 placeholder:text-sm placeholder:text-gray-400 leading-8 transition-colors duration-200 ease-in-out"
                        placeholder="Search products">

                </div>

                <h1 class="px-5 text-stone-700 font-heading header-search-result font-medium mb-5">
                    Your search results
                </h1>
                <div class="px-5 search-product-result-container">

                </div>



                <template id="search-product-template">
                    <div class="space-y-4">
                        <div
                            class="search-product-item flex border border-transparent items-center gap-3 hover:border-pearl-bush-500 hover:rounded-md hover:bg-pearl-bush-50 hover:cursor-pointer hover:scale-[102%] active:scale-95 duration-500  ">
                            <div>
                                <img class="search-product-image size-16  object-top object-cover rounded-md">
                            </div>
                            <div class="space-y-1.5">
                                <p class="search-product-name font-heading text-stone-600"> </p>
                                <div class="flex items-center gap-x-1">
                                    <p
                                        class="search-brand-name bg-pearl-bush-100 text-pearl-bush-800 py-1 px-3 text-xs rounded-full">
                                    </p>
                                    <p
                                        class="search-product-type bg-pearl-bush-100 text-pearl-bush-800 py-1 px-3 text-xs rounded-full">
                                    </p>

                                </div>
                            </div>
                        </div>


                    </div>
                </template>

                <template id="empty-search-product-template">
                    <div
                        class="rounded-md text-center py-10 text-stone-700 text-sm header-search-result font-medium bg-stone-100 ">
                        There is no product...
                    </div>
                </template>

                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 ">
                    <button data-modal-hide="small-modal-1" type="submit"
                        class="hidden search-result-btn text-sm w-full font-medium bg-pearl-bush-400 text-white py-3 px-4 rounded-full cursor-pointer focus:ring-2 focus:ring-pearl-bush-500  hover:bg-pearl-bush-500 duration-300">
                    </button>

                </div>

                {{-- --------- --}}
            </div>
        </div>
    </div>

</header>

@push('scripts')
    {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
    @vite(['resources/js/shop-product/search/searchProduct.js'])
    @vite(['resources/js/cart/cartHeader.js'])
    @vite(['resources/js/wishlist/wishListHeader.js'])
@endpush
