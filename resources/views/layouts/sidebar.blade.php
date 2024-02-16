<aside class="max-w-[300px] flex flex-col border-r h-full w-full">
    <div class="shrink-0 flex items-center h-16">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>

    <hr />


    <div class="flex flex-col">
        <x-nav-link :href="route('dashboard')" class="hidden sm:flex p-5 items-center border" :active="request()->is('dashboard*')">
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-nav-link :href="route('customers.index')" class="hidden sm:flex p-5 border" :active="request()->is('customers*')">
            {{ __('Customers') }}
        </x-nav-link>

        <x-nav-link :href="route('sellers.index')" class="hidden sm:flex p-5 border" :active="request()->is('sellers*')">
            {{ __('Sellers') }}
        </x-nav-link>
    </div>
</aside>
