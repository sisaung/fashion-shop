@extends('layout.master')
@section('content')
    <div class="max-w-7xl mx-auto container py-10 xl:px-0 px-5">

        @include('components.breadcrumb', [
            'currentPageTitle' => 'Wishlist',
        ])

        <div class="py-5">
            <h1 class="font-heading text-2xl text-uppercase"> Your Wishlist
                ({{ $wishlist ? $wishlist->products->count() : 0 }}) </h1>
            <p class=" text-gray-500">Your saved favorites are here, waiting for their moment</p>
        </div>
        @if ($wishlist)
            @if ($wishlist->products->count() > 0)
                <form action="{{ route('wishlist.removeAllWishlist') }}" method="POST">
                    @csrf
                    <button type="submit" class="remove-all-btn text-gray-500 hover:text-gray-600 cursor-pointer text-sm">
                        Remove
                        All</button>

                </form>
            @endif
        @endif
        <div class="mt-5 space-y-3">

            {{-- @if ($wishlist->products->count() > 0)
                @foreach ($wishlist->products as $item)
                    <div class="bg-white border border-pearl-bush-100 rounded-lg p-6 ordered-products-list-container">
                        <div class="flex gap-4 pb-6">
                            <div class="w-30 h-30 border border-pearl-bush-300 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->productImages->count() > 0 ? $item->productImages->first()->preview : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949' }}"
                                    alt="BOSS Polo Penrose 38" class="w-full h-full object-cover" />
                            </div>

                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800 text-lg mb-2">{{ $item->product_name }}</h3>
                                <p class="text-amber-600 text-sm mb-2">Code: {{ $item->product_code }} </p>

                                @if ($item->discount_percentage)
                                    <p class="text-sm text-gray-400 line-through"> {{ number_format($item->sale_price) }}
                                        MMK
                                    </p>
                                @endif
                                <p class="text-gray-700 mb-3"> {{ number_format($item->display_price) }} MMK </p>


                                <div class="flex gap-3">
                                    <form action="{{ route('wishlist.destroy', ['productId' => $item->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="cursor-pointer text-gray-500 hover:text-gray-700 text-sm underline transition-colors">
                                            Remove
                                        </button>
                                    </form>
                                    <a href="{{ route('shop.show', ['slug' => $item->slug]) }}"
                                        class="bg-pearl-bush-400 hover:bg-pearl-bush-600 text-white px-4 py-2 rounded-full cursor-pointer font-medium transition-colors text-xs">
                                        See More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-stone-100 py-20 flex justify-center items-center">
                    <p>There is no wishlist...</p>
                </div>
            @endif --}}

            @if ($wishlist)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
                    {{-- @foreach ($wishlist->products as $item)
                    <div class="bg-white border border-pearl-bush-100 rounded-lg p-6 ordered-products-list-container">
                        <div class="flex gap-4 pb-6">
                            <div class="w-30 h-30 border border-pearl-bush-300 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->productImages->count() > 0 ? $item->productImages->first()->preview : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949' }}"
                                    alt="BOSS Polo Penrose 38" class="w-full h-full object-cover" />
                            </div>

                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800 text-lg mb-2">{{ $item->product_name }}</h3>
                                <p class="text-amber-600 text-sm mb-2">Code: {{ $item->product_code }} </p>

                                @if ($item->discount_percentage)
                                    <p class="text-sm text-gray-400 line-through"> {{ number_format($item->sale_price) }}
                                        MMK
                                    </p>
                                @endif
                                <p class="text-gray-700 mb-3"> {{ number_format($item->display_price) }} MMK </p>


                                <div class="flex gap-3">
                                    <form action="{{ route('wishlist.destroy', ['productId' => $item->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="cursor-pointer text-gray-500 hover:text-gray-700 text-sm underline transition-colors">
                                            Remove
                                        </button>
                                    </form>
                                    <a href="{{ route('shop.show', ['slug' => $item->slug]) }}"
                                        class="bg-pearl-bush-400 hover:bg-pearl-bush-600 text-white px-4 py-2 rounded-full cursor-pointer font-medium transition-colors text-xs">
                                        See More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}

                    @foreach ($wishlist->products as $product)
                        <a href="{{ route('shop.show', ['slug' => $product->slug]) }}" class="col-span-1  product-card ">
                            <div class="flex flex-col group rounded-lg cursor-pointer">

                                <div
                                    class=" relative w-full aspect-[3/4] flex justify-center items-center rounded-lg overflow-hidden">
                                    <img alt=""
                                        src="{{ $product->productImages->count() > 0 ? $product->productImages->first()->large : 'https://via.placeholder.com/100' }}"
                                        class="product-image w-full  transition-transform duration-300 ease-in rounded-t-lg" />
                                    <div class="absolute top-0  left-0 w-full h-full bg-black/4"></div>
                                    {{-- <div class="absolute top-0  left-0 w-full h-full bg-black/5"></div> --}}

                                    <div class="flex justify-between w-full items-center absolute top-0">
                                        <div id="product-promo-container">
                                            @if ($product->discount_type)
                                                <p class=" text-white  bg-red-500 text-xs px-2 py-1">
                                                    Save {{ number_format($product->discount_value) }} MMK OFF
                                                </p>
                                            @endif

                                        </div>
                                        <form action="{{ route('wishlist.destroy', ['productId' => $product->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-white wishlist-btn cursor-pointer size-7 -translate-x-1/2 translate-y-1/3 rounded-full inline-flex justify-center items-center  border border-transparent hover:border-pearl-bush-500 group  hover:shadow-2xl hover:scale-95 duration-300 transition-all ease-in">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="size-5 group-hover:scale-80 duration-300 transition-all ease-in  stroke-none fill-pearl-bush-400  wishlist-icon  ">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>

                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div
                                    class="group-hover:bg-black/2 flex flex-col gap-3 px-4 py-3 transition duration-300 ease-in  group-hover:shadow-xl">
                                    <p class="text-sm tracking-widest product-brand"> {{ $product->brand->brand_name }} </p>
                                    <h3 class="text-lg tracking-wide font-heading text-gray-800 product-name line-clamp-1">
                                        {{ $product->product_name }} </h3>
                                    <div class="flex items-center gap-x-2">

                                        @if ($product->discount_type)
                                            <p class="font-medium product-price">
                                                {{ number_format($product->display_price) }} MMK </p>
                                            <p class="line-through text-sm text-gray-400 sale-product-price">
                                                {{ number_format($product->sale_price) }} MMK </p>
                                        @else
                                            <p class="font-medium product-price">
                                                {{ number_format($product->display_price) }} MMK </p>
                                        @endif
                                    </div>
                                    <p class="text-xs font-mono text-gray-500 uppercase code-text">
                                        {{ $product->product_code }} </p>
                                </div>
                            </div>


                        </a>
                    @endforeach

                </div>
            @else
                <div class="bg-stone-100 py-20 flex justify-center items-center">
                    <p>There is no wishlist...</p>
                </div>
            @endif

        </div>

    </div>




@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if (session('success'))
        <script>
            console.log('{{ session('success') }}');
            Toastify({
                text: '{{ session('success') }}',
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
        </script>
    @endif
@endpush
