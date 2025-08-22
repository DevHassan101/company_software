<x-app-layout>
    <x-slot name="header">
        {{ __('Task') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>edit task</h1>
        </div>
        <a
            href="{{ route('task.index') }}"class="text-black hover:text-white capitalize border border-black hover:bg-black focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">back</a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('task.update', $projectTask->id) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-2">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title" name="title" type="text" value="{{ $projectTask->title }}"
                        placeholder="Enter title">
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
                            <option value="{{ $project->id }}"
                                {{ $project->id == $projectTask->project_id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
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
                            <option value="{{ $user->id }}"
                                {{ $user->id == $projectTask->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
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
                        <option value="pending" @selected($projectTask->status)>pending</option>
                        <option value="ongoing" @selected($projectTask->status)>ongoing</option>
                        <option value="completed" @selected($projectTask->status)>completed</option>
                        <option value="rejected" @selected($projectTask->status)>rejected</option>
                        <option value="failed" @selected($projectTask->status)>failed</option>

                    </select>
                    @error('status')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div>
                <label for="note" class="block mb-1 font-medium capitalize text-black">description</label>
                <textarea id="note" name="description" rows="6" placeholder="Write note here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ $projectTask->description }}</textarea>
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
