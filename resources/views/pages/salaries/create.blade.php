<x-app-layout>
    <x-slot name="header">
        {{ __('Salaries') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>create salary</h1>
        </div>
        <a href="{{ route('salary.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('salary.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf

            <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select User <span class="text-red-500">*</span>
                    </label>
                    <select name="user_id" class="border border-gray-900 rounded w-full py-1.5 text-black">
                        <option value="select one">select one</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="amounts">
                        Amount <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="amount" name="amount" value="{{ old('amount') }}" type="number"
                        placeholder="Enter amount">
                    @error('amount')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2 capitalize" for="receipt">
                        receipt
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="receipt" name="receipt[]" multiple type="file">
                    @error('receipt')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-2">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="paid_for">
                        Paid For <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="paid_for" value="{{ old('paid_for') }}" name="paid_for" type="month">
                    @error('paid_for')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="paid_for">
                        Paid on <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="paid_on" value="{{ old('paid_on') }}" name="paid_on" type="date">
                    @error('paid_on')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-1 font-medium capitalize text-black">description</label>
                <textarea id="description" name="description" rows="6" placeholder="Write description here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create
                </button>
            </div>

        </form>

    </div>


    <script>
        const paidOn = document.getElementById('paid_on');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        const dateFormate = `${year}-${month}-${day}`;
        paidOn.value = dateFormate;
    </script>
</x-app-layout>
