<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>all users</h1>
        </div>
        <a href="{{ route('user.create') }}"
            class="px-4 py-2 text-sm font-medium rounded-lg border border-black text-black-700 hover:bg-black capitalize hover:text-white transition">
            add
        </a>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs text-white uppercase bg-gray-50 dark:text-text">
                <tr>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        #
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Name
                    </th>
                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Email
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Role
                    </th>

                    <th
                        class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody id="user-table-body">

            </tbody>
        </table>

    </div>
    <div id="pagination-links" class="flex justify-end m-4"></div>

    <script>
        $(document).ready(function() {
            fetchUsers();

            function fetchUsers(page = 1) {
                $.ajax({
                    type: 'GET',
                    url: '/user?page=' + page,
                    dataType: 'json',
                    success: function(response) {
                        let users = response.data;
                        let tbody = '';
                        let i = 0;
                        users.forEach(user => {
                            tbody += `
            <tr>
                <td class="px-5 py-5 text-md bg-white border-b border-gray-200">${++i}</td>
                <td class="px-5 py-5 text-md bg-white border-b border-gray-200">${user.name}</td>
                <td class="px-5 py-5 text-md bg-white border-b border-gray-200">${user.email}</td>
                <td class="px-5 py-5 text-md bg-white border-b border-gray-200">${user.roles[0] ? user.roles[0].name : 'N/A'}</td>
                <td class="px-5 py-5 text-md bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center gap-4 mb-4">
                    <a href="/user/${user.id}/edit" class="px-4 py-2 text-sm font-medium rounded-lg border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition">Edit</a>
                    <a href="/user/${user.id}" class="px-4 py-2 text-sm font-medium rounded-lg border border-orange-700 text-orange-700 hover:bg-orange-700 hover:text-white transition">View</a>
                    <form action="/user/${user.id}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium rounded-lg border border-red-700 text-red-700 hover:bg-red-700 hover:text-white transition">Delete</button>
                    </form>
                     </div>
                </td>
            </tr>
        `;
                        });

                        $("#user-table-body").html(tbody);
                        let pagination = response.links.map(link => {
                            return `<button class="pagination-link px-3 py-1 border m-1 ${link.active ? 'bg-black text-white' : ''}" data-page="${link.url ? new URL(link.url).searchParams.get('page') : ''}">${link.label}</button>`;
                        }).join('');

                        $("#pagination-links").html(pagination);
                    },
                    error: function() {
                        console.log('Data not found');
                    }
                });
            }
            $(document).on("click", ".pagination-link", function() {
                let page = $(this).data("page");
                if (page) {
                    fetchUsers(page);
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
