@extends('layouts.customer.app')

@section('title', 'MonFreelance | Notifications')

@section('content')
    <h1>Notifications</h1>

    <div class="flex flex-col gap-5">
        @forelse ($notifications->reverse() as $notification)
            <div class="border p-5 relative text-lg @if (!$notification->have_been_read) bg-gray-100 @endif">
                <p class="font-semibold">{{ $notification->message }}</p>
                <small class="text-gray-600">
                    Sent on {{ $notification->created_at }}
                </small>

                <a href="{{ $notification->link }}" class="absolute inset-0"></a>
            </div>

        @empty
            <p>No notification found</p>
        @endforelse
    </div>

    <div class="flex justify-end">
        {{ $notifications->links() }}
    </div>
@endsection
