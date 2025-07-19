@extends('layout.master')

@php

    $productImages = [
        [
            'url' => '/storage/banner/blooker.webp',
        ],
        [
            'url' => '/storage/banner/casual-outfit.avif',
        ],

        [
            'url' => '/storage/banner/fashion-accessories.png',
        ],
        [
            'url' => '/storage/banner/shirt.jpg',
        ],

        [
            'url' => '/storage/banner/street-style.jpeg',
        ],
    ];

    // $query = http_build_query(['brands[]' => $brand->id]);

@endphp
@section('content')
    <main class="flex flex-col min-h-screen">
        <div>

            <section class="mb-10">
                <div class="relative">
                    <div id="default-carousel" class="relative w-full" data-carousel="slide">
                        {{-- carousel wrapper --}}
                        <div class="relative h-96  overflow-hidden rounded-lg md:h-[670px] ">

                            {{-- carousel items --}}
                            @foreach ($productImages as $image)
                                {{-- item --}}
                                <div class="hidden aspect-square[16/9] w-full overflow-hidden duration-700 ease-in-out rounded-lg" data-carousel-item>

                                    <img src="{{ asset($image['url']) }}"
                                        class="absolute  block w-full h-full object-center object-cover"
                                        alt="...">
                                    <div class="absolute top-0 left-0 w-full h-full bg-black/35"></div>
                                    <div class="absolute bottom-30 left-20">
                                        <p class="text-4xl md:text-6xl tracking-wide font-heading text-white font-bold">
                                            Carry Confidence
                                        </p>
                                        <p class="text-4xl md:text-6xl tracking-wide font-heading font-bold text-white">
                                            Wear Grace
                                        </p>
                                        <p class=" text-lg tracking-wider text-white"> Step into outfit that brings comfort,confidence, and a sense of belonging. </p>
                                    </div>

                                </div>
                            @endforeach


                        </div>


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

            {{-- feature brand --}}


            <div class="mb-10 xl:px-0 px-5">
                <x-public.container-layout>

                    <div class="mb-5">
                        <h1 class="text-4xl font-heading tracking-wide font-semibold"> Featured Brands </h1>
                        <p class="text-gray-500 font-thin tracking-wide">Explore our exclusive partnerships with the world's
                            most
                            prestigious fashion houses.</p>
                    </div>

                    @include('components.public.fearturedBrand', ['brands' => $brands])


                    <section class="space-y-5">
                        <div class="">
                            <h1 class="text-4xl font-heading tracking-wide font-semibold"> Explore Our Latest Style </h1>
                            <p class="text-gray-500 font-thin tracking-wide"> Find clothes that match your vibe and every
                                day
                                better. </p>
                        </div>

                        {{-- <div class="grid grid-cols-5 gap-3">

                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                    <div class="col-span-1  product-card ">
                                        <div class="flex flex-col group rounded-lg cursor-pointer">

                                            <div
                                                class=" relative w-full aspect-[3/4] flex justify-center items-center rounded-lg overflow-hidden">
                                                <img alt="{{ $product->product_name }}"
                                                    src="{{ $product->productImages->count() > 0 ? $product->productImages->first()->large : 'https://www.mooreseal.com/wp-content/uploads/2013/11/dummy-image-square-300x300.jpg' }}"
                                                    class="product-image w-full  transition-transform duration-300 ease-in rounded-t-lg" />
                                                <div class="absolute top-0  left-0 w-full h-full bg-black/4"></div>


                                                <div class="flex justify-between w-full items-center absolute top-0">
                                                    <div id="product-promo-container">
                                                        <p class=" text-white text-xs px-2 py-1 product-promo  hidden">
                                                        </p>

                                                    </div>
                                                    <button
                                                        class="bg-white wishlist-btn cursor-pointer size-7 -translate-x-1/2 translate-y-1/3 rounded-full inline-flex justify-center items-center  border border-transparent hover:border-pearl-bush-500 group  hover:shadow-2xl hover:scale-95 duration-300 transition-all ease-in">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-5 group-hover:scale-80 duration-300 transition-all ease-in  stroke-gray-600 wishlist-icon  ">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                        </svg>

                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div
                                                class="group-hover:bg-black/2 flex flex-col gap-3 px-4 py-3 transition duration-300 ease-in  group-hover:shadow-xl">
                                                <p class="text-sm tracking-widest product-brand">
                                                    {{ $product->brand->brand_name }} </p>
                                                <h3
                                                    class="text-lg tracking-wide font-heading text-gray-800 product-name line-clamp-1">
                                                    {{ $product->product_name }} </h3>
                                                <div class="flex items-center gap-x-2">

                                                    @if ($product->discount_type)
                                                        <p class="font-medium product-price"> {{ $product->display_price }}
                                                        </p>
                                                        <p class="line-through text-sm text-gray-400 sale-product-price">
                                                            {{ $product->sale_price }}
                                                        </p>
                                                    @else
                                                        <p class="font-medium product-price"> {{ $product->display_price }}
                                                        </p>
                                                    @endif

                                                </div>
                                                <p class="text-xs font-mono text-gray-500 uppercase code-text">
                                                    {{ $product->product_code }} </p>
                                            </div>
                                        </div>


                                    </div>
                                @endforeach
                            @endif

                        </div> --}}

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5" id="product-container">
                        </div>

                        <div>
                            <p class="text-gray-500  tracking-wide py-5 font-light text-center">Discover all our styles and
                                find the look that's made for you!</p>

                            <a href="{{ url('/shop') }}"
                                class="flex justify-center gap-2 items-center underline underline-offset-4">Go to Shop
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4 stroke-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>

                            </a>
                        </div>

                        <template id="product-template">
                            @include('public.shop.components.productList')

                        </template>

                    </section>

                    <section class="mt-10">
                        <div class="flex justify-around  py-4">
                            <div class="flex flex-col items-center gap-3">
                                <div class="bg-pearl-bush-50 size-20 rounded-full flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-10 stroke-pearl-bush-900 stroke-1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>

                                </div>
                                <div class="text-center">
                                    <p class="font-semibold font-heading text-2xl"> Free Shipping</p>
                                    <p class="text-sm text-gray-500 leading-8 tracking-wider">Free Delivery, More Smiles.
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col items-center gap-3">
                                <div class="bg-pearl-bush-50 size-20 rounded-full flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-10 stroke-pearl-bush-900 stroke-1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>



                                </div>
                                <div class="text-center">
                                    <p class="font-semibold font-heading text-2xl"> Cash on Delivery</p>
                                    <p class="text-sm text-gray-500 leading-8 tracking-wider">Pay when you receive.
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col items-center gap-3">
                                <div class="bg-pearl-bush-50 size-20 rounded-full flex justify-center items-center">

                                    <span class="text-pearl-bush-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-recycle-icon lucide-recycle">
                                            <path
                                                d="M7 19H4.815a1.83 1.83 0 0 1-1.57-.881 1.785 1.785 0 0 1-.004-1.784L7.196 9.5" />
                                            <path
                                                d="M11 19h8.203a1.83 1.83 0 0 0 1.556-.89 1.784 1.784 0 0 0 0-1.775l-1.226-2.12" />
                                            <path d="m14 16-3 3 3 3" />
                                            <path d="M8.293 13.596 7.196 9.5 3.1 10.598" />
                                            <path
                                                d="m9.344 5.811 1.093-1.892A1.83 1.83 0 0 1 11.985 3a1.784 1.784 0 0 1 1.546.888l3.943 6.843" />
                                            <path d="m13.378 9.633 4.096 1.098 1.097-4.096" />
                                        </svg>
                                    </span>

                                </div>
                                <div class="text-center">
                                    <p class="font-semibold font-heading text-2xl"> Easy 30-Day Returns</p>
                                    <p class="text-sm text-gray-500 leading-8 tracking-wider">Free Return within 30 days.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </section>


                </x-public.container-layout>
            </div>

        </div>


    </main>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
    @vite(['resources/js/shop-product/getLatestStyle.js'])
    @vite(['resources/js/shop-product/product-detail/redirect.js'])
    @vite(['resources/js/shop-product/addWishlistHome.js'])
@endpush
