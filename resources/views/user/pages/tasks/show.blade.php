@extends('user.layouts.app')

@section('content')
    <div class="flex justify-between items-start sm:items-center flex-row sm:my-6 my-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mt-1 sm:mb-0">Task Information</h1>
        <a href="{{ route('getTask.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="max-w-8xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-lg p-8 space-y-8">
        <!-- Task Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Project Name</p>
                <p class="mt-1 text-lg font-semibold text-gray-800">{{ $projectTask->project->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Created By</p>
                <p class="mt-1 text-lg font-semibold text-gray-800">{{ $projectTask->user?->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Title</p>
                <p class="mt-1 text-lg font-semibold text-gray-800">{{ $projectTask->title }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide">Status</p>
                <span class="inline-block mt-1 py-1 text-sm rounded-full">
                    @if ($projectTask->status == 'pending')
                        <span
                            class="bg-yellow-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900">pending</span>
                    @elseif ($projectTask->status == 'completed')
                        <span
                            class="bg-green-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900">completed</span>
                    @elseif ($projectTask->status == 'ongoing')
                        <span
                            class="bg-indigo-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-indigo-900">ongoing</span>
                    @elseif ($projectTask->status == 'rejected')
                        <span
                            class="bg-pink-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-pink-900">rejected</span>
                    @elseif ($projectTask->status == 'failed')
                        <span
                            class="bg-red-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900">failed</span>
                    @endif
                </span>
            </div>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Description</h3>
            <div class="prose max-w-none text-gray-700">
                {{ $projectTask->description ?? 'N/A' }}
            </div>
        </div>
    </div>
@endsection