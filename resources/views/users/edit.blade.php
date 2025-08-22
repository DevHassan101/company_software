<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    {{-- <div class="mb-4 inline-flex overflow-hidden w-full bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center w-12 bg-blue-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                </path>
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-blue-500">Info</span>
                <p class="text-sm text-gray-600">Sample table page</p>
            </div>
        </div>
    </div> --}}

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>edit users</h1>
        </div>
        <a
            href="{{ route('user.index') }}"class="text-black hover:text-white capitalize border border-black hover:bg-black focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">back</a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('user.update', $user->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" name="name" type="text" value="{{ $user->name }}"
                        placeholder="Enter Username">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Password" name="fname" type="text" value="{{ $user->userInfo?->fname }}"
                        placeholder="Enter fname">
                    @error('fname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Email" name="email" type="text" value="{{ $user->email }}"
                        placeholder="Enter Email">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="address" name="address" type="text" value="{{ $user->userInfo?->address }}"
                        placeholder="Enter address">
                    @error('address')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Password" name="password" type="password" placeholder="Enter New Password">

                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                        Date of Birth
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="dob" name="dob" type="date" value="{{ $user->userInfo?->dob }}" placeholder="">
                    @error('dob')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="phone" name="phone" type="number" value="{{ $user->userInfo?->phone }}"
                        placeholder="Enter phone">
                    @error('phone')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                        Select Gender <span class="text-red-500">*</span>
                    </label>
                    <select name="gender" id="gender" class="border border-gray-300 w-full rounded">
                        <option value="">Select One</option>
                        <option value="male"
                            {{ old('gender', optional($user->userInfo)->gender) == 'male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="female"
                            {{ old('gender', optional($user->userInfo)->gender) == 'female' ? 'selected' : '' }}>Female
                        </option>
                    </select>
                    @error('gender')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="profile">
                        Profile <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="profile" name="profile" type="file">
                    <img src="{{ asset($user->userInfo?->profile) }}" alt="">
                    @error('profile')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic">
                        Cnic <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic" name="cnic" type="number" value="{{ $user->userInfo?->cnic }}"
                        placeholder="Enter Cnic">
                    @error('cnic')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic_frnt">
                        Cnic Front Photo <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic_frnt" name="cnic_frnt" type="file">
                    <img src="{{ asset($user->userInfo?->cnic_frnt) }}" alt="image not found">
                    @error('cnic_frnt')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic_back">
                        Cnic Back Photo <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic_back" name="cnic_back" type="file">
                    <img src="{{ asset($user->userInfo?->cnic_back) }}" alt="image not found">
                    @error('cnic_back')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                    Select Role
                </label>
                <select name="role" class="border w-full border-gray-300 rounded px-2 py-1">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ $user->getRoleNames()->contains($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>

                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>

    </div>

</x-app-layout>
