<x-app-layout>
    <x-slot name="header">
        {{ __('Clients') }}
    </x-slot>

    <div class="flex justify-between items-center my-6">
        <h1 class="text-2xl font-bold text-gray-800">Client Information</h1>
        <a href="{{ route('client.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-5xl mx-auto bg-white border border-gray-300 rounded-2xl shadow-xl p-8">
        <div class="flex items-center space-x-6 border-b pb-6 mb-6">
            <img src="{{ asset($client->profile) }}" alt="Profile Image"
                class="w-32 h-32 rounded-full border object-cover shadow-md">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 capitalize">{{ $client->name }}</h2>
                <p class="text-gray-500">Email: {{ $client->email }}</p>
                <p class="text-gray-500">Company Name: {{ $client->company_name }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="font-semibold text-gray-700">Phone Number</p>
                <p class="text-gray-600">{{ $client->phone }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Whatsapp Number</p>
                <p class="text-gray-600">{{ $client->whatsapp }}</p>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-xl font-semibold border-b pb-6 mb-6">Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-justify">
                    <p class="font-semibold mb-2 capitalize">about</p>
                    <p class="text-gray-600">{{ $client->about }}</p>
                </div>
                <div class="text-justify">
                    <p class="font-semibold mb-2 capitalize">reference</p>
                    <p class="text-gray-600">{{ $client->reference }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
