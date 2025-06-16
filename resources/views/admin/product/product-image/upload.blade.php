@extends('layout.dashboard')

@section('content')
    <div class="flex justify-between items-center">
        <div>
            @include('components.admin.breadcrumb', [
                'currentPageTitle' => 'Manage Image',
                'links' => [
                    ['name' => 'Edit Product', 'path' => route('product.edit', ['product' => $product->id])],
                ],
            ])
        </div>


        <div class="px-5 flex gap-x-3 justify-center items-center">

            {{-- edit product --}}
            <div>
                <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                    class="size-12 inline-flex justify-center items-center border-2  border-pearl-bush-300 bg-pearl-bush-500 rounded-full">
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
                <p
                    class="cursor-pointer size-12 inline-flex justify-center items-center bg-pearl-bush-500 border-2  border-pearl-bush-300  rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                </p>
            </div>

            <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>

            {{-- manage stock --}}
            <div>
                <a href="{{ route('manage-stock.create', ['id' => $product->id]) }}"
                    class="size-12 inline-flex justify-center items-center border  border-pearl-bush-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 stroke-pearl-bush-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                    </svg>

                </a>
            </div>

            <div class="border-t-2 border-dashed border-t-pearl-bush-500 w-10"></div>


            {{-- product detail --}}

            <div>
                <a href="{{ route('product.show', ['product' => $product->id]) }}"
                    class="size-12 inline-flex justify-center items-center border border-dashed border-pearl-bush-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 stroke-pearl-bush-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>

                </a>
            </div>

        </div>

    </div>
    <h1 class="mt-10 text-xl px-5"> Manage Image </h1>

    <section class="mt-5 px-5">

        <div data-product-id="{{ $product->id }}"
            data-manage-image-url="{{ route('manage-image.edit', ['id' => $product->id]) }}"
            class="manage-image-upload border border-dashed border-pearl-bush-400 rounded-md px-10 py-12 flex justify-center items-center cursor-pointer hover:bg-pearl-bush-100 duration-300 ">
            <button class="cursor-pointer text-gray-600 text-sm "> Upload Image
            </button>
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="8" y="12" width="48" height="40" rx="4" stroke="black" stroke-width="2" />

                <polygon points="18 45 28 25 38 45" fill="black" />
                <polygon points="28 45 38 35 48 45" fill="black" />

                <line x1="45" y1="12" x2="45" y2="22" stroke="black" stroke-width="2"
                    stroke-linecap="round" />
                <line x1="40" y1="17" x2="50" y2="17" stroke="black" stroke-width="2"
                    stroke-linecap="round" />
            </svg>

        </div>

        <input type="file" class="hidden file" multiple>

        <div>

        </div>
    </section>

    <section class="mt-5 px-5">
        <div class="grid grid-cols-8 gap-5">
            @foreach ($product->productImages as $image)
                <div class="col-span-1 relative group ">
                    <div class="bg-black/10 absolute top-0 left-0 w-full h-full hidden group-hover:block  duration-500">
                    </div>
                    <form method="POST" action="{{ route('manage-image.destroy', ['id' => $image->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            class="absolute top-2 scale-0 group-hover:scale-100 duration-500  right-2 inline-flex justify-center items-center cursor-pointer size-5 bg-pearl-bush-400 hover:bg-pearl-bush-600 text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                                <path
                                    d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                            </svg>

                        </button>
                    </form>
                    <img src="{{ $image->preview }}"
                        class="object-cover object-center aspect-ratio border border-pearl-bush-400 rounded-md"
                        alt="{{ $product->product_name }}">
                </div>
            @endforeach
        </div>

        <div class="flex justify-end gap-3 mt-5 ">
            <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                class="text-white flex justify-center items-center gap-3 bg-pearl-bush-400 hover:bg-pearl-bush-600 font-medium rounded-lg text-sm px-5 py-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                        clip-rule="evenodd" />
                </svg>

                Product Edit


            </a>
            <a href="{{ route('manage-stock.create', ['id' => $product->id]) }}"
                class="text-white flex justify-center items-center gap-3 bg-pearl-bush-400 hover:bg-pearl-bush-600 font-medium rounded-lg text-sm px-5 py-2.5">
                Manage Stock
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
    @vite(['resources/js/manageProductImageUpload.js'])
@endpush
