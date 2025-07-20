<a href="{{ route('admin-profile.index') }}" class="bg-white shadow py-4 flex justify-end pr-5">
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
