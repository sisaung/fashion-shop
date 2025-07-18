@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Wishlist List',
        ])

        @include('admin.wishlist.header')

        <div id="wishlist-list-container">
            <section class="mt-10 px-5  drop-down-modal ">
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 ">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50 sorting-wrapper">
                            <tr>
                                <th data-sortby="id" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    @include('components.admin.sortTable', ['sortTitle' => 'ID'])

                                </th>
                                <th data-sortby="user_name" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'User',
                                    ])

                                </th>
                                <th data-sortby="product_name" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    Wishlist Product

                                </th>




                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Created
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Updated
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-center cursor-pointer">
                                        Action
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">


                            @if ($wishlists->count() > 0)
                                @foreach ($wishlists as $wishlist)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                            {{ $wishlist->id }}
                                        </td>



                                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">

                                            <div class="flex items-center gap-x-2">
                                                <div>

                                                    <img src="{{ $wishlist->user->profile_image ? $wishlist->user->profile_image : 'https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1≈' }}"
                                                        class="size-10 rounded-full object-cover object-center"
                                                        alt="{{ $wishlist->user->name }}">

                                                </div>

                                                <div class="flex flex-col">
                                                    <span class="text-base"> {{ $wishlist->user->name }} </span>
                                                    <span class="text-gray-500 text-xs"> {{ $wishlist->user->email }}
                                                    </span>
                                                </div>

                                            </div>
                                        </td>

                                        <td class="whitespace-wrap px-4 py-4 text-sm text-gray-900">

                                            @if ($wishlist->products)
                                                <div class="inline-flex flex-col gap-2">
                                                    @foreach ($wishlist->products->take(1) as $product)
                                                        <a href="{{ route('product.show', ['product' => $product]) }}"
                                                            class=" bg-pearl-bush-100 px-2 text-xs py-2 hover:text-pearl-bush-800 rounded-md duration-500 text-pearl-bush-500  line-clamp-1">{{ $product->product_name }}
                                                            -
                                                            {{ $product->brand->brand_name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                            <div class="">
                                                <p> {{ date('j M Y', strtotime($wishlist->created_at)) }} </p>
                                                <p> {{ date('g:i A', strtotime($wishlist->created_at)) }} </p>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                            <div class="">
                                                <p> {{ date('j M Y', strtotime($wishlist->created_at)) }} </p>
                                                <p> {{ date('h:i A', strtotime($wishlist->created_at)) }} </p>
                                            </div>
                                        </td>

                                        <td
                                            class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex items-center justify-center">

                                            <a href="{{ route('wishlist.show', $wishlist->id) }}"
                                                class="px-2 py-1  hover:bg-gray-100 inline-flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="size-5 text-gray-600">
                                                    <path fill-rule="evenodd"
                                                        d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                                        clip-rule="evenodd" />
                                                </svg>


                                            </a>


                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-gray-500 text-sm"> There are no
                                        wishlists.
                                    </td>
                                </tr>
                            @endif



                        </tbody>
                    </table>
                </div>

            </section>


            <div class="pagination-wrapper">
                @include('components.pagination', ['paginator' => $wishlists])

            </div>
        </div>



    </div>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/flowbite/flowbite.min.js']) --}}
    @vite(['resources/js/sorting.js'])
    @vite(['resources/js/search.js'])
    {{-- @vite(['resources/js/pagination.js']) --}}
    {{-- @vite(['resources/js/redirectToDetail.js']) --}}
@endpush
