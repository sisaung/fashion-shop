@extends('components.public.accountLayout')
@section('container')
    <div class="bg-white rounded-lg  py-6">

        <p class="font-heading text-stone-600 px-5 mb-3"> Available Payment Methods </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 px-5">
            <div>
                <div class="border border-pearl-bush-400 rounded-lg p-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-pearl-bush-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span class="font-medium text-gray-700">Cash On Delivery</span>
                </div>
            </div>
            <div></div>
            <div></div>


        </div>
    </div>
@endsection
