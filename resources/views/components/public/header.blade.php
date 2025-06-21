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
            <div class="flex gap-x-7">
                <a href="" class="text-gray-700 hover:text-black font-medium transition-colors text-sm">New
                    Arrival</a>

                <a href="" class="text-gray-700 hover:text-black font-medium transition-colors text-sm">Men</a>

                <a href="" class="text-gray-700 hover:text-black font-medium transition-colors text-sm">Women</a>
                <a href=""
                    class="text-gray-700 hover:text-black font-medium transition-colors text-sm">Unisex</a>

            </div>
            <div class="flex items-center gap-x-7">
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </a>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </a>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                </a>




                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="cursor-pointer"
                    type="button"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-5 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        @auth
                            @if (Auth::user()->is_admin === 'admin')
                                <li>
                                    <a href="{{ route('dashboard.index') }}"
                                        class="block px-4 py-2  hover:bg-stone-100 hover:text-stone-600">Dasboard</a>
                                </li>
                            @else
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
</header>

@push('scripts')
    @vite(['resources/js/flowbite/flowbite.min.js'])
@endpush
