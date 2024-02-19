<div
    {{ $attributes->merge(['class' => 'flex h-full flex-col border-l border-stroke dark:border-strokedark xl:w-3/4']) }}>
    <!-- ====== Chat Box Start -->
    <div class="sticky flex items-center justify-between border-b border-stroke px-6 py-4.5 dark:border-strokedark">
        <div class="flex items-center relative">
            <div class="mr-4.5 h-13 w-full max-w-13 overflow-hidden rounded-full">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="avatar" class="h-full w-full object-cover object-center rounded-full" />
            </div>
            <div>
                <h5 class="font-medium text-black dark:text-white">
                    {{ $contact->firstname }} {{ $contact->lastname }}
                </h5>
                <p class="text-sm font-medium">Reply to message</p>
            </div>

            @if ($contact->role->name === \App\Models\User::ROLE_SELLER)
                <a href="{{ route('sellers.show', ['seller' => $contact]) }}" class="absolute inset-0"></a>
            @endif
        </div>
    </div>
    <div class="no-scrollbar max-h-full flex-1 no-scrollbar space-y-3.5 overflow-auto px-6 py-7.5">
        @forelse ($content as $message)
            @if ($message->sender_id === auth()->id())
                <div class="ml-auto max-w-125 w-fit">
                    <div class="mb-2.5 rounded-2xl rounded-br-none bg-primary px-5 py-3">
                        <p class="font-medium text-white">
                            {{ $message->content }}
                        </p>
                    </div>
                    <p class="text-right text-xs font-medium">{{ $message->created_at }}</p>
                </div>
            @else
                <div class="max-w-125 w-fit">
                    <p class="mb-2.5 text-sm font-medium">{{ $contact->firstname }} {{ $contact->lastname }}
                    </p>
                    <div class="mb-2.5 rounded-2xl rounded-tl-none bg-gray-fake px-5 py-3 dark:bg-boxdark-2">
                        <p class="font-medium">
                            {{ $message->content }}
                        </p>
                    </div>
                    <p class="text-xs font-medium">{{ $message->created_at }}</p>
                </div>
            @endif

        @empty
            <p class="self-center justify-self-center">You dont have any messages with this user</p>
        @endforelse
    </div>
    <div class="sticky bottom-0 border-t border-stroke bg-white px-6 py-5 dark:border-strokedark dark:bg-boxdark">
        <form class="flex items-center justify-between space-x-4.5" method="POST"
            action="{{ route('message.create') }}">
            @csrf

            <input type="hidden" name="receiver_id" value="{{ $contact->id }}">
            <div class="relative w-full">
                <input type="text" placeholder="Type something here" name="content"
                    class="message-input w-full h-13" />
            </div>
            <button
                class="flex h-13 w-full max-w-13 items-center justify-center rounded-md bg-primary text-white hover:bg-opacity-90">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 2L11 13" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </form>
    </div>
    <!-- ====== Chat Box End -->
</div>
