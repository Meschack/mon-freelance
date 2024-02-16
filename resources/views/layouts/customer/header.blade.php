<header class="border-b flex gap-10 py-5 px-5 md:px-10 lg:px-20 sticky top-0 z-10 bg-white shadow-sm">
    <h1>
        <a href="/">MonFreelance</a>
    </h1>

    <div class="flex justify-between items-center w-full">
        <div class="w-full max-w-[500px]">
            <form action="{{ route('search') }}" method="GET" class="flex items-center justify-between gap-3">
                <input type="text" placeholder="Find a service" name="q" class="basis-full">

                <button>Search</button>
            </form>
        </div>

        <div class="rounded-full p-2">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex bg-transparent items-center px-2 py-1 text-sm font-medium text-gray-500 rounded-full border">
                        <div class="aspect-square w-8 rounded-full bg-gray-400"></div>

                        @auth()
                            <span class="ms-1">{{ Auth::user()->firstname }}</span>
                        @endauth

                        <div class="ms-3">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @auth
                        <form action="{{ route('logout') }}" method="post">
                            @csrf

                            <button type="submit" class="p-0">
                                <x-dropdown-link>
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </button>
                        </form>

                        <hr>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                    @endauth

                    @guest
                        <x-dropdown-link :href="route('login')">
                            {{ __('Sign In') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('register')">
                            {{ __('Sign Up') }}
                        </x-dropdown-link>
                    @endguest
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
