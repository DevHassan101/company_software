<x-app-layout>
    <x-slot name="header">
        {{ __('Clients') }}
    </x-slot>

    <div class="flex justify-between items-start sm:items-center flex-row sm:my-6 my-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mt-1 sm:mb-0">Client Information</h1>
        <a href="{{ route('client.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-5xl mx-auto bg-white border border-gray-300 rounded-2xl shadow-xl p-6 md:p-8">

        <div
            class="flex flex-col md:flex-row items-start space-x-0 space-y-6 md:space-y-0 md:space-x-6 border-b pb-6 mb-6 md:text-left">
            <img src="{{ asset($client->profile) }}" alt="Profile Image"
                class="w-24 h-24 md:w-32 md:h-32 rounded-full border object-cover shadow-md">
            <div>
                <h2 class="text-xl md:text-3xl font-bold text-gray-900 capitalize">{{ $client->name }}</h2>
                <p class="text-gray-500 text-sm md:text-base">Email: {{ $client->email }}</p>
                <p class="text-gray-500 text-sm md:text-base">Company Name: {{ $client->company_name }}</p>
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
            <h3 class="text-lg md:text-xl font-semibold border-b pb-4 mb-6">Details</h3>
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
