<x-app-layout>
    <x-slot name="header">
        {{ __('Clients') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all clients</h1>
        </div>
        <a href="{{ route('client.create') }}"
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
                        Client Info
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Contact Details
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody id="client-table-body">

            </tbody>
        </table>

        <div id="pagination-links" class="flex justify-end m-4"></div>
    </div>

    <script>
        $(document).ready(function() {
            fetchClients();

            function fetchClients(page = 1) {
                $.ajax({
                    type: 'GET',
                    url: '/client?page=' + page,
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            alert(response.message);
                            return
                        } else {
                            $("#client-table-body").html(response.html);
                            $("#pagination-links").html(response.pagination);
                            
                        }
                    },
                    error: function() {
                        console.log('Data not found');
                    }
                });
            }

            
            $(document).on("click", "#pagination-links", function(event) {
                event.preventDefault();
                let page = $(this).data("page");
                if (page) {
                    fetchClients(page);
                }
            });
        });
    </script>


</x-app-layout>
