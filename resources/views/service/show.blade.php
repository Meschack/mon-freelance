@extends('layouts.customer.app')

@section('title', 'MonFreelance | ' . $service->title)

@section('content')
    <h1>{{ $service->title }} </h1>
    <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-10">
        <div class="lg:col-span-2 xl:col-span-3 flex flex-col gap-5">
            <div class="aspect-video bg-slate-300">
                @if ($service->miniature)
                    <img src="{{ $service->imageUrl() }}"
                        alt="Miniature of service {{ $service->title }} created by {{ $service->user->firstname }} {{ $service->user->firstname }} on {{ config('app.name', 'MonFreelance') }}"
                        class="w-full">
                @endif
            </div>

            <div>
                <p class="text-justify">{{ $service->description }}</p>
            </div>

            <div class="flex items-center gap-5">
                @if (auth()->id() !== $service->user_id)
                    <a href="{{ route('sellers.show', ['seller' => $service->user]) }}"
                        class="border btn border-blue-600 bg-transparent rounded-none text-black hover:bg-blue-600 hover:text-white">Contact
                        the seller</a>

                    <form action="{{ route('order.store', ['service' => $service]) }}" method="POST">
                        @csrf

                        <button type="submit"
                            class="btn rounded-none inline-flex gap-3 items-center"><span>Order</span><span>{{ $service->price }}€</span></button>
                    </form>
                @endif

            </div>

            <div class="flex flex-col gap-5">
                <h2>Reviews</h2>

                <div class="flex flex-col gap-10">
                    @forelse ($service->orders->where('status', 'done') as $order)
                        <div class="flex !text-black gap-5 p-5 border items-start">
                            <div class="aspect-square w-12 rounded-full bg-gray-300"></div>
                            <div class="flex flex-col gap-3 flex-1">
                                <div class="flex justify-between items-center">
                                    <h4>
                                        {{ $order->user->firstname }} {{ $order->user->lastname }}
                                    </h4>

                                    <span>{{ $order->created_at }}</span>
                                </div>
                                <em>
                                    {{ $order->review_content }}
                                </em>
                            </div>

                        </div>
                    @empty
                        <p>No reviews on this service</p>
                    @endforelse
                </div>
            </div>


        </div>

        <div>
            <x-seller-stats :seller="$service->user" />
        </div>
    </div>
@endsection
