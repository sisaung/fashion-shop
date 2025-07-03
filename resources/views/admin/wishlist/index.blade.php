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
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Product',
                                    ])

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


                            @foreach ($wishlists as $wishlist)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $wishlist->id }}
                                    </td>



                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div class="flex items-center gap-x-2">
                                            <div>
                                                @if ($wishlist->user->profile_imge)
                                                    <img src="{{ $wishlist->user->profile_imge }}" alt="">
                                                @else
                                                    <img src="https://cdn.prod.website-files.com/67891024ed5394ef2059ff76/6795975173dc15b38db607d6_fallback-profile-image_1.jpg"
                                                        class="size-10 rounded-full object-cover object-center"
                                                        alt="{{ $wishlist->user->name }}">
                                                @endif
                                            </div>

                                            <div class="flex flex-col">
                                                <span class="text-base"> {{ $wishlist->user->name }} </span>
                                                <span class="text-gray-500 text-xs"> {{ $wishlist->user->email }} </span>
                                            </div>

                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">

                                        @if ($wishlist->products)
                                            <div class="space-x-2">
                                                @foreach ($wishlist->products as $product)
                                                    <a href="{{ route('product.show', ['product' => $product]) }}"
                                                        class="hover:text-pearl-bush-700 duration-500 text-pearl-bush-500 underline underline-offset-2 rounded-full">{{ $product->product_name }}
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
                                            class="px-2 py-1 hover:bg-gray-100 inline-flex justify-center items-center"
                                            href="{{ route('wishlist.show', $wishlist->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-5 text-gray-600">
                                                <path fill-rule="evenodd"
                                                    d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </a>


                                    </td>
                                </tr>
                            @endforeach



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
