@extends('layout.master')

@php

    $productImages = [
        [
            'url' =>
                'https://i.guim.co.uk/img/media/9c8907d80442ba1c2ded358bcffdb4c0706ddea1/0_158_5616_3370/master/5616.jpg?width=1200&quality=85&auto=format&fit=max&s=28ffde91c69ec37fe2eff74d53535a9a',
        ],
        [
            'url' =>
                'https://shopcarolinagirls.com/cdn/shop/articles/5190bcf625fc2bf44d1b907509d68033_900x.jpg?v=1602671644',
        ],

        [
            'url' =>
                'https://cdn.prod.website-files.com/5f0fcce0a916ee029d5b60df/66aa60ce9339e87dea1c765f_FASHION%20CLOTHES.jpg',
        ],
    ];

@endphp
@section('content')
    <main class="flex flex-col min-h-screen">
        <div>
            {{-- <section id="slideshow-container"
                class="relative h-[70vh] md:h-[300px] bg-gray-70">

                <div class="absolute inset-0 bg-black opacity-30"></div>
                <div class="relative z-10 text-white px-4">
                    <img src="https://i.guim.co.uk/img/media/9c8907d80442ba1c2ded358bcffdb4c0706ddea1/0_158_5616_3370/master/5616.jpg?width=1200&quality=85&auto=format&fit=max&s=28ffde91c69ec37fe2eff74d53535a9a"
                        alt="" class="w-full h-full">
                    <h1 class="text-4xl md:text-6xl font-black leading-tight tracking-wide">Own your style <br> Own your
                        story</h1>
                    <p class="mt-4 max-w-xl mx-auto text-lg text-gray-200">Discover outfits that inspire confidence and
                        express who you truly are - anytime, anywhere.</p>
                </div>
            </section> --}}
            <section>
                <div class="relative">
                    <div id="default-carousel" class="relative w-full" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56  overflow-hidden rounded-lg md:h-[600px]">

                            {{-- carousel items --}}
                            @foreach ($productImages as $image)
                                <!-- Item 1 -->
                                <div class="hidden  overflow-hidden duration-700 ease-in-out rounded-lg" data-carousel-item>

                                    <img src="{{ $image['url'] }}"
                                        class="absolute  block w-full  -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                        alt="...">
                                    <div class="absolute top-0 left-0 w-full h-full bg-black/35"></div>
                                    <div class="absolute bottom-30 left-10">
                                        <p class="text-4xl md:text-6xl    text-white font-bold">
                                            Carry Confidence
                                        </p>
                                        <p class="text-4xl md:text-6xl  font-bold text-white">
                                           Wear Grace
                                        </p>
                                        <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Cumque eligendi </p>
                                    </div>

                                </div>
                            @endforeach


                        </div>

                        <!-- Slider controls -->
                        {{-- <button type="button"
                            class="absolute  -top-8 start-0 z-30  flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-prev>
                            <span
                                class="inline-flex  items-center border-2 border-pearl-bush-500 justify-center size-12 rounded-full bg-white group-hover:bg-gray-100  group-focus:ring-4 group-focus:ring-gray-100 active:scale-70 duration-300 group-focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-4 text-pearl-bush-400">
                                    <path fill-rule="evenodd"
                                        d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </span>
                        </button>
                        <button type="button"
                            class="absolute -top-8 end-0  z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex  items-center border-2 border-pearl-bush-500 justify-center size-12 rounded-full bg-white group-hover:bg-gray-100  group-focus:ring-4 group-focus:ring-gray-100 active:scale-70 duration-300 group-focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-4 text-pearl-bush-400">
                                    <path fill-rule="evenodd"
                                        d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                        clip-rule="evenodd" />
                                </svg>


                            </span>
                        </button> --}}
                    </div>


                    <div class="absolute bottom-30 left-10">
                        <p class="text-4xl md:text-6xl font-black leading-tight tracking-wide text-white"> Own your look
                        </p>
                        <p class="text-4xl md:text-6xl font-black leading-tight tracking-wide text-white"> Own your moment
                        </p>
                        <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque eligendi </p>
                    </div>

                </div>
            </section>
        </div>

        <footer class="bg-white border-t mt-auto">
            <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="space-y-4">

                        <p class="font-bold text-lg">LoomLuxe</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Terms & Conditions</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-500 hover:text-gray-900">Returns & Refunds</a></li>
                            <li><a href="#" class="text-gray-500 hover:text-gray-900">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-500 hover:text-gray-900">Cookies Policy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Store</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="about" class="text-gray-500 hover:text-gray-900">About</a></li>
                            <li><a href="contact" class="text-gray-500 hover:text-gray-900">Contact Us</a></li>

                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Social</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-500 hover:text-gray-900">Facebook</a></li>
                            <li><a href="#" class="text-gray-500 hover:text-gray-900">Instagram</a></li>
                            <li><a href="#" class="text-gray-500 hover:text-gray-900">X</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 border-t pt-8 text-center text-gray-500">
                    <p>Copy Right &copy; 2024. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    </main>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
@endpush
