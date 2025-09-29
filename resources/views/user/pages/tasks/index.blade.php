@extends('user.layouts.app')

@section('content')
    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all tasks</h1>
        </div>
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
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
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
                                <p class="text-gray-900 whitespace-no-wrap"><b>Title:
                                    </b>{{ $projectTask->task->title ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap"><b>Project:
                                    </b>{{ $projectTask->task->project->name ?? 'N/A' }}</p>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 whitespace-nowrap">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap"><b>User: </b>{{ $projectTask->user->name }}
                                </p>
                                <p class="text-gray-900 whitespace-no-wrap"><b>status:
                                        @if ($projectTask->task->status == 'pending')
                                            <span
                                                class="bg-yellow-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900">pending</span>
                                        @elseif ($projectTask->task->status == 'completed')
                                            <span
                                                class="bg-green-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900">completed</span>
                                        @elseif ($projectTask->task->status == 'ongoing')
                                            <span
                                                class="bg-indigo-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-indigo-900">ongoing</span>
                                        @elseif ($projectTask->task->status == 'rejected')
                                            <span
                                                class="bg-pink-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-pink-900">rejected</span>
                                        @elseif ($projectTask->task->status == 'failed')
                                            <span
                                                class="bg-red-100 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900">failed</span>
                                        @endif
                                    </b></p>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-md bg-white border-b border-gray-200">
                            <a href="{{ route('showTask.show', $projectTask->task->id) }}"
                                class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>
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
    </div>
    <script>
        $('.status').change(function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $.ajax({
                type: "PUT",
                url: "/task/" + id + "/status",
                data: {
                    status: $(this).find('option:selected').val(),
                },
                headers: {
                    'x-csrf-token': "{{ csrf_token() }}"
                },

                success: function(response) {
                    if (response.error) {
                        alert(response.message);
                        return;
                    }
                    console.log("Status changed successfully");
                },
                error: function(msg) {
                    console.log('data is not send');
                }
            });
        });
    </script>
@endsection
