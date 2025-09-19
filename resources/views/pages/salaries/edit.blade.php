<x-app-layout>
    <x-slot name="header">
        {{ __('Salaries') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>edit salary</h1>
        </div>
        <a href="{{ route('salary.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('salary.update', $salary->id) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select User <span class="text-red-500">*</span>
                    </label>
                    <select name="user_id" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $salary->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="amounts">
                        Amount <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="amount" name="amount" type="number" value="{{ $salary->amount }}"
                        placeholder="Enter amount">
                    @error('amount')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2 capitalize" for="receipt">
                        receipt
                    </label>
                    @php
                        $receipts = json_decode($salary->receipt, true);
                    @endphp
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="receipt" name="receipt[]" multiple type="file">
                    <div class="flex flex-wrap justify-start gap-4">
                        @if ($receipts && count($receipts) > 0)
                            @foreach ($receipts as $receipt)
                                <img src="{{ asset($receipt) }}" alt="image not found"
                                    class="w-32 h-32 rounded-full border object-cover shadow-md">
                            @endforeach
                        @endif
                    </div>
                    @error('receipt')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="paid_for">
                        Paid For <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="paid_for" name="paid_for" value="{{ $salary->paid_for }}" type="date">
                    @error('paid_for')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-1 font-medium capitalize text-black">description</label>
                <textarea id="description" name="description" rows="6" placeholder="Write description here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ $salary->description }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
