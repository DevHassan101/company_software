@php
    $i = 0;
@endphp
<tbody id="client-table-body">


@forelse ($records as $client)
    <tr>
        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
            <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
        </td>
        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
            <div class="flex gap-2 items-center">
                <img src="{{ asset($client->profile) }}" alt="image not found" class="h-12 w-12 rounded-full bg-gray-50">
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
            <div>
                {{ $records->links() }}
            </div>
        </td>

    </tr>
@empty
    <tr>
        <td colspan="4">
            <p class="text-center text-red-500">
                No record found
            </p>
        </td>
    </tr>
@endforelse
</tbody>
