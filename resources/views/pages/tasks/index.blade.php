<x-app-layout>
    <x-slot name="header">
        {{ __('Task') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all tasks</h1>
        </div>
        <a href="{{ route('task.create') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            add
        </a>

    </div>

    @if (session()->has('message'))
        <div class="alert alert-success bg-green-600 text-white my-3 p-5">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
        <table class="min-w-full leading-normal">
            <thead>
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
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Description
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
                @foreach ($projectTasks as $projectTask)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{ ++$i }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap"><b>Title: </b>{{ $projectTask->title }}</p>
                                <p class="text-gray-900 whitespace-no-wrap"><b>Project Name:
                                    </b>{{ $projectTask->project->name }}</p>
                            </div>
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap"><b>User: </b>{{ $projectTask->user->name }}
                                </p>
                                <p class="text-gray-900 whitespace-no-wrap"><b>Project status:
                                    </b>{{ $projectTask->status }}</p>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ \Illuminate\Support\Str::words($projectTask->description, 6, '...') }}</p>
                        </td>

                        <td class="border-gray-200 bg-white p-5">
                            <div class="flex items-center justify-center gap-4 mb-4">

                                <label class="sr-only" for="status-{{ $projectTask->id }}">Select Status</label>
                                <select name="status" data-id="{{ $projectTask->id }}"
                                    class="border status border-gray-300 rounded py-1 text-black focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                    <option value="">Select one</option>
                                    <option value="pending" @selected($projectTask->status == 'pending')>Pending</option>
                                    <option value="ongoing" @selected($projectTask->status == 'ongoing')>Ongoing</option>
                                    <option value="completed" @selected($projectTask->status == 'completed')>Completed</option>
                                    <option value="rejected" @selected($projectTask->status == 'rejected')>Rejected</option>
                                    <option value="failed" @selected($projectTask->status == 'failed')>Failed</option>
                                </select>


                                <a href="{{ route('task.edit', $projectTask->id) }}"
                                    class="px-4 py-2 text-sm font-medium rounded-lg border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">
                                    Edit
                                </a>

                                <a href="{{ route('task.show', $projectTask->id) }}"
                                    class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>

                                <form action="{{ route('task.destroy', $projectTask->id) }}" method="POST">
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
                @endforeach

            </tbody>
        </table>
        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{ $projectTasks->links() }}
        </div>
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
</x-app-layout>
