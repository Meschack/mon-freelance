<form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
    @csrf

    <div class="form-control-wrapper">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
            autofocus autocomplete="title" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="form-control-wrapper">
        <x-input-label for="description" :value="__('description')" />
        <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required
            autocomplete="description" class="block mt-1 w-full">
            {{ old('description') }}
        </textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="flex items-center gap-10 md:flex-row flex-col w-full">
        <div class="form-control-wrapper basis-1/2">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')"
                required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div class="form-control-wrapper basis-1/2">
            <x-input-label for="category_id" :value="__('Category')" />
            <select name="category_id" id="category_id" class="w-full">
                @foreach ($categories as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-control-wrapper">
        <x-input-label for="miniature" :value="__('Miniature (Max 2MB)')" />
        <x-text-input id="miniature" class="block mt-1 w-full border border-gray-500" type="file" name="miniature"
            required autocomplete="miniature" />
        <x-input-error :messages="$errors->get('miniature')" class="mt-2" />
    </div>

    <button type="submit" class="btn">Create</button>
</form>
