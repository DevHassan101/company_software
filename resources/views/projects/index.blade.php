<x-app-layout>
    <x-slot name="header">
        {{ __('Projects') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all project</h1>
        </div>
        <a href="{{ route('project.create') }}"
            class="text-black hover:text-white capitalize border border-black hover:bg-black focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">add</a>
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
                        Client Info
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Dates
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($projects as $project)
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
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Client Name:
                                        </b>{{ $project->client->name }}</p>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Client Email:
                                        </b>{{ $project->client->email }}</p>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <a href="mailto:{{ $project->email }}" class="text-gray-900 whitespace-no-wrap"><b>Start
                                    Date: </b> {{ $project->started_at }}</a>
                            <p class="text-gray-900 whitespace-no-wrap"><b>Delivery Date:
                                </b>{{ $project->delivery_date }}</p>
                        </td>

                        <td class="border-gray-200 bg-white p-5">
                            <div class="text-right flex flex-end">

            

                                <a href="{{ route('project.edit', $project->id) }}"
                                    class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800  focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800 capitalize">edit</a>
                                <a href="{{ route('project.show', $project->id) }}"
                                    class="text-orange-700 hover:text-white border border-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-orange-500 dark:text-orange-500 dark:hover:text-white dark:hover:bg-orange-600 dark:focus:ring-orange-800 capitalize">view</a>
                                <form action="{{ route('project.destroy', $project->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 capitalize">Delete</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{ $projects->links() }}
        </div>
    </div>


</x-app-layout>
