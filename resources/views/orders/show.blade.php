@extends('layouts.customer.app')

@section('title', 'MonFreelance | ' . $order->service->title)

@section('content')
    @if (session('success'))
        <div class="bg-blue-600 border-blue-600 text-white py-5 px-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 h-[calc(100vh-100px)] gap-10 pb-10">
        <div class="flex flex-col gap-10 !h-full overflow-auto no-srollbar border p-5">
            <div class="flex items-baseline justify-between">
                <h3>Order Details</h3>
                <a href="{{ $order->service->details() }}" class="hover:underline underline-offset-4">See the service</a>
            </div>

            <div class="flex flex-col gap-5">
                <h4 class="text-md truncate">
                    {{ $order->service->title }}
                </h4>

                <div class="flex items-center justify-between">
                    <span>Seller</span>
                    <strong class="text-end">
                        {{ $order->service->user->firstname }} {{ $order->service->user->lastname }}
                    </strong>
                </div>

                <div class="flex items-center justify-between">
                    <span>Made at</span>
                    <strong class="text-end">
                        {{ $order->created_at }}
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

            @if ($order->status === 'pending')
                <div class="grid justify-stretch gap-5 grid-cols-2">
                    @can('update', $order)
                        <form action="{{ route('order.update', compact('order')) }}" method="post">
                            @csrf

                            @method('patch')

                            <input type="hidden" name="action" value="cancel" />

                            <button type="submit" class="w-full ghost !border-red-600 hover:!bg-red-600">Cancel order</button>
                        </form>

                        @if ($order->service->user_id === auth()->id())
                            <form action="{{ route('order.update', compact('order')) }}" method="post">
                                @csrf

                                @method('patch')

                                <input type="hidden" name="action" value="done" />

                                <button type="submit" class="btn !w-full ">Mark as done</button>
                            </form>
                        @endif
                    @endcan
                </div>
            @endif

            @if ($order->status === 'done' && $order->review_content === null && auth()->id() === $order->user_id)
                <form method="POST" action="{{ route('order.review', compact('order')) }}"
                    class="border flex flex-col gap-5 p-5">
                    @csrf

                    @method('patch')

                    <div class="form-control-wrapper basis-1/2">
                        <x-input-label for="review_type" :value="__('Review type')" />
                        <select name="review_type" id="review_type" class="w-full">
                            <option value="positive">Positive</option>
                            <option value="negative">Negative</option>
                        </select>
                        <x-input-error :messages="$errors->get('review_type')" class="mt-2" />
                    </div>

                    <div class="form-control-wrapper">
                        <x-input-label for="review_content" :value="__('Review content')" />
                        <textarea name="review_content" id="review_content" rows="5" placeholder="Description" required
                            autocomplete="review_content" class="block mt-1 w-full">{{ old('review_content') }}</textarea>
                        <x-input-error :messages="$errors->get('review')" class="mt-2" />
                    </div>

                    <button class="btn">Submit</button>
                </form>
            @endif

            @if ($order->status === 'done' && !($order->review_content === null))
                <div class="flex flex-col gap-5">
                    <h3>Review</h3>
                    <p class="flex flex-col gap-3">
                        <em>{{ $order->review_content }}</em>
                        <strong>{{ Str::ucfirst($order->review_type) }}</strong>
                    </p>
                </div>
            @else
                @if (auth()->id() === $order->service->user_id)
                    <p>This order doesn't have any review right now</p>
                @endif
            @endif
        </div>

        <div class="col-span-2 border !h-full overflow-auto">
            <x-chat-box class="xl:!w-full border" :contact="$contact" :content="$content" />
        </div>
    </div>
@endsection
