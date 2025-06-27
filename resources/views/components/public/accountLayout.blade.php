@extends('layout.master')
@section('content')
    <div class="w-[1310px] mx-auto  flex ">
        <div class="w-80 border-r border-r-pearl-bush-100 space-y-5 ">
            <h1 class="font-heading text-lg text-gray-800 font-semibold py-3  px-4">Account Settings</h1>
            <div>
                <a class="flex items-center menu-btn gap-x-3 hover:bg-stone-100 px-4 py-3 rounded mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span class="font-heading">
                        Shop
                    </span>
                </a>
            </div>
            <div>
                <a href="{{ route('account.orders') }}"
                    class="flex px-4 py-3 mr-5 rounded items-center menu-btn gap-x-3 {{ Request::routeIs('account.orders') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }} hover:bg-stone-100 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>

                    <span class="font-heading">
                        Orders
                    </span>
                </a>
            </div>
            <div>
                <a class="flex px-4 py-3 mr-5 rounded items-center menu-btn gap-x-3 {{ Request::routeIs('account.profile') ? 'bg-pearl-bush-300 hover:bg-pearl-bush-300 text-white' : '' }} hover:bg-stone-100 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>


                    <span class="font-heading">
                        Profile
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center menu-btn gap-x-3 px-4 py-3 rounded mr-5  hover:bg-stone-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>



                    <span class="font-heading">
                        Manage Address
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center menu-btn gap-x-3  px-4 py-3 rounded mr-5 hover:bg-stone-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>



                    <span class="font-heading">
                        Payment
                    </span>
                </a>
            </div>
            <div>
                <a href="" class="flex items-center gap-x-3 px-4 py-3 rounded mr-5 hover:bg-stone-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>



                    <span class="font-heading">
                        Logout
                    </span>
                </a>
            </div>


        </div>
        <div class="w-full">
            @yield('container')

        </div>
    </div>
@endsection
