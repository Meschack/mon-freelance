<div class="stats flex flex-col border">
    <h4 class=" p-2 bg-blue-500 text-white">Seller stats</h4>
    <div class="p-2 flex flex-col gap-3">
        <p class="flex justify-between items-center">
            <span class="text-start">Total orders</span>
            <strong class="text-end">{{ $numberOfOrders }}</strong>
        </p>

        <p class="flex justify-between items-center">
            <span class="text-start">Total of done orders</span>
            <strong class="text-end">{{ $numberOfDoneOrders }}</strong>
        </p>

        <p class="flex justify-between items-center">
            <span class="text-start">Positive reviews</span>
            <strong class="text-end">{{ $numberOfPositiveReviews }}</strong>
        </p>

        <p class="flex justify-between items-center">
            <span class="text-start">Negative reviews</span>
            <strong class="text-end">{{ $numberOfNegativeReviews }}</strong>
        </p>
    </div>
    <hr>

    <div class="p-2 flex gap-3 justify-between">
        <a href="#"
            class="btn border border-blue-600 !bg-transparent !text-black hover:!bg-blue-600 hover:!text-white flex-auto text-center">Contact</a>

        @if (!request()->routeIs('sellers.show'))
            <a href="{{ route('sellers.show', compact('seller')) }}"
                class="btn border border-blue-600 !bg-transparent px-3 !text-black hover:!bg-blue-600 hover:!text-white">See
                the profile</a>
        @endif
    </div>
</div>
