<x-app-layout>
    <x-slot name="header">
        {{ __('Clients') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all clients</h1>
        </div>
        <a href="{{ route('client.create') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            add
        </a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success bg-green-600 text-white my-3 p-5">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        #
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Client Info
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Contact Details
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Reference
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($clients as $client)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset($client->profile) }}" alt="image not found"
                                    class="h-12 w-12 rounded-full bg-gray-50">
                                <div>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Name: </b>{{ $client->name }}</p>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Company Name:
                                        </b>{{ $client->company_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <a href="mailto:{{ $client->email }}" class="text-gray-900 whitespace-no-wrap"><b>Email:
                                </b>{{ $client->email }}</a>
                            <p class="text-gray-900 whitespace-no-wrap"><b>Phone: </b>{{ $client->phone }}</p>
                            <p class="text-gray-900 whitespace-no-wrap"><b>Whatsapp: </b>{{ $client->whatsapp }}</p>
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p>{{ \Illuminate\Support\Str::words($client->reference, 5, '...') }}</p>

                        </td>
                        <td class="border-gray-200 bg-white p-5">
                            <div class="flex items-center justify-center gap-4 mb-4">

                                <a href="{{ route('client.edit', $client->id) }}"
                                    class="px-4 py-2 text-sm font-medium rounded-lg border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                    Edit
                                </a>

                                <a href="{{ route('client.show', $client->id) }}"
                                    class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>

                                <form action="{{ route('client.destroy', $client->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium rounded-lg border border-red-700 text-red-700 hover:bg-red-700 hover:text-white transition">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>

        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{ $clients->links() }}
        </div>
    </div>

</x-app-layout>
