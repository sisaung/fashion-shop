@extends('layout.dashboard')



@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        <div class="flex justify-between items-center ">
            <div>
                @include('components.admin.breadcrumb', [
                    'currentPageTitle' => 'Wishlist Detail',
                    'links' => [['name' => 'Wishlist', 'path' => route('wishlist.index')]],
                ])
            </div>


        </div>

        <h1 class="mt-10 text-xl px-5"> Wishlist Detail </h1>
        <section class="px-5 grid grid-cols-2 gap-x-5">


            <div class="col-span-1 mt-5">
                <h3 class="text-sm font-semibold me-3 text-stone-600 mb-3">
                    User Information
                </h3>
                <table class="w-full text-sm text-left rtl:text-right text-stone-600 mb-10">
                    <tbody>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">Image</td>
                            <td class="px-6 py-3 border border-stone-200 text-start">
                                @if ($wishlist->user->profile_image)
                                    <img src="{{ $wishlist->user->profile_image }}" alt="{{ $wishlist->user->name }}"
                                        class="w-18 rounded-full object-cover object-center">
                                @else
                                    <img class="w-20 rounded-full"
                                        src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1"
                                        alt="Demo" />
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">User Name</td>
                            <td class="px-6 py-3 border border-stone-200 text-start">{{ $wishlist->user->name }} </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">User Email</td>
                            <td class="px-6 py-3 border border-stone-200 text-start"> {{ $wishlist->user->email }} </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold border border-stone-200 text-start">Created</td>
                            <td class="px-6 py-3 border border-stone-200 text-start">
                                {{ date('j M Y', strtotime($wishlist->user->created_at)) }} -
                                {{ date('h:i A', strtotime($wishlist->user->created_at)) }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-span-1"></div>

            <div class="col-span-full">
                <h3 class="text-sm font-semibold me-3 text-stone-600 mb-3">
                    User Addresses
                </h3>
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">#</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Phone</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Full Address</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">City</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Township</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">


                            @if ($wishlist->user->addresses)
                                @foreach ($wishlist->user->address as $address)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                            {{ $address->id }} </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                            {{ $address->phone_number }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                            {{ $address->address_detail }}
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                            {{ $address->city }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                            {{ $address->township }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-gray-500 text-sm"> There is no
                                        address.
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-span-full mt-5">
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 ">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50 sorting-wrapper">
                            <tr>
                                <th data-sortby="id" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">

                                    ID

                                </th>


                                <th data-sortby="product_name" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">

                                    Product

                                </th>

                                <th data-sortby="display_price" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">

                                    Sale Price

                                </th>



                                <th data-sortby="stock_count" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">

                                    Stock Count

                                </th>

                                <th data-sortby="stock_count" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">

                                    Discount

                                </th>

                                <th data-sortby="is_new_arrival" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">

                                    New Arrival

                                </th>


                                <th scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Created
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Updated
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-center cursor-pointer">
                                        Action
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white body-container">


                            @foreach ($wishlist->products as $product)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $product->id }}
                                    </td>


                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">

                                        <div class="flex gap-x-3">
                                            <div class="w-10">
                                                @if ($product->productImages->first())
                                                    <img src="{{ $product->productImages->first()->thumbnail }}"
                                                        class="object-cover h-full w-full object-center " alt="">
                                                @else
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949"
                                                        class="w-full aspect-square object-cover object-center rounded-md"
                                                        alt="">
                                                @endif
                                            </div>
                                            <div class="flex flex-col gap-y-1">
                                                <span>{{ $product->product_name }} - {{ $product->brand->brand_name }}
                                                </span>
                                                <div class="flex gap-2">
                                                    <p
                                                        class="bg-pearl-bush-300 text-white text-xs inline-block px-2 py-1 rounded-md">
                                                        {{ $product->gender }} </p>
                                                    <p
                                                        class=" bg-pearl-bush-300 text-white text-xs inline-block px-2 py-1 rounded-md">
                                                        {{ $product->productType->name }}</p>
                                                    <p
                                                        class=" bg-pearl-bush-300 text-white text-xs inline-block px-2 py-1 rounded-md">
                                                        {{ $product->productCategory->category_name }}</p>

                                                    @if ($product->fit)
                                                        <p
                                                            class="bg-pearl-bush-300 text-white text-xs inline-block px-2 py-1 rounded-md">
                                                            {{ $product->fit->fit_name }} </p>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="whitespace-nowrap text-end  px-4 py-4 text-sm text-gray-900">
                                        {{ number_format($product->sale_price) }} MMK
                                    </td>

                                    <td class="whitespace-nowrap text-end  px-4 py-4 text-sm text-gray-900">
                                        {{ $product->stock_count }}
                                    </td>

                                    <td class="whitespace-nowrap text-end px-4 py-4 text-sm text-gray-900">
                                        {{ $product->discount_percentage ? $product->discount_percentage . '%' : 0 }}
                                    </td>

                                    <td data-new-arrival-id="{{ $product->id }}"
                                        data-new-arrival="{{ $product->is_new_arrival }}"
                                        class="whitespace-nowrap text-center px-4 py-4  text-sm text-gray-900">
                                        <div>

                                            @if ($product->is_new_arrival === '1')
                                                <span
                                                    class="bg-green-500 text-white text-xs inline-flex justify-center items-center gap-x-1.5 px-3 py-1 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-3.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                    </svg>

                                                    new </span>
                                            @else
                                                <span
                                                    class="bg-blue-500 text-white text-xs inline-block px-3 py-1 rounded-full">
                                                    regular </span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                        <div>
                                            <p> {{ date('j M Y', strtotime($product->created_at)) }} </p>
                                            <p> {{ date('g:i A', strtotime($product->created_at)) }} </p>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                        <div class="">
                                            <p> {{ date('j M Y', strtotime($product->created_at)) }} </p>
                                            <p> {{ date('h:i A', strtotime($product->created_at)) }} </p>
                                        </div>
                                    </td>

                                    <td
                                        class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex items-center justify-center">



                                        <a href ="{{ route('product.show', ['product' => $product->id]) }}"
                                            class="px-2 py-1 hover:bg-gray-100 inline-flex justify-center items-center">
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

                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('scripts')
@endpush
