@extends('admin.layouts.app')

@section('content')

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all project</h1>
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
            <tbody id="project-table-body">
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
                                        </b>{{ $project->client?->name }}</p>
                                    <p class="text-gray-900 whitespace-no-wrap"><b>Client Email:
                                        </b>{{ $project->client?->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <a href="mailto:{{ $project->email }}" class="text-gray-900 whitespace-no-wrap"><b>Start
                                    Date: </b> {{ $project->started_at }}</a>
                            <p class="text-gray-900 whitespace-no-wrap"><b>Delivery Date:
                                </b>{{ $project->delivery_date }}</p>
                        </td>

                        <td class="px-5 py-5 text-md bg-white border-b border-gray-200">
                            <div class="text-right flex flex-end gap-4 mb-4">
                                <a href="{{ route('showProject.show', $project->id) }}"
                                    class="px-4 py-2 text-sm font-medium capitalize rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">view</a>
                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="flex flex-col px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
            {{-- {{ $projects->links() }} --}}
        </div>
    </div>
@endsection
