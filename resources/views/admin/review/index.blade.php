@extends('layout.dashboard')

@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">


        @include('components.admin.breadcrumb', [
            'currentPageTitle' => 'Review List',
        ])

        @include('admin.review.header')

        <div id="review-list-container">
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

                                    @include('components.admin.sortTable', ['sortTitle' => 'User'])

                                </th>

                                <th data-sortby="product_name" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    @include('components.admin.sortTable', ['sortTitle' => 'Product Name'])

                                </th>


                                <th data-sortby="rating" scope="col"
                                    class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    @include('components.admin.sortTable', ['sortTitle' => 'Rating'])

                                </th>

                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">

                                    Approve

                                </th>

                                <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                    <div class="flex items-center justify-end cursor-pointer">
                                        Created
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


                            @foreach ($reviews as $review)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $review->id }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        <div class="flex gap-x-2">
                                            
                                            <div>
                                                @if ($review->user->profile_image)
                                                    @if (Str::startsWith($review->user->profile_image, 'https'))
                                                        <img src="{{ $review->user->profile_image }}"
                                                            class="h-10 w-10 rounded-full" alt="{{ $review->user->name }}">
                                                    @else
                                                        <img src="{{ asset('/storage/' . $review->user->profile_image) }}"
                                                            class="h-10 w-10 rounded-full" alt="{{ $review->user->name }}">
                                                    @endif
                                                @else
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1"
                                                        alt="{{ $review->user->name }}">
                                                @endif
                                            </div>
                                            <div class="flex flex-col gap-1">
                                                <span>{{ $review->user->name }}</span>
                                                <span class="text-gray-400"> {{ substr($review->review, 0, 20) }}... </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        {{ $review->product->product_name }}
                                    </td>

                                    <td class="whitespace-nowrap  px-4 py-4 text-sm text-gray-900">


                                        @include('components.admin.userRating', [
                                            'rating' => $review->rating,
                                        ])
                                    </td>


                                    <td class="whitespace-nowrap  px-4 py-4 text-sm text-gray-900">
                                        <div>
                                            @include('components.admin.reviewApprove', [
                                                'review' => $review,
                                            ])
                                        </div>

                                    </td>



                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end">
                                        <div class="">
                                            <p> {{ date('j M Y', strtotime($review->created_at)) }} </p>
                                            <p> {{ date('g:i A', strtotime($review->created_at)) }} </p>
                                        </div>
                                    </td>


                                    <td
                                        class="whitespace-nowrap px-4 py-4 text-sm text-gray-900 text-end flex justify-center">



                                        <button id="dropdownDefaultButton-{{ $review->id }}"
                                            data-dropdown-toggle="dropdown-{{ $review->id }}" class="cursor-pointer"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>

                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdown-{{ $review->id }}"
                                            class="z-10 hidden bg-white menu-box-shadow -translate-x-6 divide-y divide-gray-100 rounded-lg w-40">
                                            <div class="py-3 flex flex-col justify-start items-start text-sm text-gray-600"
                                                aria-labelledby="dropdownDefaultButton-{{ $review->id }}">

                                                {{-- delete btn for modal --}}
                                                <button data-modal-target="popup-modal-{{ $review->id }}"
                                                    data-modal-toggle="popup-modal-{{ $review->id }}"
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



                                                <a href="{{ route('review.show', ['review' => $review->id]) }}"
                                                    class="show-review-btn w-full px-5 hover:bg-gray-100 inline-flex py-2 items-center gap-x-3 cursor-pointer"
                                                    data-detail="{{ route('review.show', ['review' => $review->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-gray-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                    Detail
                                                </a>

                                                <form id="delete-form-{{ $review->id }}" class="hidden"
                                                    action="{{ route('review.destroy', ['review' => $review->id]) }}"
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
                                        <div id="popup-modal-{{ $review->id }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-100">
                                                    <button type="button"
                                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full cursor-pointer text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-400 duration-300 dark:hover:text-white"
                                                        data-modal-hide="popup-modal-{{ $review->id }}">
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
                                                            Are you sure you want to delete this review <span
                                                                class="text-pearl-bush-500">{{ $review->review_name }}
                                                                ?
                                                            </span>
                                                        </h3>
                                                        <button
                                                            onclick="document.getElementById('delete-form-{{ $review->id }}').submit()"
                                                            data-modal-hide="popup-modal-{{ $review->id }}"
                                                            type="button"
                                                            class="delete-form-btn text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 cursor-pointer dark:focus:ring-red-600 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Yes, I'm sure
                                                        </button>
                                                        <button data-modal-hide="popup-modal-{{ $review->id }}"
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

                            @empty($reviews)
                                <tr>
                                    <td colspan="5" class="text-center text-gray-700"> There are no reviews.
                                        <a href="{{ route('review.index') }}"> Add Review </a>
                                    </td>
                                </tr>
                            @endempty

                        </tbody>
                    </table>
                </div>
            </section>


            <div class="pagination-wrapper">
                @include('components.pagination', ['paginator' => $reviews])

            </div>
        </div>



    </div>
@endsection

@push('scripts')
    @vite(['resources/js/flowbite/flowbite.min.js'])
    @vite(['resources/js/sorting.js'])
    @vite(['resources/js/search.js'])
    {{-- @vite(['resources/js/redirectToDetail.js']) --}}
    @vite(['resources/js/approveReview.js'])

    {{-- @vite(['resources/js/pagination.js']) --}}
@endpush
