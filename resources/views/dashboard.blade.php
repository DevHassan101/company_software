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
                    <h3 class="text-xl font-semibold text-gray-800">Total Payments</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">12,345</p>
                <p class="text-sm text-gray-500 mt-2">List of number of payments.</p>
            </div>
        </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Total Salary</h3>
                </div>
                <p class="text-5xl font-bold text-indigo-700 leading-tight">5,678</p>
                <p class="text-sm text-gray-500 mt-2">List of number of Salary.</p>
            </div>
        </div>
    </div>

</x-app-layout>
