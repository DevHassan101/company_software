<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>edit users</h1>
        </div>
        <a href="{{ route('user.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-6 md:px-8 pt-6 pb-8 mb-4" action="{{ route('user.update', $user->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" name="name" value="{{ $user->name }}" type="text"
                        placeholder="Enter Username">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fname">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="fname" name="fname" value="{{ $user->userInfo->fname }}" type="text"
                        placeholder="Enter First Name">
                    @error('fname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Email" name="email" value="{{ $user->email }}" type="text"
                        placeholder="Enter Email">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="phone" name="phone" value="{{ $user->userInfo->phone }}" type="number"
                        placeholder="Enter phone">
                    @error('phone')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Password" name="password" type="password" placeholder="Enter Password">
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">
                        Date of Birth <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="dob" name="dob" value="{{ $user->userInfo?->dob }}" type="date">
                    @error('dob')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Select Gender <span class="text-red-500">*</span>
                    </label>
                    <select name="gender" class="rounded w-full py-1.5 px-2 text-black">
                        <option value="">select one</option>
                        <option value="male" @selected($user->userInfo->gender == 'male')>male</option>
                        <option value="female" @selected($user->userInfo->gender == 'female')>female</option>
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
                    <img src="{{ asset($user->userInfo?->profile) }}" alt=""
                        class="mt-2 max-w-full h-24 object-cover rounded">
                    @error('profile')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    @error('profile')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic">
                        CNIC <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic" name="cnic" type="number" value="{{ $user->userInfo->cnic }}" placeholder="Enter CNIC">
                    @error('cnic')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic_frnt">
                        CNIC Front Photo <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic_frnt" name="cnic_frnt" type="file">
                    <img src="{{ asset($user->userInfo->cnic_frnt) }}" alt="image not found"
                        class="mt-2 max-w-full h-24 object-cover rounded">
                    @error('cnic_frnt')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic_back">
                        CNIC Back Photo <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic_back" name="cnic_back" type="file">
                    <img src="{{ asset($user->userInfo->cnic_back) }}" alt="image not found"
                        class="mt-2 max-w-full h-24 object-cover rounded">
                    @error('cnic_back')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="salary">
                        Salary <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="salary" name="salary" value="{{ $user->salary }}" type="number"
                        placeholder="Enter salary">
                    @error('salary')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Select Designation
                    </label>
                    <select name="designation" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="">select one</option>
                         <option value="founder" @selected($user->designation == 'founder')>founder</option>
                        <option value="co-founder" @selected($user->designation == 'co-founder')>co founder</option>
                        <option value="human-resource" @selected($user->designation == 'human-resource')>human resource</option>
                        <option value="project-manager" @selected($user->designation == 'project-manager')>project manager</option>
                        <option value="team-lead" @selected($user->designation == 'team-lead')>team lead</option>
                        <option value="QA" @selected($user->designation == 'QA')>QA</option>
                        <option value="frontend-developer" @selected($user->designation == 'frontend-developer')>frontend developer</option>
                        <option value="backend-developer" @selected($user->designation == 'backend-developer')>backend developer</option>
                        <option value="full-stack-web-developer" @selected($user->designation == 'full-stack-web-developer')>full stack web developer</option>
                        <option value="android-developer" @selected($user->designation == 'android-developer')>android-developer</option>
                        <option value="ios-developer" @selected($user->designation == 'ios-developer')>ios developer</option>
                        <option value="full-stack-app-developer" @selected($user->designation == 'full-stack-app-developer')>full stack app developer</option>
                        <option value="graphic-designer" @selected($user->designation == 'graphic-designer')>graphic designer</option>
                        <option value="video-editor" @selected($user->designation == 'video-editor')>video editor</option>
                        <option value="seo" @selected($user->designation == 'seo')>seo</option>
                    </select>
                    @error('designation')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                    Address <span class="text-red-500">*</span>
                </label>
                <textarea id="address" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write here..." name="address">{{ $user->userInfo->address }}</textarea>
                @error('address')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-start">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>
    </div>


</x-app-layout>
