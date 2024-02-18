<div class="stats flex flex-col border">
    <h4 class=" p-2 bg-blue-500 text-white">Seller stats</h4>
    <div class="p-2 flex flex-col gap-3">
        <div class="flex justify-between items-center gap-5">
            <div class="flex items-center gap-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shopping-cart">
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                </svg>
                <span class="text-start">Total orders</span>
            </div>
            <strong class="text-end">{{ $numberOfOrders }}</strong>
        </div>

        <div class="flex gap-5 justify-between items-center">
            <div class="flex items-center gap-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-check-circle-2">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
                <span class="text-start">Total of done orders</span>
            </div>
            <strong class="text-end">{{ $numberOfDoneOrders }}</strong>
        </div>

        <div class="flex justify-between items-center">
            <div class="flex items-center gap-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-thumbs-up">
                    <path d="M7 10v12" />
                    <path
                        d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z" />
                </svg>
                <span class="text-start">Positive reviews</span>
            </div>
            <strong class="text-end">{{ $numberOfPositiveReviews }}</strong>
        </div>

        <div class="flex justify-between items-center">
            <div class="flex items-center gap-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-thumbs-down">
                    <path d="M17 14V2" />
                    <path
                        d="M9 18.12 10 14H4.17a2 2 0 0 1-1.92-2.56l2.33-8A2 2 0 0 1 6.5 2H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.76a2 2 0 0 0-1.79 1.11L12 22h0a3.13 3.13 0 0 1-3-3.88Z" />
                </svg>
                <span class="text-start">Negative reviews</span>
            </div>
            <strong class="text-end">{{ $numberOfNegativeReviews }}</strong>
        </div>
    </div>

    @if (auth()->id() !== $seller->id)
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
    @endif
</div>
