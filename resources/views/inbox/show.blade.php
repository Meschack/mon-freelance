@php
    $contact = App\Models\User::find($conversations->keys()->first());
@endphp

@extends('layouts.customer.app')

@section('title', 'MonFreelance Inbox')

@section('content')
    <div class="h-[calc(100vh-186px)] overflow-hidden sm:h-[calc(100vh-174px)]">
        <div
            class="h-full rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:flex">
            <div class="hidden h-full flex-col xl:flex xl:w-1/4">
                <!-- ====== Chat List Start -->
                <div class="sticky border-b border-stroke px-6 py-7.5 dark:border-strokedark">
                    <h3 class="text-lg font-medium text-black flex items-center justify-between dark:text-white 2xl:text-xl">
                        <span>Active Conversations</span>
                        <span
                            class="rounded-md border-[.5px] border-stroke bg-gray-2 px-2 py-0.5 text-base font-medium text-black dark:border-strokedark dark:bg-boxdark-2 dark:text-white 2xl:ml-4">{{ $conversations->count() }}</span>
                    </h3>
                </div>
                <div class="flex max-h-full flex-1 flex-col overflow-auto p-5">
                    <div class="no-scrollbar h-full max-h-full space-y-2.5 overflow-auto">
                        @forelse ($conversations as $k => $conversation)
                            <div
                                class="flex cursor-pointer items-center rounded px-4 py-2 hover:bg-gray-2 dark:hover:bg-strokedark relative">
                                <div class="relative mr-3.5 h-11 w-full max-w-11 rounded-full flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="profile" class="h-full w-full object-cover object-center rounded-full" />
                                </div>
                                <div class="w-full">
                                    <h5 class="text-sm font-medium text-black dark:text-white">
                                        @if ($conversation->last()->sender_id === auth()->id())
                                            {{ $conversation->last()->receiver->firstname }}
                                            {{ $conversation->last()->receiver->lastname }}
                                        @else
                                            {{ $conversation->last()->sender->firstname }}
                                            {{ $conversation->last()->sender->lastname }}
                                        @endif
                                    </h5>
                                    <p class="text-sm font-medium truncate">
                                        {{ Str::substr($conversation->last()->content, 0, 25) }}...
                                    </p>
                                </div>

                                <a href="?user={{ $k }}" class="absolute inset-0"></a>
                            </div>
                        @empty
                            <div>You don't have any conversation yet</div>
                        @endforelse
                    </div>
                </div>
                <!-- ====== Chat List End -->
            </div>

            <x-chat-box :contact="$contact" :content="$content" />
        </div>
    </div>
@endsection
