<x-app-layout>
    <x-slot name="header">
        {{ __('Task') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>edit payment</h1>
        </div>
        <a href="{{ route('payment.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('payment.update', $payment->id) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="project_id">
                        Project <span class="text-red-500">*</span>
                    </label>
                    <select name="project_id" id="project_id"
                        class="border border-gray-900 rounded w-full py-2 text-black">
                        <option value="">select one</option>
                        @foreach ($projects as $project)
                            <option data-budget="{{ $project->budget }}" data-paid-amount="{{ $project->paidAmount }}" value="{{ $project->id }}"
                                @selected(old('project_id', $payment->project_id) == $project->id)>
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
                        Amount <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="amount" name="amount" type="number" value="{{ old('amount', $payment->amount) }}"
                        placeholder="Enter amount">

                    @error('amount')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media <span class="text-red-500">*</span>
                    </label>
                    @php
                        $medias = json_decode($payment->media, true);
                    @endphp
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media[]" multiple type="file">
                    @if ($medias && count($medias) > 0)
                        <div class="flex">
                            @foreach ($medias as $media)
                                <div>
                                    <img src="{{ asset($media) }}" alt="image not found" class="w-28 h-28" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @error('media.*')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="note" class="block mb-1 font-medium capitalize text-black">note</label>
                <textarea id="note" name="note" rows="6" placeholder="Write note here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ $payment->note }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
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
</x-app-layout>
