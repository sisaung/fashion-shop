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

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-center">
                                    del
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
@endpush
