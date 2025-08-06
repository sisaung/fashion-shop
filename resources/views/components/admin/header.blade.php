<div class="bg-white shadow py-4 items-center gap-x-5 flex justify-end pr-5">

    <div class="relative inline-block">
        <button id="notifButton"
            class="relative size-8 rounded-full hover:bg-gray-100 flex items-center justify-center  cursor-pointer ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>

            <div class="hidden notif-count-container">
                <span id="notifCount"
                    class="absolute -top-1 -right-1 inline-flex items-center justify-center  bg-red-500 text-white rounded-full size-5 text-[10px] border border-white">

                </span>
            </div>
        </button>
        <div id="notifDropdown"
            class="hidden absolute right-0 mt-2 w-96 bg-white border border-gray-100  rounded shadow-md z-50">

            <div class="flex border-b px-5 py-4 border-gray-200 justify-between items-center">
                <div class="text-sm font-semibold text-gray-700">Notifications</div>
                <div class="flex items-center gap-x-3">

                    <button class="text-sm mark-all-read text-blue-500 hover:text-blue-600">Mark all read</button>

                    <button
                        class="close-noti-popup size-5 rounded-full hover:bg-gray-100 duration-300 inline-flex justify-center items-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 text-gray-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </button>
                </div>
            </div>

            <template id="notification-template">
                <li class="p-4 notification-item cursor-pointer hover:bg-gray-100">
                    <div class="flex justify-between gap-4">
                        <div class="flex gap-3">
                            <div class="relative">
                                <div class="size-2 mark-as-read bg-blue-500 rounded-full absolute top-3 -left-2.5">
                                </div>
                                <img src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1"
                                    alt="User Image"
                                    class="size-10 customer-profile rounded-full object-cover object-center" />
                            </div>
                            <div class="flex flex-col items-start justify-center gap-1">
                                <p class="text-sm font-medium"><span class="font-bold order-number"></span></p>
                                <p class="text-xs text-gray-500 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    <span class="customer-name">Emmo Mata</span>
                                </p>
                                <span
                                    class="order-status text-xs font-semibold  px-2 py-0.5 rounded-full  inline-flex items-center gap-1">

                                    <span>Pending</span>
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col items-end  gap-1">
                            <p class="text-sm font-semibold net-total">10,000,000 MMK</p>
                            <p class="text-xs text-gray-500 order-created-at">2 hours ago</p>
                            <p class="text-xs text-gray-500 total-item-count">2 items</p>
                        </div>
                    </div>
                </li>
            </template>

            <ul id="notifList"
                class="divide-y notification-container divide-gray-200 max-h-96 overflow-y-auto hide-scrollbar">

            </ul>


        </div>
    </div>

    <a href="{{ route('admin-profile.index') }}" class="">
        <div class="flex gap-2 items-center ">
            @auth
                <div>
                    @if (Auth::user()->profile_image)
                        @if (Auth::user()->google_id)
                            <img src="{{ Auth::user()->profile_image }}" alt="avatar"
                                class="size-10 object-cover object-center rounded-full">
                        @else
                            <img src="{{ asset('/storage/' . Auth::user()->profile_image) }}" alt="avatar"
                                class="size-10 object-cover object-center rounded-full">
                        @endif
                    @else
                        <img src="https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1"
                            class="size-10 object-cover object-center rounded-full" alt="fallback">
                    @endif
                </div>
                <div class="flex flex-col">
                    <p> {{ Auth::user()->name }} </p>
                    <p class="text-xs text-stone-500"> {{ Auth::user()->email }} </p>
                </div>
            @endauth



        </div>
    </a>




</div>









@push('scripts')
    <script>
        window.Laravel = {
            userId: {{ auth()->id() }}
        }
    </script>
    @vite(['resources/js/notification.js'])
@endpush
