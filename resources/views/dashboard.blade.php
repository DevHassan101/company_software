<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            {{ __('You are logged in!') }}
        </div>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Total Projects</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $projectCount }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of projects.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Total Clients</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $clientCount }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of Clients.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Total Users</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">{{ $userCount }}</p>
                <p class="text-sm text-gray-500 mt-2">List of number of Users.</p>
            </div>
        </div>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">
        <div
            class="bg-white rounded-xl shadow-md border border-gray-200">
            <div class="border-b border-gray-100 px-5 py-3">
                <h1 class="text-base font-semibold text-gray-700">
                    {{ $chart1->options['chart_title'] }}
                </h1>
            </div>
            <div class="p-5">
                {!! $chart1->renderHtml() !!}
            </div>
        </div>
        
        <div
            class="bg-white rounded-xl shadow-md border border-gray-200">
            <div class="border-b border-gray-100 px-5 py-3">
                <h1 class="text-base font-semibold text-gray-700">
                    {{ $chart2->options['chart_title'] }}
                </h1>
            </div>
            <div class="p-5">
                {!! $chart2->renderHtml() !!}
            </div>
        </div>
    </div>

    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
</x-app-layout>