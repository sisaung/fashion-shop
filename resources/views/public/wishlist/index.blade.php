@extends('layout.master')
@section('content')
    <div class="max-w-7xl mx-auto container">

        <div class="py-5">
            <h1 class="font-heading text-2xl text-uppercase"> Your Wishlist </h1>
            <p class=" text-gray-500">Your saved favorites are here, waiting for their moment</p>
        </div>
        <div class="mt-5 space-y-3">
            @if ($wishlist)
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
            @endif

        </div>

    </div>
@endsection
@push('scripts')
@endpush
