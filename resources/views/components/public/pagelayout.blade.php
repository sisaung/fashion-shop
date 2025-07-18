@extends('layout.master')
@section('content')
    <div class="max-w-7xl container mx-auto ">
        <div class="flex flex-col gap-5 lg:flex-row">


            @include('components.public.sidebar')


            <div class="flex-1 px-5 xl:px-0 h-screen overflow-y-scroll hide-scrollbar pagelayout-container">
                @yield('container')
            </div>
        </div>
    </div>
@endsection
