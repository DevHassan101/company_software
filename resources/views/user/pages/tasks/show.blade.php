@extends('user.layouts.app')

@section('content')

    <div class="flex justify-between items-start sm:items-center flex-row sm:my-6 my-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mt-1 sm:mb-0">Task Information</h1>
        <a href="{{ route('getTask.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-5xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-lg p-8 space-y-8">

        <!-- Task Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Project Name</p>
                <p class="mt-1 text-lg font-semibold text-gray-800">{{ $projectTask->project->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Created By</p>
                <p class="mt-1 text-lg font-semibold text-gray-800">{{ $projectTask->user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Title</p>
                <p class="mt-1 text-lg font-semibold text-gray-800">{{ $projectTask->title }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Status</p>
                <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full">
                    {{ $projectTask->status }}
                </span>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Description</h3>
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($projectTask->description)) !!}
            </div>
        </div>
    </div>
@endsection
