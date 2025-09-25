@extends('admin.layouts.app')

@section('content')


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all tasks</h1>
        </div>
        <a href="{{ route('admin.task.create') }}"
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
                        Project Details
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @forelse ($projectTasks as $projectTask)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 whitespace-nowrap">
                            <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 whitespace-nowrap">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap"><b>Title: </b>{{ $projectTask->title }}</p>
                                <p class="text-gray-900 whitespace-no-wrap"><b>Name:
                                    </b>{{ $projectTask->project->name }}</p>
                            </div>
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 whitespace-nowrap"
                            id="status-display-{{ $projectTask->id }}">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap">
                                    <b>User:</b>
                                    @foreach ($projectTask->projectTaskUsers as $projectTaskUser)
                                        {{ $projectTaskUser->user->name ?? 'N/A' }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <p class="text-gray-900 whitespace-no-wrap"><b>status:
                                        @if ($projectTask->status == 'completed')
                                            <span
                                                class="bg-green-100 text-green-100 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">completed</span>
                                        @elseif ($projectTask->status == 'pending')
                                            <span
                                                class="bg-yellow-100 text-yellow-100 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">pending</span>
                                        @elseif ($projectTask->status == 'ongoing')
                                            <span
                                                class="bg-indigo-100 text-indigo-100 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">ongoing</span>
                                        @elseif ($projectTask->status == 'rejected')
                                            <span
                                                class="bg-pink-100 text-pink-100 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">rejected</span>
                                        @elseif ($projectTask->status == 'failed')
                                            <span
                                                class="bg-red-100 text-red-100 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">failed</span>
                                        @endif
                                    </b></p>
                            </div>
                        </td>

                        <td class="px-5 py-5 text-md bg-white border-b border-gray-200">
                            <div class="flex items-center justify-center gap-4 mb-4">
                                <label class="sr-only" for="status-{{ $projectTask->id }}">Select Status</label>
                                <select name="status" data-id="{{ $projectTask->id }}"
                                    class="border status border-gray-900 rounded py-2 text-black focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    <option value="">Select one</option>
                                    <option value="pending" @selected($projectTask->status == 'pending')>Pending</option>
                                    <option value="ongoing" @selected($projectTask->status == 'ongoing')>Ongoing</option>
                                    <option value="completed" @selected($projectTask->status == 'completed')>Completed</option>
                                    <option value="rejected" @selected($projectTask->status == 'rejected')>Rejected</option>
                                    <option value="failed" @selected($projectTask->status == 'failed')>Failed</option>
                                </select>

                                <a href="{{ route('admin.task.edit', $projectTask->id) }}"
                                    class="px-4 py-2 text-sm font-medium rounded-lg border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                    Edit
                                </a>

                                <a href="{{ route('admin.task.show', $projectTask->id) }}"
                                    class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>

                                <form action="{{ route('admin.task.destroy', $projectTask->id) }}" method="POST">
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
                            <td colspan="4" class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-center text-red-500">
                                    No record found
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $projectTasks->links() }}
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function getStatusBadgeHtml(status) {
                let badgeHtml = '';
                switch (status) {
                    case 'completed':
                        badgeHtml =
                            '<span class="bg-green-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">completed</span>';
                        break;
                    case 'pending':
                        badgeHtml =
                            '<span class="bg-yellow-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">pending</span>';
                        break;
                    case 'ongoing':
                        badgeHtml =
                            '<span class="bg-indigo-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">ongoing</span>';
                        break;
                    case 'rejected':
                        badgeHtml =
                            '<span class="bg-pink-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">rejected</span>';
                        break;
                    case 'failed':
                        badgeHtml =
                            '<span class="bg-red-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">failed</span>';
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
                    url: "/admin/task/" + id + "/status",
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

                        $(`#status-display-${id} p:last-child span`).replaceWith(newStatusHtml);
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
    @endsection
