@extends('layout.dashboard')

@section('content')
    <div>


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Manage Product',
        ])

        @include('admin.product.header')

        <div id="product-list-container">
            <section class="mt-10 px-5  drop-down-modal ">
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200 ">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-stone-50 sorting-wrapper">
                            <tr>
                                <th data-sortby="id" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">

                                    @include('components.admin.sortTable', ['sortTitle' => 'ID'])

                                </th>


                                <th data-sortby="product_name" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Product',
                                    ])

                                </th>

                                <th data-sortby="display_price" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Sale Price',
                                    ])

                                </th>



                                <th data-sortby="stock_count" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Stock Count',
                                    ])

                                </th>

                                <th data-sortby="stock_count" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'Discount',
                                    ])

                                </th>

                                <th data-sortby="is_new_arrival" scope="col"
                                    class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                    @include('components.admin.sortTable', [
                                        'sortTitle' => 'New Arrival',
                                    ])

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


                            @foreach ($products as $product)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $product->id }}
                                    </td>


                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">

                                        <div class="flex gap-x-3">
                                            <div class="size-12">
                                                @if ($product->productImages->first())
                                                    <img src="{{ $product->productImages->first()->thumbnail }}"
                                                        class=" object-cover object-center rounded-md" alt="">
                                                @else
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949"
                                                        class="w-full h-full object-cover object-center rounded-md"
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
                                                    @foreach ($product->fits as $fit)
                                                        <p
                                                            class="bg-pearl-bush-300 text-white text-xs inline-block px-2 py-1 rounded-md">
                                                            {{ $fit->fit_name }} </p>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="whitespace-nowrap text-end  px-4 py-4 text-sm text-gray-900">
                                        {{ $product->sale_price }}
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
                                        <div class="mt-3">
                                            <label class="inline-flex items-center mb-5 cursor-pointer">
                                                <input type="checkbox" value="" class="sr-only peer"
                                                    {{ $product->is_new_arrival ? 'checked' : '' }}>
                                                <div
                                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:bg-blue-600 ">
                                                </div>

                                            </label>
                                        </div>
                                    </td>


                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                        <div class="">
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
                                        class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex justify-center">



                                        <button id="dropdownDefaultButton-{{ $product->id }}"
                                            data-dropdown-toggle="dropdown-{{ $product->id }}" class="cursor-pointer"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>

                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdown-{{ $product->id }}"
                                            class="z-10 hidden bg-white menu-box-shadow -translate-x-6 divide-y divide-gray-100 rounded-lg w-40">
                                            <div class="py-3 flex flex-col justify-start items-start text-sm text-gray-600"
                                                aria-labelledby="dropdownDefaultButton-{{ $product->id }}">

                                                {{-- delete btn for modal --}}
                                                <button data-modal-target="popup-modal-{{ $product->id }}"
                                                    data-modal-toggle="popup-modal-{{ $product->id }}"
                                                    class=" w-full px-5 hover:bg-gray-100 inline-flex py-2 items-center gap-x-3 cursor-pointer"
                                                    type="button" data-confirm-delete>

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-gray-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    Delete
                                                </button>

                                                {{-- edit --}}

                                                <button type="button"
                                                    class="edit-product-btn w-full px-5 hover:bg-gray-100 inline-flex py-2 items-center gap-x-3 cursor-pointer"
                                                    data-edit-url="{{ route('product.edit', ['product' => $product->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-gray-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                    Edit
                                                </button>


                                                {{-- manage product image --}}

                                                <button type="button"
                                                    data-manage-image="{{ route('manage-image.edit', ['id' => $product->id]) }}"
                                                    class="manage-produdt-image-btn w-full px-5 hover:bg-gray-100 inline-flex py-2 items-center gap-x-3 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-gray-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>
                                                    Image
                                                </button>

                                                <form id="delete-form-{{ $product->id }}" class="hidden"
                                                    action="{{ route('product.destroy', ['product' => $product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="border rounded-l-md hover:bg-gray-100  inline-flex justify-center items-center border-stone-300 px-5 py-2 cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>

                                                    </button>
                                                </form>

                                            </div>
                                        </div>


                                        {{-- delete modal box --}}
                                        <div id="popup-modal-{{ $product->id }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-100">
                                                    <button type="button"
                                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full cursor-pointer text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-400 duration-300 dark:hover:text-white"
                                                        data-modal-hide="popup-modal-{{ $product->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18 18 6M6 6l12 12" />
                                                        </svg>


                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 size-10 dark:text-yellow-300"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        <h3 class="mb-5   text-gray-500 dark:text-gray-400">
                                                            Are you sure you want to delete this product <span
                                                                class="text-pearl-bush-500">{{ $product->category_name }}
                                                                ?
                                                            </span>
                                                        </h3>
                                                        <button
                                                            onclick="document.getElementById('delete-form-{{ $product->id }}').submit()"
                                                            data-modal-hide="popup-modal-{{ $product->id }}"
                                                            type="button"
                                                            class="delete-form-btn text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 cursor-pointer dark:focus:ring-red-600 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Yes, I'm sure
                                                        </button>
                                                        <button data-modal-hide="popup-modal-{{ $product->id }}"
                                                            type="button"
                                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-600 focus:outline-none bg-white rounded-lg border cursor-pointer border-pearl-bush-200 hover:bg-pearl-bush-500 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 ">No,
                                                            cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach



                        </tbody>


                    </table>
                </div>

            </section>


            <div class="pagination-wrapper">
                @include('components.pagination', ['paginator' => $products])

            </div>
        </div>



    </div>
@endsection

@push('scripts')
    @vite(['resources/js/flowbite/flowbite.min.js'])
    @vite(['resources/js/sorting.js'])
    @vite(['resources/js/search.js'])
    {{-- @vite(['resources/js/pagination.js']) --}}
    @vite(['resources/js/saveCurrentParam'])
    @vite(['resources/js/manageProductImage'])
@endpush
