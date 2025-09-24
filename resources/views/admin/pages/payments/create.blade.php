@extends('admin.layouts.app')

@section('content')

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>create payment</h1>
        </div>
        <a href="{{ route('admin.payment.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('admin.payment.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf

            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="project_id">
                        Project <span class="text-red-500">*</span>
                    </label>
                    <select id="project_id" name="project_id"
                        class="border border-gray-900 rounded w-full py-1.5 text-black">
                        <option value="select one">select one</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" data-budget="{{ $project->budget }}"
                                data-paid-amount="{{ $project->paidAmount }}" @selected(old('project_id') == $project->id)>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    <span id="amount_info" class="mt-3 font-semibold"></span>
                    @error('project_id')
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
                    <label class="block text-gray-700 text-sm font-bold mb-2 " for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media[]" multiple type="file">
             
                </div>
            </div>

            <div class="mb-4">
                <label for="note" class="block mb-1 font-medium capitalize text-black">note</label>
                <textarea id="note" name="note" rows="6" placeholder="Write note here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('note') }}</textarea>
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
        document.getElementById('project_id').addEventListener('change', function(e) {
            e.preventDefault();

            let selectedOption = this.options[this.selectedIndex];
            let budget = selectedOption.dataset.budget;
            let paidAmount = selectedOption.dataset.paidAmount;

            document.getElementById('amount_info').innerText =
                "Budget: " + budget + " | Paid: " + paidAmount;
        });
    </script>
@endsection
