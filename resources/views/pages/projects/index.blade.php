<x-app-layout>
    <x-slot name="header">
        {{ __('Projects') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all project</h1>
        </div>
        <a href="{{ route('project.create') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            add
        </a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs text-white uppercase bg-gray-50">
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        #
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Project Info
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Client Info
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Assign User
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        status
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody id="project-table-body">
                @php
                    $i = 0;
                @endphp
                @forelse ($projects as $project)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap"><b>Name: </b>{{ $project->name }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div class="flex gap-2 items-center">
                                <div>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Name:
                                        </b>{{ $project->client?->name }}</p>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Email:
                                        </b>{{ $project->client?->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <b>User:</b>
                                @foreach ($project->projectUsers as $projectUser)
                                    {{ $projectUser->user->name ?? 'N/A' }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div id="project-status-badge-{{ $project->id }}">
                                @if ($project->status == 'pending')
                                    <span
                                        class="bg-yellow-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900">pending</span>
                                @elseif ($project->status == 'ongoing')
                                    <span
                                        class="bg-indigo-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">ongoing</span>
                                @elseif ($project->status == 'delivered')
                                    <span
                                        class="bg-green-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">delivered</span>
                                @elseif ($project->status == 'continued')
                                    <span
                                        class="bg-purple-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">continued</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-5 py-5 text-md bg-white border-b border-gray-200">
                            <div class="flex items-center justify-center gap-4 mb-4">
                                <label class="sr-only" for="status-{{ $project->id }}">Select Status</label>
                                <select name="status" data-id="{{ $project->id }}"
                                    class="border status border-gray-900 rounded py-2 text-black focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    <option value="">Select one</option>
                                    <option value="pending" @selected($project->status == 'pending')>Pending</option>
                                    <option value="ongoing" @selected($project->status == 'ongoing')>Ongoing</option>
                                    <option value="delivered" @selected($project->status == 'delivered')>delivered</option>
                                    <option value="continued" @selected($project->status == 'continued')>continued</option>
                                </select>

                                <a href="{{ route('project.edit', $project->id) }}"
                                    class="px-4 py-2 text-sm font-medium rounded-lg border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                    Edit
                                </a>

                                <a href="{{ route('project.show', $project->id) }}"
                                    class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>

                                <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium rounded-lg border border-red-700 text-red-700 hover:bg-red-700 hover:text-white transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-center text-red-500">
                                    No record found
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $projects->links() }}
            </div>
        </div>

        <script>
            $(document).ready(function() {
                fetchProjects();

                function fetchProjects(page = 1) {
                    $.ajax({
                        type: "method",
                        url: "url",
                        data: "data",
                        dataType: "dataType",
                        success: function(response) {

                        }
                    });
                }
            });

            function getStatusBadgeHtml(status) {
                let badgeHtml = '';
                switch (status) {
                    case 'pending':
                        badgeHtml =
                            '<span class="bg-yellow-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900">pending</span>';
                        break;
                    case 'ongoing':
                        badgeHtml =
                            '<span class="bg-indigo-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">ongoing</span>';
                        break;
                    case 'delivered':
                        badgeHtml =
                            '<span class="bg-green-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">delivered</span>';
                        break;
                    case 'continued':
                        badgeHtml =
                            '<span class="bg-purple-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">continued</span>';
                        break;
                    default:
                        badgeHtml = '<span>' + status + '</span>';
                        break;
                }
                return badgeHtml;
            }

            $('.status').change(function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const newStatus = $(this).find('option:selected').val();

                $.ajax({
                    type: "PUT",
                    url: "/project/" + id + "/status",
                    data: {
                        status: newStatus,
                    },
                    headers: {
                        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.error) {
                            Toast.fire({
                                icon: "error",
                                title: response.message
                            });
                            return;
                        }
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });

                        const newStatusHtml = getStatusBadgeHtml(newStatus);
                        // Target the wrapper div to update its content
                        $(`#project-status-badge-${id}`).html(newStatusHtml); // 1.5.3

                        // Update the delivered_at date if it exists
                        if (response.delivered_at) {
                            $(`#delivered-date-${response.project_id}`).text(response.delivered_at);
                        } else {
                            // If delivered_at is null, clear the display or show 'N/A'
                            $(`#delivered-date-${response.project_id}`).text('N/A');
                        }
                    },
                    error: function(msg) {
                        console.log('Data was not sent successfully');
                        Toast.fire({
                            icon: "error",
                            title: "Something went wrong. Please try again."
                        });
                    }
                });
            });
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
