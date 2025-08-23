{{-- <style>
    .description {
        display: block;
        width: 70%;
        overflow: hidden;
        line-height: 1.5rem;
        text-align: justify;
        max-height: 4.5rem;
    }
</style> --}}


<x-app-layout>
    <x-slot name="header">
        {{ __('Payment') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all payments</h1>

        </div>
        <a href="{{ route('payment.create') }}"
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
                        Project Details
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        budget
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Media
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Amount
                    </th>

                    {{-- <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Description
                    </th> --}}

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
                @foreach ($payments as $payment)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    <b>Title: </b>{{ $payment->project->name }}
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $payment->project->budget }}</p>
                        </td>
                        @php
                            $medias = json_decode($payment->media, true);
                        @endphp

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            @if ($medias && count($medias) > 0)
                                <div class="flex">
                                    @foreach ($medias as $media)
                                        <div>
                                            <img src="{{ asset($media) }}" alt="image not found" class="w-16 h-16" />
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div>

                                <p class="text-gray-900 whitespace-no-wrap"><b>Project Amount:
                                    </b>{{ $payment->amount }}</p>

                                <p class="text-gray-900 whitespace-no-wrap capitalize"> <b>paid amount:</b>
                                    </b>{{ $payment->project->paid_amount }}</p>
                                </p>
                            </div>
                        </td>

                        {{-- <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 ">
                            <p class="text-gray-900 whitespace-no-wrap description">{{ $payment->note }}</p>
                        </td> --}}

                        <td class="border-gray-200 bg-white p-5">
                            <div class="flex items-center justify-center gap-4 mb-4">
                                <a href="{{ route('payment.edit', $payment->id) }}"
                                    class="px-4 py-2 text-sm font-medium rounded-lg border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                    Edit
                                </a>

                                <a href="{{ route('payment.show', $payment->id) }}"
                                    class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>

                                <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">
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
            {{ $payments->links() }}
        </div>
    </div>


</x-app-layout>
