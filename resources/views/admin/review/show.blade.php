@extends('layout.dashboard')



@section('content')
    <div class="py-5 mt-5 bg-white rounded-lg shadow">
        <div class="flex justify-between items-center ">
            <div>
                @include('components.admin.breadcrumb', [
                    'currentPageTitle' => 'Customer Detail',
                    'links' => [['name' => 'Review List', 'path' => route('review.index')]],
                ])
            </div>


        </div>

        <h1 class="mt-10 text-xl px-5 mb-5"> Review Detail </h1>
        <section class="grid grid-cols-2 px-5">

            <div class="col-span-1">
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full divide-y divide-gray-200">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td class="bg-stone-50 px-6 py-3 text-start whitespace-nowrap font-bold">
                                    Customer Information
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 text-start whitespace-nowrap text-gray-600">
                                    <a class="underline" target="_blank"
                                        href="{{ route('customer.show', ['customer' => $review->user->id]) }}">
                                        {{ $review->user->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-stone-50 px-6 py-3 whitespace-nowrap  font-bold">Product Information</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap text-gray-600">
                                    <a class="underline" target="_blank"
                                        href="{{ route('product.show', ['product' => $review->product->id]) }}">
                                        {{ $review->product->product_name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-stone-50 px-6 py-3 whitespace-nowrap font-bold">Rating</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap text-gray-600">
                                    @include('components.admin.userRating', ['rating' => $review->rating])
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-stone-50 px-6 py-2 items-center whitespace-nowrap  flex item-center font-bold">
                                    User Review
                                    <span class="ml-4">
                                        @include('components.admin.reviewApprove', [
                                            'review' => $review,
                                        ])
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 whitespace-wrap text-gray-600">
                                    {{ $review->review }}
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-stone-50 px-6 py-3 whitespace-nowrap font-bold">Created At</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    {{ date('j M Y', strtotime($review->created_at)) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    @vite(['resources/js/approveReview.js'])
@endpush
