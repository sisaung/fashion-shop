<footer class=" border-t-2  border-gray-200  shadow mt-auto">

    <x-public.container-layout>

        <div class="grid grid-cols-4 lg:grid-cols-6 xl:grid-cols-7 xl:px-0 px-5 gap-10 py-10">
            <div class="lg:col-span-3 col-span-full">
                <div class="flex gap-2 items-center mb-3">
                    <img src="{{ asset('/storage/logo/luxury.png') }}" alt="logo" class="h-12">

                    <div class="flex flex-col">
                        <h3 class="text-3xl font-heading text-gray-900">LoomLuxe</h3>
                        <p class="text-sm text-gray-500">fashion shop</p>

                    </div>
                </div>
                <p class="max-w-md text-gray-500 tracking-wide">Curating the finest luxury fashion from the world's most
                    prestigious designers.
                    Experience
                    elegance redefined with our exclusive collections.</p>
            </div>

            <div class="sm:col-span-1 col-span-2 space-y-3">
                <p class="font-medium font-heading text-lg tracking-wide">Customer Service</p>
                <div class="flex flex-col gap-1">
                    <a href="{{ url('/contact-us') }}"
                        class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">Contact
                        Us</a>
                    <a href="{{ url('/about-us') }}"
                        class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">About
                        us</a>
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            <button
                            type="submit"
                                class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">
                                Logout {{ Auth::user()->name }} </button>
                        </form>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}"
                            class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">Register
                        </a>
                    @endguest
                </div>

            </div>

            <div class="col-span-2 sm:col-span-1  space-y-2  gap-14 ">
                <div class="flex flex-col justify-center items-center">
                    <p class="font-medium font-heading mb-3 text-lg tracking-wide">Shop</p>
                    <div class="flex flex-col gap-1">
                        <a href="{{ url('/shop') . '?' . http_build_query(['gender' => 'male']) }}"
                            class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">Men
                        </a>
                        <a href="{{ url('/shop') . '?' . http_build_query(['gender' => 'female']) }}"
                            class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">Women
                        </a>

                        <a href="{{ url('/shop') . '?' . http_build_query(['gender' => 'unisex']) }}"
                            class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">Unisex
                        </a>

                        <a href="{{ url('/shop') . '?' . http_build_query(['on_sale' => 1]) }}"
                            class="text-sm text-gray-500 hover:text-gray-700 duration-300 font-thin tracking-wide leading-8">Sale
                        </a>

                    </div>
                </div>

            </div>

            <div class="space-y-3  col-span-full sm:col-span-2">
                <p class="font-medium font-heading text-lg tracking-wide mb-3"> Contact </p>


                <div class="flex items-center gap-3">
                    <div class="bg-pearl-bush-50 inline-flex items-center justify-center size-10 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 stroke-pearl-bush-700 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>

                    </div>

                    <div class="flex flex-col">
                        <span class="font-medium text-gray-900  font-heading">Email</span>
                        <span class="font-medium text-gray-900  font-heading">loomluxe@gmail.com</span>
                    </div>

                </div>

                <div class="flex items-center gap-3">
                    <div class="bg-pearl-bush-50 inline-flex items-center justify-center size-10 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 stroke-2 stroke-pearl-bush-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>

                    </div>

                    <div class="flex flex-col">
                        <span class="font-medium text-gray-900  font-heading">Phone</span>
                        <span class="font-medium text-gray-900  font-heading">+959782242748</span>
                    </div>

                </div>
            </div>

        </div>
    </x-public.container-layout>
    <div class="border-t-2  border-gray-200">
        <div class="max-w-7xl mx-auto container py-5 xl:px-0 px-5">
            <div class="flex sm:flex-row flex-col-reverse sm:gap-0 gap-3 sm:justify-between items-center">
                <p class="text-gray-500 text-sm font-thin">Copy Right &copy; {{ date('Y') }}. All Rights Reserved
                </p>

                <div class="flex items-center gap-3">

                    <div
                        class="hover:-translate-y-1/3 duration-300 transition-all ease-in cursor-pointer hover:bg-pearl-bush-300 group size-10 bg-pearl-bush-50 inline-flex justify-center items-center rounded-full">
                        <span class="text-pearl-bush-700 group-hover:text-white">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                class="size-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <div
                        class="hover:-translate-y-1/3 duration-300 transition-all ease-in cursor-pointer hover:bg-pearl-bush-300 group size-10 bg-pearl-bush-50 inline-flex justify-center items-center rounded-full">
                        <span class="text-pearl-bush-700 group-hover:text-white">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                class="size-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M256.55 8C116.52 8 8 110.34 8 248.57c0 72.3 29.71 134.78 78.07 177.94 8.35 7.51 6.63 11.86 8.05 58.23A19.92 19.92 0 0 0 122 502.31c52.91-23.3 53.59-25.14 62.56-22.7C337.85 521.8 504 423.7 504 248.57 504 110.34 396.59 8 256.55 8zm149.24 185.13l-73 115.57a37.37 37.37 0 0 1-53.91 9.93l-58.08-43.47a15 15 0 0 0-18 0l-78.37 59.44c-10.46 7.93-24.16-4.6-17.11-15.67l73-115.57a37.36 37.36 0 0 1 53.91-9.93l58.06 43.46a15 15 0 0 0 18 0l78.41-59.38c10.44-7.98 24.14 4.54 17.09 15.62z">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <div
                        class="hover:-translate-y-1/3 duration-300 transition-all ease-in cursor-pointer hover:bg-pearl-bush-300 group size-10 bg-pearl-bush-50 inline-flex justify-center items-center rounded-full">
                        <span class="text-pearl-bush-700 group-hover:text-white transition ease-in duration-300">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512"
                                class="size-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <div
                        class="hover:-translate-y-1/3 duration-300 transition-all ease-in cursor-pointer hover:bg-pearl-bush-300 group size-10 bg-pearl-bush-50 inline-flex justify-center items-center rounded-full">
                        <span class="text-pearl-bush-700 group-hover:text-white transition ease-in duration-300">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                class="size-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M444 49.9C431.3 38.2 379.9.9 265.3.4c0 0-135.1-8.1-200.9 52.3C27.8 89.3 14.9 143 13.5 209.5c-1.4 66.5-3.1 191.1 117 224.9h.1l-.1 51.6s-.8 20.9 13 25.1c16.6 5.2 26.4-10.7 42.3-27.8 8.7-9.4 20.7-23.2 29.8-33.7 82.2 6.9 145.3-8.9 152.5-11.2 16.6-5.4 110.5-17.4 125.7-142 15.8-128.6-7.6-209.8-49.8-246.5zM457.9 287c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9.4-85.7.4-85.7-.1 0-.1 0 0 0-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9.4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1zm-139-80.8c.4 8.6-12.5 9.2-12.9.6-1.1-22-11.4-32.7-32.6-33.9-8.6-.5-7.8-13.4.7-12.9 27.9 1.5 43.4 17.5 44.8 46.2zm20.3 11.3c1-42.4-25.5-75.6-75.8-79.3-8.5-.6-7.6-13.5.9-12.9 58 4.2 88.9 44.1 87.8 92.5-.1 8.6-13.1 8.2-12.9-.3zm47 13.4c.1 8.6-12.9 8.7-12.9.1-.6-81.5-54.9-125.9-120.8-126.4-8.5-.1-8.5-12.9 0-12.9 73.7.5 133 51.4 133.7 139.2zM374.9 329v.2c-10.8 19-31 40-51.8 33.3l-.2-.3c-21.1-5.9-70.8-31.5-102.2-56.5-16.2-12.8-31-27.9-42.4-42.4-10.3-12.9-20.7-28.2-30.8-46.6-21.3-38.5-26-55.7-26-55.7-6.7-20.8 14.2-41 33.3-51.8h.2c9.2-4.8 18-3.2 23.9 3.9 0 0 12.4 14.8 17.7 22.1 5 6.8 11.7 17.7 15.2 23.8 6.1 10.9 2.3 22-3.7 26.6l-12 9.6c-6.1 4.9-5.3 14-5.3 14s17.8 67.3 84.3 84.3c0 0 9.1.8 14-5.3l9.6-12c4.6-6 15.7-9.8 26.6-3.7 14.7 8.3 33.4 21.2 45.8 32.9 7 5.7 8.6 14.4 3.8 23.6z">
                                </path>
                            </svg>
                        </span>
                    </div>



                </div>
            </div>
        </div>
    </div>
</footer>
