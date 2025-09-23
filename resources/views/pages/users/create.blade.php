<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>create users</h1>
        </div>
        <a href="{{ route('user.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-6 md:px-8 pt-6 pb-8 mb-4" action="{{ route('user.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf

            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" name="name" value="{{ old('name') }}" type="text"
                        placeholder="Enter Username">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fname">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="fname" name="fname" value="{{ old('fname') }}" type="text"
                        placeholder="Enter Full Name">
                    @error('fname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="Email" name="email" value="{{ old('email') }}" type="text"
                        placeholder="Enter Email">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="phone" name="phone" value="{{ old('phone') }}" type="text"
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
                        id="Password" name="password" value="{{ old('password') }}" type="password" placeholder="Enter Password">
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
                        id="dob" name="dob" value="{{ old('dob') }}" type="date">
                    @error('dob')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Select Gender <span class="text-red-500">*</span>
                    </label>
                    <select name="gender" class="border border-gray-900 w-full capitalize rounded py-1.5">
                        <option value="">Select One</option>
                         <option value="male" @selected(old('gender') == 'male')>male</option>
                         <option value="female" @selected(old('gender') == 'female')>female</option>
          
                    </select>
                    @error('gender')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="profile">
                        Profile
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="profile" name="profile" type="file">
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic">
                        CNIC
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic" name="cnic" value="{{ old('cnic') }}" type="number"
                        placeholder="Enter CNIC">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic_frnt">
                        CNIC Front Photo
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic_frnt" name="cnic_frnt" value="{{ old('cnic_frnt') }}" type="file">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cnic_back">
                        CNIC Back Photo
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="cnic_back" name="cnic_back" value="{{ old('cnic_back') }}" type="file">
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="salary">
                        Salary <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="salary" name="salary" value="{{ old('salary') }}" type="number"
                        placeholder="Enter salary">
                    @error('salary')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Select Designation <span class="text-red-500">*</span>
                    </label>
                    <select name="designation" class="border capitalize border-gray-900 rounded w-full py-1.5 text-black">
                        <option value="">select one</option>
                        <option value="founder" @selected(old('designation') == 'founder')>founder</option>
                        <option value="co-founder" @selected(old('designation') == 'co-founder')>co founder</option>
                        <option value="human-resource" @selected(old('designation') == 'human-resource')>human resource</option>
                        <option value="project-manager" @selected(old('designation') == 'project-manager')>project manager</option>
                        <option value="team-lead" @selected(old('designation') == 'team-lead')>team lead</option>
                        <option value="QA" @selected(old('designation') == 'QA')>QA</option>
                        <option value="frontend-developer" @selected(old('designation') == 'frontend-developer')>frontend developer</option>
                        <option value="backend-developer" @selected(old('designation') == 'backend-developer')>backend developer</option>
                        <option value="full-stack-web-developer" @selected(old('designation') == 'full-stack-web-developer')>full stack web developer
                        </option>
                        <option value="android-developer" @selected(old('designation') == 'android-developer')>android developer</option>
                        <option value="ios-developer" @selected(old('designation') == 'ios-developer')>ios developer</option>
                        <option value="full-stack-app-developer" @selected(old('designation') == 'full-stack-app-developer')>full stack app developer
                        </option>
                        <option value="graphic-designer" @selected(old('designation') == 'graphic-designer')>graphic designer</option>
                        <option value="video-editor" @selected(old('designation') == 'video-editor')>video editor</option>
                        <option value="seo" @selected(old('designation') == 'seo')>seo</option>
                    </select>
                    @error('designation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                    Address
                </label>
                <textarea id="address" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write here..." name="address">{{ old('address') }}</textarea>
                @error('address')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-start">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Create
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
