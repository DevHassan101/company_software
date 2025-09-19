<x-app-layout>
    <x-slot name="header">
        {{ __('Expenses') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all expenses</h1>

        </div>
        <a href="{{ route('expense.create') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            add
        </a>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs text-white uppercase bg-gray-50">
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        #
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Amount
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        receipt
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Type
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Added By
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
                @foreach ($expenses as $expense)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $expense->amount }}
                                </p>
                            </div>
                        </td>
                        @php
                            $receipts = json_decode($expense->receipt, true);
                        @endphp

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            @if ($receipts && count($receipts) > 0)
                                <div class="flex">
                                    @foreach ($receipts as $receipt)
                                        <div>
                                            <img src="{{ asset($receipt) }}" alt="image not found" class="w-16 h-16" />
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            {{ $expense->type }}
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            {{ $expense->user->name ?? 'N/A' }}
                        </td>

                        <td class="border-gray-200 bg-white p-5">
                            <div class="flex items-center justify-center gap-4 mb-4">
                                <a href="{{ route('expense.edit', $expense->id) }}"
                                    class="px-4 py-2 text-sm font-medium rounded-lg border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                    Edit
                                </a>

                                <a href="{{ route('expense.show', $expense->id) }}"
                                    class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>

                                <form action="{{ route('expense.destroy', $expense->id) }}" method="POST">
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
            {{ $expenses->links() }}
        </div>
    </div>

    @if (session('success'))
        @push('script')
            <script>
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            </script>
        @endpush
    @endif
</x-app-layout>
