<x-app-layout>
    <x-slot name="header">
        {{ __('Projects') }}
    </x-slot>

    {{-- <div class="mb-4 inline-flex overflow-hidden w-full bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center w-12 bg-blue-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                </path>
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-blue-500">Info</span>
                <p class="text-sm text-gray-600">Sample table page</p>
            </div>
        </div>
    </div> --}}

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
                            <p class="text-gray-900 whitespace-no-wrap"><b>Project Name: </b>{{ $project->name }}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div class="flex gap-2 items-center">
                                <div>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Project Name:
                                        </b>{{ $project->name }}</p>
                                    </p>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Client Name:
                                        </b>{{ $project->client->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <a href="mailto:{{ $project->email }}" class="text-gray-900 whitespace-no-wrap"><b>Start
                                    Date: </b> {{ $project->started_at }}</a>
                            <p class="text-gray-900 whitespace-no-wrap"><b>Deliver Date:
                                </b>{{ $project->delivery_date }}</p>
                        </td>

                        <td class="border-gray-200 bg-white p-5">
                            <div class="text-right flex flex-end">
                                <a href="{{ route('project.edit', $project->id) }}"
                                    class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800 capitalize">edit</a>
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
