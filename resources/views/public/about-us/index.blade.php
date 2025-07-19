@extends('layout.master')
@section('content')
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 md:py-7">

        <!-- Breadcrumbs -->

        @include('components.breadcrumb', [
            'currentPageTitle' => 'About Us',
        ])


        <!-- ABOUT TRENDFLOW Section -->

        <div class="mb-12">
            <h3 class="text-3xl font-bold text-gray-900 mb-6">ABOUT TRENDFLOW</h3>
            <p class="text-lg text-gray-600 leading-relaxed mb-10 max-w-2xl">
                LoomLuxe brings the latest fashion to your fingertips with stylish, budget-friendly pieces for every
                occasion.
                We make shopping simple, secure, and personal—so you always look and feel your best.
            </p>
            <div class="w-full h-96 overflow-hidden rounded-lg shadow-lg">
                <img src="images/2.jpg" alt="error" class="w-full h-full object-cover">
            </div>
        </div>
    @endsection
