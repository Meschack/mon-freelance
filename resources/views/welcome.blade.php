@extends('layouts.customer.app')

@section('title', 'MonFreelance')

@section('full-width-element')
    <div class="h-[calc(100vh-80px)] w-full bg-gray-200 grid grid-cols-2">

    </div>
@endsection

@section('content')
    <div class="flex flex-col gap-10 items-center">
        <h2 class="w-fit">Our Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">
            @foreach ($categories as $category)
                <div class="border relative">
                    <div class="w-full aspect-video animate-pulse bg-gray-300">

                    </div>
                    <div class="p-2">
                        <h4 class="truncate">
                            {{ $category->label }}
                        </h4>
                        <p>
                            {{ $category->services->count() }} total services
                        </p>
                    </div>

                    <a href="{{ route('search', ['category' => $category->name]) }}" class="absolute inset-0"></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
