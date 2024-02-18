@extends('layouts.customer.app')

@section('title', 'MonFreelance | Search : ' . $q)

@section('content')
    <h3>Recherche</h3>

    <div class="flex flex-col gap-3 text-lg">
        <span class="font-semibold">Term : {{ $q }} ({{ $services->total() }} results)</span>

        @if ($category)
            <span class="font-semibold">Category : {{ $category }}</span>
        @endif
    </div>

    <div class="grid grid-cols-4 gap-5">
        @forelse ($services as $service)
            <x-service-card :service="$service" />
        @empty
            <p class="col-span-4">We can't find any service which looks like that.</p>
        @endforelse
    </div>

    <div class="flex justify-end">{{ $services->links() }}</div>
@endsection
