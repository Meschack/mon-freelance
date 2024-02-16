<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sellers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-10">
            <h3>Sellers</h3>

            <table class="table-fixed border">
                <thead class="text-start">
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $seller)
                        <tr>
                            <td>{{ $seller->firstname }}</td>
                            <td>{{ $seller->lastname }}</td>
                            <td>{{ $seller->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
