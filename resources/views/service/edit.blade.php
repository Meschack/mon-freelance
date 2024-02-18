@extends('layouts.customer.app')

@section('title', 'MonFreelance | Edit a service')

@section('content')
    <h1>Edit a service : {{ $service->title }}</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="col-span-2">
            <form action="{{ route('service.update', compact('service')) }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col gap-5">
                @csrf

                @method('PATCH')


                <div class="form-control-wrapper">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $service->title)"
                        required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="form-control-wrapper">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required
                        autocomplete="description" class="block mt-1 w-full">
                    {{ old('description', $service->description) }}
                </textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center gap-10 md:flex-row flex-col w-full">
                    <div class="form-control-wrapper basis-1/2">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="old('price', $service->price)" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="form-control-wrapper basis-1/2">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="w-full">
                            @foreach ($categories as $k => $v)
                                <option @selected($service->category_id === $k) value="{{ $k }}">{{ $v }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-2 items-end">
                    <div class="form-control-wrapper flex-1 !justify-between">
                        <x-input-label for="miniature" :value="__('Miniature (Max 2MB)')" />
                        <x-text-input id="miniature" class="block mt-1 w-full border border-gray-500" type="file"
                            name="miniature" required autocomplete="miniature" />
                        <x-input-error :messages="$errors->get('miniature')" class="mt-2" />
                    </div>

                    @if ($service->miniature)
                        <div class="border max-w-[90px] aspect-square">
                            <img src="{{ $service->imageUrl() }}" class="!h-full w-full object-cover"
                                alt="Miniature of this service" />
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>
@endsection
