<style>
    .project {
        display: block;
        width: 100%;
        overflow: hidden;
        line-height: 1.5rem;
        text-align: justify;
        max-height: 4.5rem;
        padding-left: 24px;
        padding-right: 24px;
        transition: all 0.3s ease;
    }

    .project.expanded {
        max-height: 200px;
        overflow: scroll;
    }
</style>


<x-app-layout>
    <x-slot name="header">
        {{ __('Projects') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>projects view</h1>
        </div>
        <a href="{{ route('project.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            back
        </a>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-1 gap-4 mb-4">
        <div class=" bg-white p-5 rounded-md">
            <h4 class="mb-2 capitalize font-bold text-gray-800 mx-6">Title</h4>
            <div class="relative">
                <p class="project text-gray-600">
                    {{ $project->name }}
                </p>
            </div>
        </div>
    </div>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class=" bg-white p-5 rounded-md">
            <h4 class="mb-2 capitalize font-bold text-gray-800 mx-6">Description</h4>
            <div class="relative">
                <p class="project text-gray-600" id="desc">
                    {{ $project->description }}
                </p>
                <button onclick="toggleText('desc', this)" class="mx-6 hover:underline mt-1 block text-sm font-medium">
                    Show more
                </button>
            </div>
        </div>

        <div class=" bg-white p-5 rounded-md">
            <h4 class="mb-2 capitalize font-bold text-gray-800 mx-6">Requirements</h4>
            <div class="relative">
                <p class="project text-gray-600" id="req">
                    {{ $project->requirments }}
                </p>
                <button onclick="toggleText('req', this)" class="mx-6 hover:underline mt-1 block text-sm font-medium">
                    Show more
                </button>
            </div>
        </div>
    </div>


    <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <div class="inline-block overflow-hidden min-w-full rounded-lg">
            <div class="py-4 bg-white border-b-4 border-green-600 capitalize text-gray-600 font-bold">
                <div class="flex justify-between items-center px-4">
                    <div>
                        <h1>notes</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-plus text-sm ms-4 cursor-pointer"
                            onclick="projectNotes('crud-modal'); return false;"></i>
                    </div>
                </div>
            </div>
            <!-- Notes List -->
            <div class="projectNotes">
                @if ($projectNotes && $projectNotes->count() > 0)
                    @foreach ($projectNotes as $note)
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg mt-3 hover:shadow-md transition-shadow text-center capitalize">
                            <div class="mb-3 flex justify-between items-center px-4">
                                <div>
                                    <p class="text-gray-700 pt-2 font-bold">{{ $note->note }}</p>
                                </div>
                                <div>
                                    <span><i class="fa-solid fa-eye cursor-pointer mt-4"
                                            onclick="showNote('{{ addslashes($note->note) }}', '{{ $note->media }}', '{{ addslashes($note->project->name ?? '') }}', '{{ addslashes($note->user->name ?? '') }}')">
                                        </i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>

        <div class="inline-block overflow-hidden min-w-full rounded-lg">
            <div class="py-4 bg-white border-b-4 border-blue-600 capitalize text-gray-600 font-bold">
                <div class="flex justify-between items-center px-4">
                    <div>
                        <h1>tasks</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-plus text-sm ms-4 cursor-pointer"
                            onclick="projectTasks('task-modal'); return false;"></i>
                    </div>
                </div>
            </div>

            <!-- Tasks List -->
            <div class="projectTasks">
                @if ($projectTasks && $projectTasks->count() > 0)
                    @foreach ($projectTasks as $task)
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg mt-3 hover:shadow-md transition-shadow capitalize">
                            <div class="mb-3 flex justify-between items-center px-4">
                                <div>
                                    <p class="text-gray-700 pt-2 font-bold">{{ $task->title }}</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-eye cursor-pointer mt-4"
                                        onclick="showTask('{{ addslashes($task->description) }}', '{{ addslashes(json_encode($task->media ? json_decode($task->media) : [])) }}', '{{ addslashes($task->project->name ?? '') }}', '{{ addslashes($task->createdBy->name ?? '') }}', '{{ addslashes($task->status) }}')">
                                    </i>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>

        {{-- feedback --}}
        <div class="inline-block overflow-hidden min-w-full rounded-lg">
            <div class="py-4 bg-white border-b-4 border-purple-500 capitalize text-gray-600 font-bold">
                <div class="flex justify-between items-center px-4">
                    <div>
                        <h1>feedback</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-plus text-sm ms-4 cursor-pointer"
                            onclick="projectFeedback('feedback-modal'); return false;"></i>
                    </div>
                </div>
            </div>

            <!-- Feedback List -->
            <div class="projectFeedbacks">
                @if ($projectFeedbacks && $projectFeedbacks->count() > 0)
                    @foreach ($projectFeedbacks as $feedback)
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg mt-3 hover:shadow-md transition-shadow capitalize">
                            <div class="mb-3 flex justify-between items-center px-4">
                                <div>
                                    <p class="text-gray-700 pt-2 font-bold">{{ $feedback->note }}</p>
                                </div>
                                <div>
                                    <span>
                                        <i class="fa-solid fa-eye mt-4 cursor-pointer"
                                            onclick="showFeedback('{{ addslashes($feedback->note) }}',
                                            '{{ addslashes(json_encode($feedback->media ? json_decode($feedback->media) : [])) }}',
                                            '{{ addslashes($feedback->project->name ?? '') }}',
                                            '{{ addslashes($feedback->createdBy->name ?? '') }}'
                                        )">
                                        </i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>

        {{-- project issue --}}
        <div class="inline-block overflow-hidden min-w-full rounded-lg">
            <div class="py-4 bg-white border-b-4 border-yellow-500 capitalize text-gray-600 font-bold">
                <div class="flex justify-between items-center px-4">
                    <div>
                        <h1>Issue</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-plus text-sm ms-4 cursor-pointer"
                            onclick="projectIssue('issue-modal'); return false;"></i>
                    </div>
                </div>
            </div>

            <!-- Issue List -->
            <div class="projectIssues">
                @if ($projectIssues && $projectIssues->count() > 0)
                    @foreach ($projectIssues as $issue)
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg mt-3 hover:shadow-md transition-shadow capitalize">
                            <div class="mb-3 flex justify-between items-center px-4">
                                <div>
                                    <p class="text-gray-700 pt-2 font-bold">{{ $issue->note }}</p>
                                </div>
                                <div>
                                    <span> <i class="fa-solid fa-eye mt-4 cursor-pointer"
                                            onclick="showIssue('{{ addslashes($issue->note) }}', '{{ addslashes($issue->media ?? '[]') }}',
                                        '{{ addslashes($issue->project->name ?? '') }}',
                                        '{{ addslashes($issue->user->name ?? '') }}'
                                    )"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>
    </div>


    {{-- Project Notes  Modal --}}
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div id="project-notes-modal"
                class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Notes</h3>
                <button type="button" onclick="projectNotes('crud-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="create-project-notes-form" class="mt-4 space-y-4 text-gray-900 dark:text-white"
                action="{{ route('project.store-note', ['projectId' => $project->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media[]" multiple type="file">
                </div>


                <div>
                    <label for="note" class="block mb-1 font-medium text-black capitalize">note <span
                            class="text-red-500">*</span> </label>
                    <textarea id="note" name="note" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500 @error('note', 'noteErrors') border-red-500 @enderror">{{ old('note') }}</textarea>

                    @error('note', 'noteErrors')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>

        </div>
    </div>

    {{-- /Project Notes  Modal --}}


    {{-- Project Tasks Modal --}}
    <div id="task-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Tasks</h3>
                <button type="button" onclick="projectTasks('task-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white"
                action="{{ route('project.store-task', ['projectId' => $project->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title" name="title" type="text" placeholder="Enter title"
                        value="{{ old('title') }}">
                    @error('title', 'taskErrors')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                        Select User <span class="text-red-500">*</span>
                    </label>
                    <select name="user_id" id="user_id"
                        class="border border-gray-900 rounded w-full py-2 text-black">
                        <option value="">select one</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id', 'taskErrors')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="description" class="block mb-1 font-medium capitalize text-black">description </label>
                    <textarea id="note" name="description" rows="6" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('description') }}</textarea>
                    @error('description', 'taskErrors')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>
        </div>
    </div>
    {{-- /Project Tasks Modal --}}


    {{-- Project Feedback Modal --}}
    <div id="feedback-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->

            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg sm:text-lxl font-bold text-gray-800 mt-1 sm:mb-0">Create Project Feedback</h3>
                <button type="button" onclick="projectFeedback('feedback-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white"
                action="{{ route('project.store-feedback', ['projectId' => $project->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media[]" multiple type="file">
                </div>

                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">note <span
                            class="text-red-500">*</span> </label>
                    <textarea id="note" name="note" rows="6" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('note') }}</textarea>
                    @error('note', 'feedbackErrors')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>

        </div>
    </div>
    {{-- /Project Feedback Modal --}}

    {{-- Project Issue Modal --}}
    <div id="issue-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Issue</h3>
                <button type="button" onclick="projectIssue('issue-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white"
                action="{{ route('project.store-issue', ['projectId' => $project->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media[]" multiple type="file">
                </div>

                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">note <span
                            class="text-red-500">*</span></label>
                    <textarea id="note" name="note" rows="6" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500">{{ old('note') }}</textarea>
                    @error('note', 'issuekErrors')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>
        </div>
    </div>
    {{-- /Project Issue Modal --}}


    {{-- Project Show Notes Modal --}}

    <div id="view-note-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 relative backdrop-filter backdrop-blur-lg bg-opacity-70 border border-gray-200 animate-fade-in-up">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-4 border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Note Details</h3>
                <button type="button" onclick="toggleModal('view-note-modal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-5 space-y-4 text-gray-800">
                <div class="p-3 bg-gray-50 rounded-lg">
                    {{-- <p class="font-semibold text-sm text-gray-600">Project:</p> --}}
                    <p id="modal-note-project" class="text-sm"></p>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    {{-- <p class="font-semibold text-sm text-gray-600">Note:</p> --}}
                    <p id="modal-note-text" class="text-sm"></p>
                </div>

                <div id="modal-note-media" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
            </div>
        </div>
    </div>

    {{-- /Project Show Notes  Modal --}}

    {{-- Project Tasks Show Modal --}}

    <div id="view-task-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 relative backdrop-filter backdrop-blur-lg bg-opacity-70 border border-gray-200 animate-fade-in-up">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-4 border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Task Details</h3>
                <button type="button" onclick="showTask('view-task-modal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-5 space-y-4 text-gray-800">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-task-project" class="text-gray-700"></p>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-task-text" class="text-gray-700"></p>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-task-created" class="text-gray-700"></p>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-task-status" class="text-gray-700"></p>
                </div>

            </div>
        </div>
    </div>

    {{-- /Project Tasks Show Modal --}}

    {{-- Project Feedbacks Show Modal --}}

    <div id="view-feedback-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 relative backdrop-filter backdrop-blur-lg bg-opacity-70 border border-gray-200 animate-fade-in-up">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-4 border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Feedback Details</h3>
                <button type="button" onclick="showFeedback('view-feedback-modal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-5 space-y-4 text-gray-800">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-feedback-project" class="text-gray-700"></p>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-feedback-text" class="text-gray-700"></p>
                </div>

                <div id="modal-feedback-media"></div>

            </div>
        </div>
    </div>

    {{-- /Project Feedbacks Show Modal --}}

    {{-- Project Issue Show Modal --}}

    <div id="view-issue-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 relative backdrop-filter backdrop-blur-lg bg-opacity-70 border border-gray-200 animate-fade-in-up">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-4 border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Issue Details</h3>
                <button type="button" onclick="issueModal('view-issue-modal')"
                    class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-5 space-y-4 text-gray-800">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-issue-project" class="text-gray-700"></p>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-issue-text" class="text-gray-700"></p>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-issue-creator" class="text-gray-700 font-semibold"></p>
                </div>

                <div id="modal-issue-media"></div>
            </div>
        </div>
    </div>

    {{-- /Project Issue Show Modal --}}


    <script>
        // project notes fn start 
        function projectNotes(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle('hidden');
        }
        @if ($errors->noteErrors->any())
            document.addEventListener('DOMContentLoaded', function() {
                projectNotes('crud-modal');
            });
        @endif
        // project notes fn end 

        // project tasks fn start
        function projectTasks(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle('hidden');
        }
        @if ($errors->taskErrors->any())
            document.addEventListener('DOMContentLoaded', function() {
                projectTasks('task-modal');
            });
        @endif
        // project tasks fn end

        // project feedbacl fn start
        function projectFeedback(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden");
        }
        @if ($errors->feedbackErrors->any())
            document.addEventListener('DOMContentLoaded', function() {
                projectFeedback('feedback-modal');
            });
        @endif

        // project feedbacl fn end

        // project issue fn start
        function projectIssue(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden")
        }

        @if ($errors->issuekErrors->any())
            document.addEventListener('DOMContentLoaded', function() {
                projectIssue('issue-modal');
            });
        @endif
        // project issue fn end

        // project show all notes fn start
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function showNote(noteText, mediaPath, projectName, creatorName) {
            document.getElementById('modal-note-project').innerText = projectName;
            document.getElementById('modal-note-text').innerText = noteText;

            let mediaHtml = '';

            if (mediaPath) {
                try {
                    if (typeof mediaPath === 'string') {
                        mediaPath = JSON.parse(mediaPath);
                    }

                    if (Array.isArray(mediaPath) && mediaPath.length > 0) {
                        mediaHtml += `<div class="flex flex-wrap gap-2">`;
                        mediaPath.forEach(path => {
                            mediaHtml += `
                            <a href="/${path}" target="_blank">
                                <img src="/${path}" 
                                    alt="Media" 
                                    class="rounded border" 
                                    style="width: 50px; height: 50px; object-fit: cover;">
                             </a>
                    `;
                        });
                        mediaHtml += `</div>`;
                    } else if (typeof mediaPath === 'string') {
                        mediaHtml =
                            `<a href="/${path}"><img src="/${mediaPath}" alt="Media" class="max-w-full rounded"></a>`;
                    } else {
                        mediaHtml = `<p class="text-gray-500">No media available</p>`;
                    }
                } catch (e) {
                    console.error("Error parsing mediaPath:", e);
                    mediaHtml = `<p class="text-gray-500">Invalid media data</p>`;
                }
            } else {
                mediaHtml = `<p class="text-gray-500">No media available</p>`;
            }

            document.getElementById('modal-note-media').innerHTML = mediaHtml;

            toggleModal('view-note-modal');
        }
        // project show all notes fn end 

        // project show all tasks fn start
        function taskModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function showTask(noteText, mediaPaths, projectName, creatorName, status) {
            document.getElementById('modal-task-project').innerText = projectName;
            document.getElementById('modal-task-text').innerText = noteText;
            document.getElementById('modal-task-status').innerText = status;
            document.getElementById('modal-task-created').innerText = creatorName ?
                `Created By: ${creatorName}` :
                '';


            let mediaHtml = '';

            if (mediaPaths) {
                try {
                    if (typeof mediaPaths === 'string') {
                        mediaPaths = JSON.parse(mediaPaths);
                    }

                    if (Array.isArray(mediaPaths) && mediaPaths.length > 0) {
                        mediaHtml += `<div class="flex flex-wrap gap-2">`;
                        mediaPaths.forEach(path => {
                            mediaHtml += `
                            <a href="/${path}" target="_blank">
                                <img src="/${path}" 
                                    alt="Media" 
                                    class="rounded border" 
                                    style="width: 50px; height: 50px; object-fit: cover;">
                             </a>
                    `;
                        });
                        mediaHtml += `</div>`;
                    } else if (typeof mediaPaths === 'string') {
                        mediaHtml =
                            `<a href="/${path}"><img src="/${mediaPaths}" alt="Media" class="max-w-full rounded"></a>`;
                    } else {
                        mediaHtml = `<p class="text-gray-500">No media available</p>`;
                    }
                } catch (e) {
                    console.error("Error parsing mediaPaths:", e);
                    mediaHtml = `<p class="text-gray-500">Invalid media data</p>`;
                }
            } else {
                mediaHtml = `<p class="text-gray-500">No media available</p>`;
            }

            document.getElementById('modal-note-media').innerHTML = mediaHtml;

            if (creatorName) {
                if (!document.getElementById('modal-note-creator')) {
                    const p = document.createElement('p');
                    p.id = 'modal-note-creator';
                    p.className = 'text-gray-700 mt-2';
                    document.getElementById('modal-note-media').after(p);
                }
                document.getElementById('modal-note-creator').innerText = `Created By: ${creatorName}`;
            }

            taskModal('view-task-modal');
        }
        // project show all tasks fn end

        // project show all feedback fn start
        function feedbackModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.toggle("hidden");
            }
        }

        function showFeedback(noteText, mediaPaths, projectName, creatorName) {
            document.getElementById('modal-feedback-project').innerText = projectName;
            document.getElementById('modal-feedback-text').innerText = noteText;

            let mediaHtml = '';

            if (mediaPaths && mediaPaths.length > 0) {
                try {
                    if (typeof mediaPaths === 'string') {
                        mediaPaths = JSON.parse(mediaPaths);
                    }

                    mediaHtml += `<div class="flex flex-wrap gap-2">`;
                    mediaPaths.forEach(path => {
                        mediaHtml += `
                        <a href="/${path}" target="_blank">
                    <img src="/${path}" 
                         class="rounded border cursor-pointer" 
                         style="width: 50px; height: 50px; object-fit: cover;">
                         </a>
                `;
                    });
                    mediaHtml += `</div>`;
                } catch (e) {
                    console.error("Error parsing mediaPaths:", e);
                    mediaHtml = `<p class="text-gray-500">Invalid media data</p>`;
                }
            } else {
                mediaHtml = `<p class="text-gray-500">No media available</p>`;
            }

            document.getElementById('modal-feedback-media').innerHTML = mediaHtml;

            // Created By
            if (creatorName) {
                if (!document.getElementById('modal-feedback-creator')) {
                    const p = document.createElement('p');
                    p.id = 'modal-feedback-creator';
                    p.className = 'text-gray-700 mt-2';
                    document.getElementById('modal-feedback-media').after(p);
                }
                document.getElementById('modal-feedback-creator').innerText = `Created By: ${creatorName}`;
            }

            feedbackModal('view-feedback-modal');
        }
        // project show all feedback fn end

        // project show all issues fn start
        function issueModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.toggle("hidden");
            }
        }

        function showIssue(noteText, mediaPaths, projectName, creatorName) {
            document.getElementById('modal-issue-project').innerText = projectName;
            document.getElementById('modal-issue-text').innerText = noteText;

            let mediaHtml = '';

            if (mediaPaths && mediaPaths.length > 0) {
                try {
                    if (typeof mediaPaths === 'string') {
                        mediaPaths = JSON.parse(mediaPaths);
                    }

                    mediaHtml += `<div class="flex flex-wrap gap-2">`;
                    mediaPaths.forEach(path => {
                        mediaHtml += `<a href="/${path}" target="_blank"><img src="/${path}" 
                                  class="rounded border" 
                                  style="width: 50px; height: 50px; object-fit: cover;">
                                  </a>`;
                    });
                    mediaHtml += `</div>`;
                } catch (e) {
                    console.error("Error parsing mediaPaths:", e);
                    mediaHtml = `<p class="text-gray-500">Invalid media data</p>`;
                }
            } else {
                mediaHtml = `<p class="text-gray-500">No media available</p>`;
            }

            document.getElementById('modal-issue-media').innerHTML = mediaHtml;

            document.getElementById('modal-issue-creator').innerText = creatorName ?
                `Created By: ${creatorName}` :
                '';

            issueModal('view-issue-modal');
        }
        // project show all issues fn end

        function toggleText(id, btn) {
            let text = document.getElementById(id);
            text.classList.toggle("expanded");
            btn.textContent = text.classList.contains("expanded") ? "Show less" : "Show more";
        }


        // valodation for task-modal
        // document.addEventListener('DOMContentLoaded', function() {
        //     const hasValidationErrors = true;
        //     if (hasValidationErrors) {
        //         const taskModalStop = document.getElementById('task-modal');
        //         if (taskModalStop) {
        //             taskModalStop.classList.remove('hidden');
        //         }
        //     }
        // });
    </script>


    @if (session('success'))
        @push('script')
            <script>
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            </script>
        @endpush
    @endif

</x-app-layout>
