<x-guest-layout>
    <form action="{{ route('verify.store') }}" method="POST">
        @csrf

        <div>
            <x-input-label for="two_factor_code" :value="__('Two factor code')" />

            <x-text-input id="two_factor_code" type="text" name="two_factor_code" required autofocus />

            <x-input-error :messages="$errors->get('two_factor_code')" class="mt-2" />
        </div>

        <button type="submit">Verify</button>
    </form>
</x-guest-layout>
