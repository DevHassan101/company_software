<x-app-layout>
    <x-slot name="header">
        {{ __('Projects') }}
    </x-slot>


    <div class="flex justify-between items-center my-3">
        <div class="capitalize text-lg font-bold">
            <h1>projects view</h1>
        </div>
        <a href="{{ route('project.index') }}"
            class="text-black hover:text-white capitalize border border-black hover:bg-black focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5 text-center">back</a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success bg-green-600 text-white my-3 p-5">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="grid grid-cols-4 gap-4">
        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectNotes('crud-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-green-600 text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project notes</h1>
            </div>
        </div>
        
        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectTasks('task-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-blue-600 text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project tasks</h1>
            </div>
        </div>

        {{-- <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectUser('user-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-orange-600 text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project users</h1>
            </div>
        </div> --}}

        {{-- <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectPayment('payment-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-black text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project payments</h1>
            </div>
        </div> --}}

        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectFeedback('feedback-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-purple-500 text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project feedback</h1>
            </div>
        </div>

        <div class="inline-block overflow-hidden min-w-full rounded-lg shadow">
            <div onclick="projectIssue('issue-modal'); return false;"
                class="py-4 px-6 bg-white border-b-4 border-yellow-500 text-center capitalize text-gray-600 font-bold cursor-pointer">
                <h1>project Issue</h1>
            </div>
        </div>
    </div>



    {{-- Project Notes  Modal --}}
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Notes</h3>
                <button type="button" onclick="projectNotes('crud-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-note', ['projectId' => $project->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select User
                    </label>
                    <select name="user_id" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        {{ $message }}
                    @enderror
                </div> --}}

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media" type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="note" class="block mb-1 font-medium text-black capitalize">note</label>
                    <textarea id="note" name="note" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
                </div>

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>

        </div>
    </div>
    {{-- /Project Notes  Modal --}}


    {{-- Project Tasks Modal --}}
    <div id="task-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Tasks</h3>
                <button type="button" onclick="projectTasks('task-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-task') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title" name="title" type="text" placeholder="Enter title">
                    @error('title')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select User
                    </label>
                    <select name="user_id" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media" type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">description</label>
                    <textarea id="note" name="description" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select Status
                    </label>
                    <select name="status" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        <option value="0">pending</option>
                        <option value="1">ongoing</option>
                        <option value="2">completed</option>
                        <option value="3">rejected</option>
                        <option value="4">failed</option>
                    </select>
                    @error('status')
                        {{ $message }}
                    @enderror
                </div>

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>

        </div>
    </div>
    {{-- /Project Tasks Modal --}}

    {{-- Project User Modal --}}
    {{-- <div id="user-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Users</h3>
                <button type="button" onclick="projectUser('user-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-user') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select User
                    </label>
                    <select name="user_id" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        {{ $message }}
                    @enderror
                </div>

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>
        </div>
    </div> --}}
    {{-- /Project User Modal --}}

    {{-- Project Payment Modal --}}
    {{-- <div id="payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Payments</h3>
                <button type="button" onclick="projectPayment('payment-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-payment') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Amount
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="amount" name="amount" type="number" placeholder="Enter amount">
                    @error('amount')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media" type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">note</label>
                    <textarea id="note" name="note" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
                </div>



                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>
        </div>
    </div> --}}
    {{-- /Project Payment Modal --}}

    {{-- Project Feedback Modal --}}
    <div id="feedback-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Feedback</h3>
                <button type="button" onclick="projectFeedback('feedback-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-feedback') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media" type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">description</label>
                    <textarea id="note" name="description" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Password">
                        Select Status
                    </label>
                    <select name="status" class="border border-gray-300 rounded w-full py-1 text-black">
                        <option value="select one">select one</option>
                        <option value="0">pending</option>
                        <option value="1">ongoing</option>
                        <option value="2">completed</option>
                        <option value="3">rejected</option>
                        <option value="4">failed</option>
                    </select>
                    @error('status')
                        {{ $message }}
                    @enderror
                </div>

                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>

        </div>
    </div>
    {{-- /Project Feedback Modal --}}

    {{-- Project Issue Modal --}}
    <div id="issue-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 bg-black/50 flex z-50 items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5 relative">

            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3">
                <h3 class="text-lg font-semibold text-black">Create Project Issue</h3>
                <button type="button" onclick="projectIssue('issue-modal')" class="text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="mt-4 space-y-4 text-gray-900 dark:text-white" action="{{ route('project.store-issue') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="media">
                        Upload Media
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="media" name="media" type="file">
                    @error('media')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="note" class="block mb-1 font-medium capitalize text-black">note</label>
                    <textarea id="note" name="note" rows="4" placeholder="Write note here"
                        class="w-full p-2 border rounded-md text-black dark:border-gray-500"></textarea>
                </div>
                <button type="submit"
                    class="capitalize bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-semibold w-full">
                    submit
                </button>
            </form>
        </div>
    </div>
    {{-- /Project Issue Modal --}}


    <script>
        // project notes fn start 
        function projectNotes(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle('hidden');
        }
        // project notes fn end 

        // project tasks fn start
        function projectTasks(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle('hidden');
        }
        // project tasks fn end

        // project users fn start
        function projectUser(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden");
        }
        // project users fn end

        // project payemtns fn start
        function projectPayment(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden");
        }
        // project payemtns fn end

        // project feedbacl fn start
        function projectFeedback(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle("hidden");
        }
        // project feedbacl fn end

        // project issue fn start
        function projectIssue(id){
            const modal = document.getElementById(id);
            if (!modal)  return;
            modal.classList.toggle("hidden")
        }
        // project issue fn end
    </script>

</x-app-layout>
