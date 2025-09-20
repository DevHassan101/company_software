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
                @foreach ($projectTasks as $projectTask)
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
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 whitespace-nowrap">
                            <div>
                                <p class="text-gray-900 whitespace-no-wrap"><b>User: </b>{{ $projectTask->user->name }}
                                </p>
                                <p class="text-gray-900 whitespace-no-wrap"><b>status:
                                    </b>{{ $projectTask->status }}</p>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-md bg-white border-b border-gray-200">
                            <a href="{{ route('showTask.show', $projectTask->id) }}"
                                class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>
                        </td>

                    </tr>
                @endforeach
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
