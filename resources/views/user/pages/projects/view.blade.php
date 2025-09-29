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


@extends('user.layouts.app')

@section('content')

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>projects view</h1>
        </div>
        <a href="{{ route('getProject.index') }}"
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
        <div class=" bg-white p-5 rounded-md h-fit">
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

        <div class=" bg-white p-5 rounded-md h-fit">
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
                                        onclick="showTask( '{{ addslashes($task->title) }}', '{{ addslashes($task->description) }}',
                                        '{{ addslashes(json_encode($task->media ? json_decode($task->media) : [])) }}',
                                        '{{ addslashes($task->projectTaskUsers->pluck('user.name')->join(', ')) }}',
                                        '{{ addslashes($task->createdBy->name ?? '') }}',
                                        '{{ addslashes($task->status) }}')">
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
                                            '{{ addslashes($feedback->createdBy->name) }}'
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
                    <p id="modal-task-title" class="text-gray-700"></p>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-task-text" class="text-gray-700"></p>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-task-user" class="text-gray-700"></p>
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
                    <p id="modal-feedback-text" class="text-gray-700"></p>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p id="modal-feedback-creator" class="text-gray-700"></p>
                </div>
                <div id="modal-feedback-media"></div>
            </div>
        </div>
    </div>
    {{-- /Project Feedbacks Show Modal --}}

    {{-- Project Issue Show Modal --}}

    <!-- Project Issues Modal -->
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
        function showNote(noteText, mediaPath, creatorName) {
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

        function showTask(title, noteText, mediaPaths, projectUser, creatorName, status) {
            document.getElementById('modal-task-title').innerText = title;
            document.getElementById('modal-task-text').innerText = noteText;
            document.getElementById('modal-task-user').innerText = projectUser;

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

        function showFeedback(noteText, mediaPaths, creatorName) {
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

        function issueModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.toggle("hidden");
            }
        }

        function showIssue(noteText, mediaPaths, creatorName) {
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

@endsection
