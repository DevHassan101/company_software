<x-app-layout>
    <x-slot name="header">
        {{ __('Task') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>edit task</h1>
        </div>
        <a href="{{ route('task.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('task.update', $projectTask->id) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title <span class="text-red-500">*</span>
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
                        project <span class="text-red-500">*</span>
                    </label>
                    <select name="project_id" class="border border-gray-900 rounded w-full py-1.5 text-black">
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="userDropdown">
                        Select Users <span class="text-red-500">*</span>
                    </label>
                    <select multiple name="admin_ids[]" id="userDropdown"
                        class="border border-gray-900 rounded w-full py-20">

                        @php
                            $assignedUserIds = $projectTask->projectTaskUsers->pluck('user_id')->toArray();
                        @endphp

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(in_array($user->id, $assignedUserIds))>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('admin_ids')
                        <span class="text-red-500">{{ $message }}</span>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userDropdown').select2();

            $('#userDropdown').on('change', function() {
                console.log('hi');

            });
        });
    </script>
</x-app-layout>
