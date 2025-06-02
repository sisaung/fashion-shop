@extends('layout.dashboard')

@section('content')
    <div>


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Brand List',
        ])

        @include('admin.brands.header')

        <section class="mt-10 px-5">
            <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                              <div class="flex items-center gap-1">
                                <div class="flex flex-col ">
                                    <a href="" class="hover:bg-stone-200 duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                        </svg>

                                    </a>
                                    <a href="" class="hover:bg-stone-200 duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>

                                    </a>

                                </div>
                               <span>
                                    ID
                               </span>
                              </div>
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                <div class="flex items-center cursor-pointer">
                                    <SortTable sort_by="brand_name">Brand Name</SortTable>
                                </div>
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
@endsection
