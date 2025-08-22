<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="flex justify-between items-center my-6">
        <h1 class="text-2xl font-bold text-gray-800">User Information</h1>
        <a href="{{ route('user.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-5xl mx-auto bg-white border border-gray-300 rounded-2xl shadow-xl p-8">
        <div class="flex items-center space-x-6 border-b pb-6 mb-6">
            <img src="{{ asset($user->userInfo?->profile) }}" alt="Profile Image"
                class="w-32 h-32 rounded-full border object-cover shadow-md">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 capitalize">{{ $user->name }}</h2>
                <p class="text-gray-500">Designation: {{ $user->designation }}</p>
                <p class="text-gray-500">Email: {{ $user->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="font-semibold text-gray-700">First Name</p>
                <p class="text-gray-600">{{ $user->userInfo?->fname }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Date of Birth</p>
                <p class="text-gray-600">{{ $user->userInfo?->dob }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Address</p>
                <p class="text-gray-600">{{ $user->userInfo?->address }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">CNIC Number</p>
                <p class="text-gray-600">{{ $user->userInfo?->cnic }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Phone Number</p>
                <p class="text-gray-600">{{ $user->userInfo?->phone }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Salary</p>
                <p class="text-gray-600">{{ $user->salary }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Gender</p>
                <p class="text-gray-600 capitalize">{{ $user->userInfo?->gender }}</p>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">CNIC Documents</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-center">
                    <p class="font-semibold mb-2">Front Side</p>
                    <img src="{{ asset($user->userInfo?->cnic_frnt) }}" alt="CNIC Front"
                        class="w-48 h-48 object-cover rounded-lg border shadow">
                </div>
                <div class="text-center">
                    <p class="font-semibold mb-2">Back Side</p>
                    <img src="{{ asset($user->userInfo?->cnic_back) }}" alt="CNIC Back"
                        class="w-48 h-48 object-cover rounded-lg border shadow">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
