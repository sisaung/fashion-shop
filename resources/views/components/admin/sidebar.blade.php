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
    $inventoryRoutes = ['brand.*', 'product.*', 'product-category.*', 'product-type.*', 'size.*', 'fit.*'];
    $crmRoutes = ['customer.*', 'wishlist.*', 'review.*'];
    $orderRoutes = ['order.*', 'coupon.*'];

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
    $crmOpen = isDropdownOpen($crmRoutes);
    $orderOpen = isDropdownOpen($orderRoutes);
@endphp

<aside class="w-64 h-screen bg-white flex flex-col  flex-shrink-0 overflow-y-auto">
    <div class="p-4 text-2xl font-bold">Admin Panel</div>
    <nav class="px-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ url('/dashboard') }}"
            class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('dashboard') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">
            Dashboard
        </a>

        <!-- Inventory Dropdown -->
        <div>
            <button type="button"
                class="flex cursor-pointer items-center justify-between w-full px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 focus:outline-none"
                onclick="toggleDropdown('inventoryDropdown')">
                <span>Inventory</span>
                <svg class="w-4 h-4 transition-transform {{ $inventoryOpen ? 'rotate-180' : '' }}"
                    id="arrow-inventoryDropdown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="inventoryDropdown" class="ml-6 mt-1 space-y-1 {{ $inventoryOpen ? '' : 'hidden' }}">
                <a href="{{ route('brand.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('brand.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Brand</a>
                <a href="{{ route('product.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('product.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Product
                </a>
                <a href="{{ route('product-category.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('category.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Category</a>
                <a href="{{ route('product-type.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('product-type.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Product
                    Type</a>
                <a href="{{ route('size.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('size.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Sizing</a>
                <a href="{{ route('fit.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('fit.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Fitting</a>
            </div>
        </div>

        <!-- CRM Dropdown -->
        <div>
            <button type="button"
                class="flex cursor-pointer items-center justify-between w-full px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 focus:outline-none"
                onclick="toggleDropdown('crmDropdown')">
                <span>CRM</span>
                <svg class="w-4 h-4 transition-transform {{ $crmOpen ? 'rotate-180' : '' }}" id="arrow-crmDropdown"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="crmDropdown" class="ml-6 mt-1 space-y-1 {{ $crmOpen ? '' : 'hidden' }}">
                <a href="{{ route('customer.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('customer.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Customer</a>
                <a href="{{ route('wishlist.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('wishlist.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Wishlist</a>
                <a href="{{ route('review.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('review.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Review</a>
            </div>
        </div>

        <!-- Order Dropdown -->
        <div>
            <button type="button"
                class="flex cursor-pointer items-center justify-between w-full px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 focus:outline-none"
                onclick="toggleDropdown('orderDropdown')">
                <span>Order</span>
                <svg class="w-4 h-4 transition-transform {{ $orderOpen ? 'rotate-180' : '' }}" id="arrow-orderDropdown"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="orderDropdown" class="ml-6 mt-1 space-y-1 {{ $orderOpen ? '' : 'hidden' }}">
                <a href="{{ route('order.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('order.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">
                    Order</a>
                <a href="{{ route('coupon.index') }}"
                    class="block px-4 py-2 rounded hover:bg-pearl-bush-100 duration-500 {{ Request::routeIs('coupon.*') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }}">Coupon</a>
            </div>
        </div>
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
