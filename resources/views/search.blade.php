@extends('layouts.customer.app')

@section('title', 'MonFreelance | Search : ' . $q)

@section('content')
    <h2>Recherche : {{ $q }} ({{ $services->total() }} résultats)</h2>

    <div class="grid grid-cols-4 gap-5">
        @forelse ($services as $service)
            <x-service-card :service="$service" />
        @empty
            <p class="col-span-4">We can't find any service which looks like that.</p>
        @endforelse
    </div>

    {{ $services->links() }}
@endsection
