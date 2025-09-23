@extends('admin.layouts.app')

@section('content')

    <div class="flex justify-between items-center my-6">
        <h1 class="text-2xl font-bold text-gray-800">Payment Information</h1>
        <a href="{{ route('payment.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-8xl mx-auto bg-white border border-gray-300 rounded-2xl shadow-xl p-8">
        <div class="flex items-center space-x-6 border-b pb-6 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 capitalize">Project Name: {{ $payment->project->name }}</h2>
                <p class="text-gray-500">Budget: {{ $payment->project->budget }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="font-semibold text-gray-700">Total Amount</p>
                <p class="text-gray-600">{{ $payment->amount }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Total Paid</p>
                <p class="text-gray-600">{{ $payment->project->paid_amount }}</p>
            </div>
        </div>
        @php
            $medias = json_decode($payment->media, true);
        @endphp


        <div class="mt-8">
            <h3 class="text-xl font-semibold border-b pb-6 mb-6">Details</h3>
            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                <div class="flex flex-wrap justify-start gap-4">
                    @if ($medias && count($medias) > 0)
                        @foreach ($medias as $media)
                            <img src="{{ asset($media) }}" alt="image not found"
                                class="w-32 h-32 border shadow-md">
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection