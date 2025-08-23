<x-app-layout>
    <x-slot name="header">
        {{ __('Task') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>create task</h1>
        </div>
         <a href="{{ route('task.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('task.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-2">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title" name="title" type="text" placeholder="Enter title">
                    @error('title')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        project
                    </label>
                    <select name="project_id" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                    @error('project_id')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select User
                    </label>
                    <select name="user_id" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Select Status
                    </label>
                    <select name="status" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="">select one</option>
                        <option value="pending">pending</option>
                        <option value="ongoing">ongoing</option>
                        <option value="completed">completed</option>
                        <option value="rejected">rejected</option>
                        <option value="failed">failed</option>

                    </select>
                    @error('status')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media" type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div> --}}


            <div class="mb-4">
                <label for="note" class="block mb-1 font-medium capitalize text-black">description</label>
                <textarea id="note" name="description" rows="6" placeholder="Write note here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create
                </button>
            </div>
        </form>

    </div>

</x-app-layout>
