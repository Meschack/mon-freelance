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
            @foreach ($seller->services as $service)
                <x-service-card :service="$service"></x-service-card>
            @endforeach
        </div>
    </div>
@endsection
