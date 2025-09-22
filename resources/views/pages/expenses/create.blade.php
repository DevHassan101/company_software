<x-app-layout>
    <x-slot name="header">
        {{ __('Expenses') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>create expense</h1>
        </div>
        <a href="{{ route('expense.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('expense.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf

            <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Select Type <span class="text-red-500">*</span>
                    </label>
                    <select name="type" class="border border-gray-900 capitalize rounded w-full py-1.5 text-black">
                        <option value="">select one</option>
                        <option value="utility-bill" @selected(old('type') == 'utility-bill')>utility bill</option>
                        <option value="asset" @selected(old('type') == 'asset')>asset</option>
                        <option value="marketing" @selected(old('type') == 'marketing')>marketing</option>
                        <option value="sale" @selected(old('type') == 'sale')>sale</option>
                        <option value="domain-server" @selected(old('type') == 'domain-server')>domain server</option>
                        <option value="ai" @selected(old('type') == 'ai')>ai</option>
                        <option value="refreshment" @selected(old('type') == 'refreshment')>refreshment</option>
                        <option value="furniture-maintaineance" @selected(old('type') == 'furniture-maintaineance')>furniture maintaineance
                        </option>
                        <option value="other" @selected(old('type') == 'other')>other</option>

                    </select>
                    @error('type')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
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

</x-app-layout>
