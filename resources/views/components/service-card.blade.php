@props(['service'])


<div class="border flex flex-col gap-5 relative">
    <div class="aspect-video w-full overflow-hidden bg-gray-200">
        @if ($service->miniature)
            <img class="" src="{{ $service->imageUrl() }}"
                alt="Miniature of the service titled {{ $service->title }}">
        @endif
    </div>

    <div class="p-2 flex flex-col gap-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="aspect-square w-8 rounded-full items-center justify-center flex bg-gray-300 text-gray-800 overflow-hidden">

                    @if ($service->user->profile_photo_path === null)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-user">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="10" r="3" />
                            <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                        </svg>
                    @else
                        <img src="{{ $service->user->profile_photo_path }}" class="rounded-full" alt="">
                    @endif
                </div>
                <span>{{ $service->user->firstname }} {{ $service->user->lastname }}</span>
            </div>

            <span>{{ $service->price }}€</span>
        </div>

        <div>
            <h4 class="text-[18px] font-normal truncate">{{ $service->title }}</h4>
        </div>
    </div>

    <a href="{{ route('service.show', compact('service')) }}" class="absolute inset-0"></a>

    @auth
        @if (auth()->id() === $service->user_id)
            <x-danger-button x-data=""
                class="p-2 rounded-full !text-red-700 bg-white absolute cursor-pointer top-3 right-3 "
                x-on:click.prevent="$dispatch('open-modal', 'confirm-service-deletion')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-trash-2">
                    <path d="M3 6h18" />
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                    <line x1="10" x2="10" y1="11" y2="17" />
                    <line x1="14" x2="14" y1="11" y2="17" />
                </svg>
            </x-danger-button>

            <a href="{{ route('service.edit', compact('service')) }}"
                class="!p-2 btn rounded-full !text-blue-600 !bg-white absolute cursor-pointer top-3 right-16 ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-square-pen">
                    <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z" />
                </svg>
            </a>

            <x-modal name="confirm-service-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('service.destroy', compact('service')) }}" class="p-6">
                    @csrf

                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete this service?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once this service is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete this service.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                            placeholder="{{ __('Password') }}" />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete Service') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        @endif
    @endauth
</div>
