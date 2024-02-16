@props(['service'])


<div class="border flex flex-col gap-5 relative">
    <div class="aspect-square w-full bg-gray-200"></div>

    <div class="p-2 flex flex-col gap-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="aspect-square w-8 rounded-full bg-gray-300"></div>
                <span>{{ $service->user->firstname }} {{ $service->user->lastname }}</span>
            </div>

            <span>{{ $service->price }}€</span>
        </div>

        <div>
            <h4 class="text-[18px] font-normal truncate">{{ $service->title }}</h4>
        </div>
    </div>

    <a href="{{ route('service.show', compact('service')) }}" class="absolute inset-0"></a>
</div>
