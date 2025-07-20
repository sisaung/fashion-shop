<section class="mb-20">
    @if ($brands->count() > 0)
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-5">
            @foreach ($brands as $brand)
                <a href="{{ url('/shop') . '?' . http_build_query(['brands[]' => $brand->brand_name]) }}"
                    class="hover:scale-90 transition-all duration-300 ease-in col-span-1 p-3 flex justify-center items-center border border-pearl-bush-400 rounded-lg overflow-hidden ">
                    <span class="inline-flex justify-center items-center  w-full lg:w-lg h-30 sm:h-40 lg:h-30">
                        <img src="{{ $brand->brand_image ? $brand->brand_image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949' }}"
                            alt="{{ $brand->brand_name }} " class="object-cover max-[375px]:w-[150px]  sm:w-full md:w-2/3 lg:w-full h-full object-center">
                    </span>
                </a>
            @endforeach
        </div>
    @endif
</section>
