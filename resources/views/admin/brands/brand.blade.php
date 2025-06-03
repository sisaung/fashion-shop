@extends('layout.dashboard')

@section('content')
    <div>


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Manage Brand',
        ])

        @include('admin.brands.header')

        <section class="mt-10 px-5">
            <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th data-sortby="id" scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                @include('components.admin.sortTable', ['sortTitle' => 'ID'])

                            </th>
                            <th data-sortby="brand_name" scope="col"
                                class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                @include('components.admin.sortTable', ['sortTitle' => 'Brand Name'])

                            </th>

                            <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                <div class="flex items-center cursor-pointer">
                                    Brand Image
                                </div>
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


                        @foreach ($brands as $brand)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                    {{ $brand->id }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                    {{ $brand->brand_name }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">

                                    @if ($brand->brand_image)
                                        <img src="{{ $brand->brand_image }}" alt="{{ $brand->brand_name }}"
                                            class="size-10 rounded border border-pearl-bush-500 object-cover">
                                    @else
                                        <img src=" https://user-images.githubusercontent.com/237508/90246627-ecbda400-de2c-11ea-8bfb-b4307bfb975d.png"
                                            class="w-10 rounded-md" alt="placeholder" />
                                    @endif

                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                    <div class="">
                                        <p> {{ date('j M Y', strtotime($brand->created_at)) }} </p>
                                        <p> {{ date('g:i A', strtotime($brand->created_at)) }} </p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                    <div class="">
                                        <p> {{ date('j M Y', strtotime($brand->created_at)) }} </p>
                                        <p> {{ date('h:i A', strtotime($brand->created_at)) }} </p>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex justify-center">
                                    <form action="{{ route('brand.destroy', ['brand' => $brand]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="border  inline-flex justify-center items-center border-stone-300 px-4 py-2 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>

                                        </button>
                                    </form>
                                    <form action="{{ route('brand.edit', ['brand' => $brand->id]) }}">
                                        <button
                                            class="border inline-flex justify-center items-center border-stone-300 px-4 py-2 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>

                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </section>


        @include('components.pagination', ['paginator' => $brands])

    </div>

    {{-- <script>
        const asc = document.querySelector('.asc');
        const desc = document.querySelector('.desc');
        const params = document.location.search;
        const urlSearchParams = new URLSearchParams(params);
        const currentParams = Object.fromEntries(urlSearchParams);


        const sorting = (selector, sortBy, sortDirection) => {


            const handleSort = (e) => {


                const newParmsAsc = {
                    ...currentParams,
                    'sort_by': sortBy,
                    'sort_direction': sortDirection

                };


                const newQueryStringAsc = new URLSearchParams(newParmsAsc).toString();

                selector.href = location.origin + location.pathname + '?' + newQueryStringAsc;
            }

            selector.addEventListener('click', handleSort)
        }


        if (asc) {
            sorting(asc, 'id', 'asc');
        }

        if (desc) {

            sorting(desc, 'id', 'desc');
        }

    </script> --}}
@endsection

@push('scripts')
    @vite(['resources/js/sorting.js'])
    @vite(['resources/js/search.js'])
@endpush
