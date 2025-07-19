<section class="mb-10">
    @if ($brands->count() > 0)
        <div class="grid grid-cols-5 gap-5">
            @foreach ($brands as $brand)
                <a href="{{ url('/shop') . '?' . http_build_query(['brands[]' => $brand->brand_name]) }}"
                    class="hover:scale-90 transition-all duration-300 ease-in col-span-1 p-3 flex justify-center items-center border border-pearl-bush-400 rounded-lg overflow-hidden">
                    <img src="{{ $brand->brand_image ? $brand->brand_image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949' }}"
                        alt="{{ $brand->brand_name }} " class="w-lg h-30 object-cover object-center">
                </a>
            @endforeach
        </div>
    @endif
</section>
