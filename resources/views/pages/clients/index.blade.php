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
        <div id="pagination-links"></div>
    </div>

    <script>
        $(document).ready(function() {

            fetchClients();


            $(document).on("click", "#pagination-links a", function(event) {
                event.preventDefault();

                let url = $(this).attr("href");

                let page = url.split('page=')[1];

                if (page) {
                    fetchClients(page);
                }
            });

            function fetchClients(page = 1) {
                $.ajax({
                    type: 'GET',
                    url: '/client?page=' + page,
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            alert(response.message);
                        } else {

                            $("#client-table-body").html(response.html);

                            $("#pagination-links").html(response.pagination);
                        }
                    },
                    error: function() {
                        console.log('Error: Data could not be fetched.');
                    }
                });
            }
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
