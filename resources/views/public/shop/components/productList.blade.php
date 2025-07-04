<div class="col-span-1  product-card ">
    <div class="flex flex-col group rounded-lg cursor-pointer">

        <div class=" relative w-full aspect-[3/4] flex justify-center items-center rounded-lg overflow-hidden">
            <img
                alt="" class="product-image w-full  transition-transform duration-300 ease-in rounded-t-lg" />
            <div class="absolute top-0  left-0 w-full h-full bg-black/4"></div>
            {{-- <div class="absolute top-0  left-0 w-full h-full bg-black/5"></div> --}}

            <div class="flex justify-between w-full items-center absolute top-0">
                <div id="product-promo-container">
                    <p class=" text-white   text-xs px-2 py-1 product-promo  hidden"></p>

                </div>
                <button
                    class="bg-white wishlist-btn cursor-pointer size-7 -translate-x-1/2 translate-y-1/3 rounded-full inline-flex justify-center items-center  border border-transparent hover:border-pearl-bush-500 group  hover:shadow-2xl hover:scale-95 duration-300 transition-all ease-in">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 group-hover:scale-80 duration-300 transition-all ease-in  stroke-gray-600 wishlist-icon  ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>

                </button>
            </div>
        </div>

        <!-- Content -->
        <div
            class="group-hover:bg-black/2 flex flex-col gap-3 px-4 py-3 transition duration-300 ease-in  group-hover:shadow-xl">
            <p class="text-sm tracking-widest product-brand">Boss</p>
            <h3 class="text-lg tracking-wide font-heading text-gray-800 product-name line-clamp-1">Classic cotton shirt</h3>
            <div class="flex items-center gap-x-2">
                <p class="font-medium product-price"></p>
                <p class="line-through text-sm text-gray-400 sale-product-price"></p>
            </div>
            <p class="text-xs font-mono text-gray-500 uppercase code-text">123ODOR</p>
        </div>
    </div>


</div>
