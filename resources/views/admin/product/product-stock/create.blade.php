@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        <div class="flex justify-between items-center ">
            <div>
                @include('components.admin.breadcrumb', [
                    'currentPageTitle' => 'Manage Stock',
                    'links' => [
                        ['name' => 'Edit Product', 'path' => route('product.edit', ['product' => $product->id])],
                    ],
                ])
            </div>

            <div class="px-5">
                <div class="flex gap-x-3 justify-center items-center">

                    {{-- edit product --}}
                    <div>
                        <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                            class="size-12 inline-flex justify-center items-center border-2  border-pearl-bush-400 bg-pearl-bush-500 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    </div>

                    <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>

                    {{-- manage product image --}}
                    <div>
                        <a href="{{ route('manage-image.edit', ['id' => $product->id]) }}"
                            class="cursor-pointer size-12 inline-flex justify-center items-center bg-pearl-bush-500 border-2  border-pearl-bush-300  rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>

                        </a>
                    </div>

                    <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>

                    {{-- manage stock --}}
                    <div>
                        <p
                            class="size-12 inline-flex justify-center items-center border-2  border-pearl-bush-300 bg-pearl-bush-500 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                            </svg>

                        </p>
                    </div>

                    <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>


                    {{-- product detail --}}

                    <div>
                        <a href="{{ route('product.show', ['product' => $product->id]) }}"
                            class="size-12 inline-flex justify-center items-center border  border-pearl-bush-600 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 stroke-pearl-bush-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>

                        </a>
                    </div>

                </div>
            </div>
        </div>

        <h1 class="mt-10 text-xl px-5"> Create Product Stock </h1>
        <section class="mt-10">
            <div>
                <form action="{{ route('manage-stock.store', ['id' => $product->id]) }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-4 w-full gap-5 px-5">


                        <div class="relative mb-4 w-full col-span-1">
                            <label for="size"
                                class="@error('size_id')
                                    text-red-500
                                @enderror leading-7 text-sm text-gray-600">Size

                            </label>
                            <span class="text-red-500">*</span>


                            <select id="size" name="size_id"
                                class=" @error('size_id')
                                    is-invalid
                                @enderror block w-full  p-2.5  rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 ">
                                <option selected class="text-sm text-gray-700">Choose size</option>
                                @foreach ($product->productType->sizes as $size)
                                    <option value="{{ $size->id }}"> {{ $size->size_name }} </option>
                                @endforeach
                            </select>
                            @error('size_id')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- product name --}}
                        <div class="relative mb-4 col-span-1">
                            <label for="stock_quantity"
                                class="@error('stock_quantity')
                                    text-red-500
                                @enderror leading-7 text-sm text-gray-600">Stock
                                quantity
                            </label>
                            <span class="text-red-500">*</span>

                            <input type="text" id="stock_quantity" name="stock_quantity"
                                value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                class="@error('stock_quantity')
                                    is-invalid
                                @enderror w-full bg-white rounded border border-gray-300 focus:border-pearl-bush-400 focus:ring-2 focus:ring-pearl-bush-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('stock_quantity')
                                <p class="text-sm text-red-500"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1 flex flex-col justify-center">
                            <button
                                class="text-white text-nowrap bg-pearl-bush-400 border-0 py-2 px-8 focus:outline-none hover:bg-pearl-bush-600 rounded text-sm  cursor-pointer w-1/2 duration-300">Add
                                Stock</button>

                        </div>

                        <div class="col-span-1"></div>

                    </div>

                </form>
            </div>
        </section>
        <section class="px-5 mt-10">
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

                                Size

                            </th>

                            <th data-sortby="display_price" scope="col"
                                class="px-4 text-nowrap py-3 text-end text-sm font-medium text-gray-500">

                                Stock Quantity
                            </th>


                            <th scope="col" class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
                                <div class="flex items-center justify-end cursor-pointer">
                                    Created
                                </div>
                            </th>
                            <th scope="col" class="px-4 text-nowrap py-3 text-left text-sm font-medium text-gray-500">
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
                    <tbody class="divide-y divide-gray-200 bg-white body-container">



                        @foreach ($stocks as $index => $stock)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $stock->size->size_name }}
                                </td>
                                <td class="whitespace-nowrap text-end px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $stock->stock_quantity }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                    <div class="">
                                        <p> {{ date('j M Y', strtotime($stock->created_at)) }} </p>
                                        <p> {{ date('g:i A', strtotime($stock->created_at)) }} </p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                    <div class="">
                                        <p> {{ date('j M Y', strtotime($stock->created_at)) }} </p>
                                        <p> {{ date('h:i A', strtotime($stock->created_at)) }} </p>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-center">

                                    <button class="cursor-pointer" data-modal-target="popup-modal-{{ $stock->id }}"
                                        data-modal-toggle="popup-modal-{{ $stock->id }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="size-6 stroke-pearl-bush-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>



                                    </button>
                                    {{-- modal for delete confirmation --}}
                                    <div id="popup-modal-{{ $stock->id }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full cursor-pointer text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-400 duration-300 dark:hover:text-white"
                                                    data-modal-hide="popup-modal-{{ $stock->id }}">
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
                                                        Are you sure you want to delete this stock for size <span
                                                            class="text-pearl-bush-500">{{ $stock->size->size_name }}
                                                            ?
                                                        </span>
                                                    </h3>
                                                    <button
                                                        onclick="document.getElementById('delete-form-{{ $stock->id }}').submit()"
                                                        data-modal-hide="popup-modal-{{ $stock->id }}" type="button"
                                                        class="delete-form-btn text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 cursor-pointer dark:focus:ring-red-600 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Yes, I'm sure
                                                    </button>
                                                    <button data-modal-hide="popup-modal-{{ $stock->id }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-600 focus:outline-none bg-white rounded-lg border cursor-pointer border-pearl-bush-200 hover:bg-pearl-bush-500 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 ">No,
                                                        cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form class="hidden" id="delete-form-{{ $stock->id }}"
                                        action="{{ route('manage-stock.destroy', ['id' => $product->id, 'stockId' => $stock->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="cursor-pointer">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-6 stroke-pearl-bush-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>



                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach



                    </tbody>


                </table>
            </div>
            <div class="flex justify-end gap-3 mt-5 ">
                <a href="{{ route('manage-image.edit', ['id' => $product->id]) }}"
                    class="text-white flex justify-center items-center gap-3 bg-pearl-bush-400 hover:bg-pearl-bush-600 font-medium rounded-lg text-sm px-5 py-2.5">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                            clip-rule="evenodd" />
                    </svg>
                    Manage Image

                </a>
                <a href="{{ route('product.show', ['product' => $product->id]) }}"
                    class="text-white flex justify-center items-center gap-3 bg-pearl-bush-400 hover:bg-pearl-bush-600 font-medium rounded-lg text-sm px-5 py-2.5">
                    Product Detail
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                            clip-rule="evenodd" />
                    </svg>

                </a>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        // Show success messages
        @if (session('success'))
            Toastify({
                text: @json(session('success')),
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
        @endif
    </script>
@endpush
