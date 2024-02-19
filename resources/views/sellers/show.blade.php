@extends('layouts.customer.app')

@section('title', "MonFreelance | $seller->firstname $seller->lastname")

@section('content')
    <div class="banner border">
        <div class="w-full h-[200px] bg-slate-200"></div>

        <div class="p-5">
            <h1 class="">{{ $seller->firstname }} {{ $seller->lastname }}</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 items-start">
        <div class="flex flex-col gap-10">
            <div class="bio flex flex-col gap-5">
                <h4>Biographie</h4>
                <p class="text-justify">
                    {{ $seller->bio }}
                </p>
            </div>

            <x-seller-stats :seller="$seller" />
        </div>

        <div class="col-span-3 grid grid-cols-3 gap-5">
            <div class="col-span-3 flex items-center justify-between">
                <h3>Services</h3>
                @auth
                    @if (auth()->id() === $seller->id)
                        <a class="btn justify-self-end !px-10" href="{{ route('service.create') }}">New</a>
                    @endif
                @endauth
            </div>

            @if (session('success'))
                <div class="bg-blue-600 border-blue-600 text-white py-5 px-3 rounded col-span-3">
                    {{ session('success') }}
                </div>
            @endif

            @foreach ($services as $service)
                <x-service-card :service="$service"></x-service-card>
            @endforeach

            <div class="col-span-3 flex items-center justify-end">
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection
