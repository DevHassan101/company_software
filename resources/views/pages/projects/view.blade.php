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

    <div class="flex justify-between gap-4  my-6 py-5 border-b-4">
        <div class="w-1/2 bg-white p-5 rounded-md" >
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
        
        <div class="w-1/2 bg-white p-5 rounded-md">
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

    @if (session()->has('message'))
        <div class="alert alert-success bg-green-600 text-white my-3 p-5">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="grid grid-cols-4 gap-4">
        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
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
        </div>



        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
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
        </div>

        {{-- <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectUser('user-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-orange-600 text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project users</h1>
            </div>
        </div> --}}

        {{-- <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectPayment('payment-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-black text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project payments</h1>
            </div>
        </div> --}}

        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
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
        </div>


        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
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
                                <span><i class="fa-solid fa-eye cursor-pointer mt-4"
                                        onclick="showNote('{{ addslashes($task->description) }}', '{{ $task->media ?? '' }}', '{{ addslashes($task->project->name ?? '') }}', '{{ addslashes($task->user->name ?? '') }}')">
                                    </i></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            @endif
        </div>

        <!-- Feedback List -->
        <div class="projectFeedbacks">
            @if ($projectFeedbacks && $projectFeedbacks->count() > 0)
                @foreach ($projectFeedbacks as $feedback)
                    <div
                        class="bg-gray-50 border border-gray-200 rounded-lg mt-3 hover:shadow-md transition-shadow ps-4 capitalize">
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
                                <span> <i class="fa-solid fa-eye cursor-pointer"
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


    {{-- Project Notes  Modal --}}
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Notes</h3>
                <button type="button" onclick="projectNotes('crud-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white"
                action="{{ route('project.store-note', ['projectId' => $project->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                {{-- <div class="mb-4">
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
                </div> --}}

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media[]" multiple type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="note" class="block mb-1 font-medium text-black capitalize">note</label>
                    <textarea id="note" name="note" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
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


                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">description</label>
                    <textarea id="note" name="description" rows="6" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
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

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>

        </div>
    </div>
    {{-- /Project Tasks Modal --}}

    {{-- Project User Modal --}}
    {{-- <div id="user-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Users</h3>
                <button type="button" onclick="projectUser('user-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-user') }}" method="post">
                @csrf

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

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>
        </div>
    </div> --}}
    {{-- /Project User Modal --}}

    {{-- Project Payment Modal --}}
    {{-- <div id="payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Payments</h3>
                <button type="button" onclick="projectPayment('payment-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-payment') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Amount
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="amount" name="amount" type="number" placeholder="Enter amount">
                    @error('amount')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media" type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">note</label>
                    <textarea id="note" name="note" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
                </div>



                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>
        </div>
    </div> --}}
    {{-- /Project Payment Modal --}}

    {{-- Project Feedback Modal --}}
    <div id="feedback-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Feedback</h3>
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
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">note</label>
                    <textarea id="note" name="note" rows="6" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
                    @error('note')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select Status
                    </label>
                    <select name="status" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="">select one</option>
                        <option value="">select one</option>
                        <option value="pending">pending</option>
                        <option value="ongoing">ongoing</option>
                        <option value="completed">completed</option>
                        <option value="onhold">onhold</option>
                    </select>
                    @error('status')
                        {{ $message }}
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
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">note</label>
                    <textarea id="note" name="note" rows="6" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
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
        class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-black">Note Details</h3>
                <button type="button" onclick="toggleModal('view-note-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4 space-y-4 text-gray-900">
                <p class="font-bold">Project:</p>
                <p id="modal-note-project" class="text-gray-700"></p>

                <p class="font-bold">Note:</p>
                <p id="modal-note-text" class="text-gray-700"></p>

                <p class="font-bold">Media:</p>
                <div id="modal-note-media"></div>
            </div>
        </div>
    </div>
    {{-- /Project Show Notes  Modal --}}

    {{-- Project Tasks Show Modal --}}
    <div id="view-task-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-black">Task Details</h3>
                <button type="button" onclick="taskModal('view-task-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4 space-y-4 text-gray-900">
                <p class="font-bold">Project:</p>
                <p id="modal-task-project" class="text-gray-700"></p>

                <p class="font-bold">Note:</p>
                <p id="modal-task-text" class="text-gray-700"></p>

                <p class="font-bold">Created by:</p>
                <div id="modal-task-media"></div>
            </div>
        </div>
    </div>
    {{-- /Project Tasks Show Modal --}}

    {{-- Project Feedbacks Show Modal --}}
    <div id="view-feedback-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4 w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-black">Feedback Details</h3>
                <button type="button" onclick="showFeedback('view-feedback-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4 space-y-4 text-gray-900">
                <p class="font-bold">Project:</p>
                <p id="modal-feedback-project" class="text-gray-700"></p>
                <p class="font-bold">Feedback:</p>
                <p id="modal-feedback-text" class="text-gray-700"></p>
                <div id="modal-feedback-media"></div>

            </div>
        </div>
    </div>
    {{-- /Project Feedbacks Show Modal --}}

    {{-- Project Issue Show Modal --}}

    <!-- Project Issues Modal -->
    <div id="view-issue-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-3/4  w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-black">Issue Details</h3>
                <button type="button" onclick="toggleModal('view-issue-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4 space-y-4 text-gray-900">
                <p class="font-bold">Project:</p>
                <p id="modal-issue-project" class="text-gray-700"></p>

                <p class="font-bold">Issue:</p>
                <p id="modal-issue-text" class="text-gray-700"></p>

                <p class="font-bold">Media:</p>
                <div id="modal-issue-media"></div>

                <p id="modal-issue-creator" class="text-gray-700 font-semibold"></p>
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
        // project notes fn end 

        // project tasks fn start
        function projectTasks(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle('hidden');
        }
        // project tasks fn end

        // project users fn start
        function projectUser(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden");
        }
        // project users fn end

        // project payemtns fn start
        function projectPayment(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden");
        }
        // project payemtns fn end

        // project feedbacl fn start
        function projectFeedback(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden");
        }
        // project feedbacl fn end

        // project issue fn start
        function projectIssue(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden")
        }
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
                mediaHtml =
                    `<a href="https://youtube.com" target="_blank"><img src="/${mediaPath}" alt="Media" class="max-w-full rounded b"></a>`;

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

        function showNote(noteText, mediaPaths, projectName, creatorName) {
            document.getElementById('modal-note-project').innerText = projectName;
            document.getElementById('modal-note-text').innerText = noteText;

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

            toggleModal('view-note-modal');
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
        function toggleModal(id) {
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

            toggleModal('view-issue-modal');
        }
        // project show all issues fn end

        function toggleText(id, btn) {
            let text = document.getElementById(id);
            text.classList.toggle("expanded");
            btn.textContent = text.classList.contains("expanded") ? "Show less" : "Show more";
        }
    </script>

</x-app-layout>
