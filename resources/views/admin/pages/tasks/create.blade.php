@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>create task</h1>
        </div>
        <a href="{{ route('admin.task.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('admin.task.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title" name="title" value="{{ old('title') }}" type="text" placeholder="Enter title">
                    @error('title')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="project">
                        Project <span class="text-red-500">*</span>
                    </label>
                    <select name="project_id" class="border border-gray-900 rounded w-full py-1.5 text-black">
                        <option value="">select one</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="userDropdown">
                        Select Users <span class="text-red-500">*</span>
                    </label>
                    <select multiple name="admin_ids[]" id="userDropdown" style="width: 100%";
                        class="border border-gray-900 rounded w-full py-20">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(in_array($user->id, old('admin_id', [])))>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('admin_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="mb-4">
                <label for="note" class="block mb-1 font-medium capitalize text-black">description</label>
                <textarea id="note" name="description" rows="6" placeholder="Write note here"
                    class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create
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
@endsection
