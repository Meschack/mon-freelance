@extends('layouts.customer.app')

@section('title', 'Mon Freelance | ' . auth()->user()->lastname . '\'s orders')

@section('content')
    <h1>My Orders</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5">

        @forelse ($orders as $order)
            <div class="border p-5 flex flex-col gap-3">
                <h5 class="text-md truncate">
                    {{ $order->service->title }}
                </h5>

                <div class="flex items-center justify-between">
                    <span>Seller</span>
                    <strong class="text-end">
                        {{ $order->service->user->firstname }} {{ $order->service->user->lastname }}
                    </strong>
                </div>

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
            </div>
        @empty
            <p class="col-span-full">No order found</p>
        @endforelse
    </div>

    <div class="col-span-full w-full flex items-center justify-end">
        {{ $orders->links() }}
    </div>
@endsection
