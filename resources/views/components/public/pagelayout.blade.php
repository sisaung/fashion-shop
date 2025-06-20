@php
    $brands = [
        ['brand_name' => 'Boss', 'brand_image' => null],
        ['brand_name' => 'Gucci', 'brand_image' => null],
        ['brand_name' => 'Prada', 'brand_image' => null],
        ['brand_name' => 'Louis Vuitton', 'brand_image' => null],
        ['brand_name' => 'Chanel', 'brand_image' => null],
        ['brand_name' => 'Dior', 'brand_image' => null],
    ];
@endphp
@extends('layout.master')
@section('content')
    <div class="max-w-7xl container mx-auto ">
        <div class="flex flex-col gap-5 lg:flex-row">


            @include('components.public.sidebar', [
                'brands' => $brands,
            ])


            <div class="flex-1">
                @yield('container')
            </div>
        </div>
    </div>
@endsection
