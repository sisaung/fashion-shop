{{-- <div class="w-1/4 flex flex-col h-screen bg-white gap-5 shadow">

    <h1 class="text-center font-heading text-xl my-5"> Fashion Shop </h1>

    <div class="px-5 flex flex-col gap-5">
        <a class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span>Dashboard</span>


        </a>
        <a href="{{ route('brand.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
            </svg>


            <span>Brand</span>
        </a>

        <a href="{{ route('product.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Product</span>
        </a>

        <a href="{{ route('product-category.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Product Category</span>
        </a>

        <a href="{{ route('product-type.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Product Type</span>
        </a>

         <a href="{{ route('fit.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Fitting</span>
        </a>

         <a href="{{ route('size.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Sizing</span>
        </a>

        <a href="{{ route('coupon.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Coupon</span>
        </a>

        <a href="{{ route('customer.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Customer</span>
        </a>

        <a href="{{ route('order.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Order</span>
        </a>

        <a href="{{ route('review.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Review</span>
        </a>

        <a href="{{ route('wishlist.index') }}" class="flex gap-x-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
            </svg>
            <span>Wishlist</span>
        </a>

    </div>

    <div class="mt-auto border-t  border-pearl-bush-100 p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="cursor-pointer hover:bg-pearl-bush-500 hover:text-white duration-300 inline-flex justify-center items-center gap-x-1 border border-pearl-bush-200 rounded-md text-stone-600 py-2 px-4">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>

                Logout
            </button>
        </form>
    </div>

</div> --}}

@php
    // Define route groups for dropdowns
    $inventoryRoutes = [
        'brand.*',
        'product.*',
        'product-category.*',
        'product-type.*',
        'size.*',
        'fit.*',
        'stock-analysis.*',
    ];
    $customerRoutes = ['customer.*', 'wishlist.*', 'review.*'];
    $orderRoutes = ['order.*', 'coupon.*'];
    $reportRoutes = ['report.sale.*', 'report.order.*', 'report.customer.*'];


    function isDropdownOpen(array $routes)
    {
        foreach ($routes as $route) {
            if (Request::routeIs($route)) {
                return true;
            }
        }
        return false;
    }

    $inventoryOpen = isDropdownOpen($inventoryRoutes);
    $customerOpen = isDropdownOpen($customerRoutes);
    $orderOpen = isDropdownOpen($orderRoutes);
    $reportOpen = isDropdownOpen($reportRoutes);

@endphp

<aside class="w-64 h-screen bg-white flex flex-col flex-shrink-0 overflow-y-auto">
    <h1 class="p-4 text-xl font-heading font-bold py-4 text-center">ＬＵＸＥ</h1>


    <nav class="px-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ url('/dashboard') }}"
            class="block px-4 py-2 text-sm rounded duration-500 {{ Request::routeIs('dashboard.index') ? ' bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
            <span class="inline-flex items-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard">
                    <rect width="7" height="9" x="3" y="3" rx="1" />
                    <rect width="7" height="5" x="14" y="3" rx="1" />
                    <rect width="7" height="9" x="14" y="12" rx="1" />
                    <rect width="7" height="5" x="3" y="16" rx="1" />
                </svg>
                Dashboard
            </span>
        </a>

        <!-- Inventory Dropdown -->
        <div>
            <button type="button"
                class="flex cursor-pointer items-center justify-between w-full px-4 py-2 rounded hover:bg-stone-100 hover:text-pearl-bush-700 text-sm duration-500 focus:outline-none"
                onclick="toggleDropdown('inventoryDropdown')">


                <span class="inline-flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 stroke-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                    </svg> Inventory </span>
                <svg class="w-4 h-4 transition-transform {{ $inventoryOpen ? 'rotate-180' : '' }}"
                    id="arrow-inventoryDropdown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="inventoryDropdown" class="ml-6 mt-1 space-y-1 {{ $inventoryOpen ? '' : 'hidden' }}">
                <a href="{{ route('brand.index') }}"
                    class="block px-4 py-2 text-sm rounded duration-500 {{ Request::routeIs('brand.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>

                        Brand
                    </span>
                </a>
                <a href="{{ route('product.index') }}"
                    class="block px-4 py-2 rounded  text-sm duration-500 {{ Request::routeIs('product.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-boxes-icon lucide-boxes">
                            <path
                                d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z" />
                            <path d="m7 16.5-4.74-2.85" />
                            <path d="m7 16.5 5-3" />
                            <path d="M7 16.5v5.17" />
                            <path
                                d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z" />
                            <path d="m17 16.5-5-3" />
                            <path d="m17 16.5 4.74-2.85" />
                            <path d="M17 16.5v5.17" />
                            <path
                                d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0l-3 1.8Z" />
                            <path d="M12 8 7.26 5.15" />
                            <path d="m12 8 4.74-2.85" />
                            <path d="M12 13.5V8" />
                        </svg>

                        Product
                    </span>
                </a>
                <a href="{{ route('product-category.index') }}"
                    class="block px-4 py-2 text-sm rounded  duration-500 {{ Request::routeIs('product-category.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-group-icon lucide-group">
                            <path d="M3 7V5c0-1.1.9-2 2-2h2" />
                            <path d="M17 3h2c1.1 0 2 .9 2 2v2" />
                            <path d="M21 17v2c0 1.1-.9 2-2 2h-2" />
                            <path d="M7 21H5c-1.1 0-2-.9-2-2v-2" />
                            <rect width="7" height="5" x="7" y="7" rx="1" />
                            <rect width="7" height="5" x="10" y="12" rx="1" />
                        </svg>
                        Category
                    </span>
                </a>
                <a href="{{ route('product-type.index') }}"
                    class="block px-4 py-2 text-sm  rounded  duration-500 {{ Request::routeIs('product-type.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">

                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-chart-pie-icon lucide-chart-pie">
                            <path
                                d="M21 12c.552 0 1.005-.449.95-.998a10 10 0 0 0-8.953-8.951c-.55-.055-.998.398-.998.95v8a1 1 0 0 0 1 1z" />
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
                        </svg>
                        Product
                        Type
                    </span>

                </a>
                <a href="{{ route('size.index') }}"
                    class="block px-4 py-2 text-sm rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('size.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-ruler-icon lucide-ruler">
                            <path
                                d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z" />
                            <path d="m14.5 12.5 2-2" />
                            <path d="m11.5 9.5 2-2" />
                            <path d="m8.5 6.5 2-2" />
                            <path d="m17.5 15.5 2-2" />
                        </svg>

                        Sizing
                </a>
                </span>
                <a href="{{ route('fit.index') }}"
                    class="block px-4 py-2 text-sm rounded  duration-500 {{ Request::routeIs('fit.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">

                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-grid2x2-icon lucide-grid-2x2">
                            <path d="M12 3v18" />
                            <path d="M3 12h18" />
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                        </svg>
                        Fitting
                    </span>
                </a>

                <a href="{{ route('stock-analysis.index') }}"
                    class="block px-4 py-2 text-sm rounded  duration-500 {{ Request::routeIs('stock-analysis.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">

                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-chart-column-increasing-icon lucide-chart-column-increasing">
                            <path d="M13 17V9" />
                            <path d="M18 17V5" />
                            <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                            <path d="M8 17v-3" />
                        </svg>
                        Stock Analysis
                    </span>
                </a>
            </div>
        </div>

        <!-- Customers Dropdown -->
        <div>
            <button type="button"
                class="flex cursor-pointer text-sm items-center justify-between w-full px-4 py-2 rounded hover:bg-stone-100 hover:text-pearl-bush-700 duration-500 focus:outline-none"
                onclick="toggleDropdown('crmDropdown')">
                <span class="inline-flex gap-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 stroke-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Customers
                </span>
                <svg class="w-4 h-4 transition-transform {{ $customerOpen ? 'rotate-180' : '' }}"
                    id="arrow-crmDropdown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="crmDropdown" class="ml-6 mt-1 space-y-1 {{ $customerOpen ? '' : 'hidden' }}">
                <a href="{{ route('customer.index') }}"
                    class="block px-4 text-sm py-2 rounded  duration-500 {{ Request::routeIs('customer.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>

                        Customer
                    </span>
                </a>
                <a href="{{ route('wishlist.index') }}"
                    class="block px-4  text-sm py-2 rounded  duration-500 {{ Request::routeIs('wishlist.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-600' }}">


                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        Wishlist
                    </span>
                </a>
                <a href="{{ route('review.index') }}"
                    class="block px-4 text-sm py-2 rounded  duration-500 {{ Request::routeIs('review.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>

                        Review
                    </span>
                </a>
            </div>
        </div>

        <!-- Order Dropdown -->
        <div>
            <button type="button"
                class="flex text-sm cursor-pointer items-center justify-between w-full px-4 py-2 rounded hover:bg-stone-100 hover:text-pearl-bush-700 duration-500 focus:outline-none"
                onclick="toggleDropdown('orderDropdown')">
                <span class="inline-flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 stroke-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>

                    Order
                </span>
                <svg class="w-4 h-4 transition-transform {{ $orderOpen ? 'rotate-180' : '' }}"
                    id="arrow-orderDropdown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="orderDropdown" class="ml-6 mt-1 space-y-1 {{ $orderOpen ? '' : 'hidden' }}">
                <a href="{{ route('order.index') }}"
                    class="block px-4 text-sm py-2 rounded  duration-500 {{ Request::routeIs('order.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag">
                            <path d="M16 10a4 4 0 0 1-8 0" />
                            <path d="M3.103 6.034h17.794" />
                            <path
                                d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                        </svg>
                        Order
                    </span>
                </a>
                <a href="{{ route('coupon.index') }}"
                    class="block px-4 py-2 text-sm rounded  duration-500 {{ Request::routeIs('coupon.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-ticket-icon lucide-ticket">
                            <path
                                d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z" />
                            <path d="M13 5v2" />
                            <path d="M13 17v2" />
                            <path d="M13 11v2" />
                        </svg>
                        Coupon
                    </span>
                </a>
            </div>
        </div>

        <div>
            <button type="button"
                class="flex cursor-pointer items-center justify-between w-full px-4 py-2 rounded hover:bg-stone-100 hover:text-pearl-bush-700 text-sm duration-500 focus:outline-none"
                onclick="toggleDropdown('reportDropdown')">
                <span class="inline-flex items-center gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-clipboard-minus-icon lucide-clipboard-minus">
                        <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                        <path d="M9 14h6" />
                    </svg>
                    Report
                </span>
                <svg class="w-4 h-4 transition-transform {{ $reportOpen ? 'rotate-180' : '' }}"
                    id="arrow-reportDropdown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="reportDropdown" class="ml-6 mt-1 space-y-1 {{ $reportOpen ? '' : 'hidden' }}">
                <a href="{{ route('report.sale.index') }}"
                    class="block text-sm px-4 py-2 rounded  duration-500 {{ Request::routeIs('report.sale.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>
                        Sales</span>
                </a>
                <a href="{{ route('report.order.index') }}"
                    class="block text-sm px-4 py-2 rounded  duration-500 {{ Request::routeIs('report.order.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-file-text-icon lucide-file-text">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            <path d="M10 9H8" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                        </svg>
                        Orders</span>
                </a>
                <a href="{{ route('report.customer.index') }}"
                    class="block text-sm px-4 py-2 rounded  duration-500 {{ Request::routeIs('report.customer.*') ? 'bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">

                    <span class="inline-flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user-check-icon lucide-user-check">
                            <path d="m16 11 2 2 4-4" />
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                        </svg>
                        Customers
                    </span>
                </a>


            </div>



        </div>

        <!-- Invoice -->
        <a href="{{ url('/dashboard/invoice') }}"
            class="block px-4 py-2 text-sm rounded duration-500 {{ Request::routeIs('invoice.index') ? ' bg-pearl-bush-100 hover:bg-pearl-bush-100 text-pearl-bush-700' : 'hover:bg-stone-100 hover:text-pearl-bush-700' }}">
            <span class="inline-flex items-center gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-receipt-text-icon lucide-receipt-text">
                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                    <path d="M14 8H8" />
                    <path d="M16 12H8" />
                    <path d="M13 16H8" />
                </svg>
                Invoice
            </span>
        </a>
    </nav>
    <div class="mt-auto border-t  border-pearl-bush-100 p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="cursor-pointer hover:bg-pearl-bush-500 hover:text-white duration-300 inline-flex justify-center items-center gap-x-1 border border-pearl-bush-200 rounded-md text-stone-600 py-2 px-4">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>

                Logout
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const arrow = document.getElementById('arrow-' + id);

        dropdown.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>
