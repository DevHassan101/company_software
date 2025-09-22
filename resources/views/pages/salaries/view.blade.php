<x-app-layout>
    <x-slot name="header">
        {{ __('Salary') }}
    </x-slot>

    <div class="flex justify-between items-center my-6">
        <h1 class="text-2xl font-bold text-gray-800">Salary Information</h1>
        <a href="{{ route('salary.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-8xl mx-auto bg-white border border-gray-300 rounded-2xl shadow-xl p-8">
        <div class="flex items-center space-x-6 border-b pb-6 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 capitalize">Added By: {{ $salary->user->name ?? "N/A" }}</h2>
                {{-- <p class="text-gray-500">Budget: {{ $payment->project->budget }}</p> --}}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="font-semibold text-gray-700">Amount</p>
                <p class="text-gray-600">{{ $salary->amount }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Type</p>
                <p class="text-gray-600">{{ $salary->type }}</p>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-xl font-semibold border-b pb-6 mb-6">Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-justify">
                    <p class="font-semibold mb-2 capitalize">description</p>
                    <p class="text-gray-600">{{ $salary->description }}</p>
                </div>
                <div class="text-justify">
                    @php
                        $receipts = json_decode($salary->receipt, true);
                    @endphp
                    <p class="font-semibold mb-2 capitalize">receipt</p>
                    <div class="flex flex-wrap justify-start gap-4">
                        @if ($receipts && count($receipts) > 0)
                            @foreach ($receipts as $receipt)
                                <img src="{{ asset($receipt) }}" alt="image not found"
                                    class="w-32 h-32 rounded-full border object-cover shadow-md">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
