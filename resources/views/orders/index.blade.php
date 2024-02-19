@php
    $statuses = ['pending', 'done', 'cancelled'];
@endphp

@extends('layouts.customer.app')

@section('title', 'Mon Freelance | ' . auth()->user()->lastname . '\'s orders')

@section('content')
    <div class="flex items-center justify-between">
        <h1>My {{ request()->filled('type') && request('type') === 'customers' ? 'customers' : '' }}
            {{ request()->filled('status') ? request('status') : '' }} orders</h1>

        <form method="get" class="flex items-stretch gap-3">
            <select name="status" id="status">
                @foreach ($statuses as $status)
                    <option @selected(request()->has('status') ? request('status') === $status : '') value="{{ $status }}">{{ Str::ucfirst($status) }}</option>
                @endforeach
            </select>

            <input type="hidden" value="{{ request()->has('type') ? request('type') : '' }}" name="type">

            <button class="btn" type="submit">Filter</button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5">

        @forelse ($orders as $order)
            <div class="border p-5 flex flex-col gap-3 relative">
                <h5 class="text-md truncate">
                    {{ $order->service->title }}
                </h5>

                @if (auth()->id() === $order->user_id)
                    <div class="flex items-center justify-between">
                        <span>Seller</span>
                        <strong class="text-end">
                            {{ $order->service->user->firstname }} {{ $order->service->user->lastname }}
                        </strong>
                    </div>
                @endif

                @if (auth()->id() === $order->service->user_id)
                    <div class="flex items-center justify-between">
                        <span>Customer</span>
                        <strong class="text-end">
                            {{ $order->user->firstname }} {{ $order->user->lastname }}
                        </strong>
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <span>Status</span>
                    <strong class="capitalize text-end">
                        {{ Str::ucfirst($order->status) }}
                    </strong>
                </div>

                <div class="flex items-center justify-between">
                    <span>Price</span>
                    <strong class="text-end">
                        {{ $order->price }}€
                    </strong>
                </div>

                <a href="{{ route('order.show', compact('order')) }}" class="absolute inset-0"></a>
            </div>
        @empty
            <p class="col-span-full">No order found</p>
        @endforelse
    </div>

    <div class="col-span-full w-full flex items-center justify-end">
        {{ $orders->links() }}
    </div>
@endsection
