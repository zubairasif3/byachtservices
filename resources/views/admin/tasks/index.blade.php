@extends('admin.layout.app')

@section('content')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
         <!-- Status Message -->
         @if (session('success'))
            <div class="bg-[#13C296] border flex items-center justify-between mb-4 p-4 rounded text-white">
                <p>{{ session('success') }}</p>
                <button class="text-green-700 hover:text-green-900" onclick="this.parentElement.remove();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="flex gap-2 items-center text-title-md2 font-bold text-black dark:text-white add-heading">
                Tasks
                @if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('tasks.create') }}" class="bg-primary flex gap-2 hover:bg-opacity-80 items-center p-1 rounded text-white px-2.5" style="font-size: 14px;line-height: 1.5;">
                        <svg class="fill-current" width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 7H9V1C9 0.4 8.6 0 8 0C7.4 0 7 0.4 7 1V7H1C0.4 7 0 7.4 0 8C0 8.6 0.4 9 1 9H7V15C7 15.6 7.4 16 8 16C8.6 16 9 15.6 9 15V9H15C15.6 9 16 8.6 16 8C16 7.4 15.6 7 15 7Z" fill=""></path>
                        </svg>
                        Add Task
                    </a>
                @elseif(auth()->user()->hasRole('Manager'))
                    @can('task.create')
                        <a href="{{ route('tasks.create') }}" class="bg-primary flex gap-2 hover:bg-opacity-80 items-center p-1 rounded text-white px-2.5" style="font-size: 14px;line-height: 1.5;">
                            <svg class="fill-current" width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 7H9V1C9 0.4 8.6 0 8 0C7.4 0 7 0.4 7 1V7H1C0.4 7 0 7.4 0 8C0 8.6 0.4 9 1 9H7V15C7 15.6 7.4 16 8 16C8.6 16 9 15.6 9 15V9H15C15.6 9 16 8.6 16 8C16 7.4 15.6 7 15 7Z" fill=""></path>
                            </svg>
                            Add Task
                        </a>
                    @endcan
                @endif
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-primary add-heading">Tasks</li>
                </ol>
            </nav>
        </div>
        @if (auth()->user()->hasRole('Admin'))
            <div class="flex gap-3 justify-end mb-5">
                <a href="{{ route('tasks.export') }}"  class="bg-primary flex gap-2 hover:bg-opacity-80 items-center p-1 rounded text-white px-2.5" style="font-size: 14px;line-height: 1.5;">Export to Excel</a>
                {{-- <form action="{{ route('tasks.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                    @csrf
                    <!-- Hidden file input -->
                    <input type="file" name="file" accept=".xlsx, .csv" id="fileInput" style="display: none;" required>

                    <!-- Button that triggers the file input click -->
                    <button type="button" id="uploadButton" class="bg-primary flex gap-2 hover:bg-opacity-80 items-center p-1 rounded text-white px-2.5" style="font-size: 14px;line-height: 1.5;">
                        Import from Excel
                    </button>
                </form> --}}
            </div>
        @endif
        <!-- Breadcrumb End -->

        <div class="flex flex-col gap-5 md:gap-7 2xl:gap-10">
            <!-- ====== Data Table Start ====== -->
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="data-table-common data-table-two max-w-full overflow-x-auto">
                    <table class="table w-full table-auto" id="dataTableTwo">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Date Inserted</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Company Owner</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Boat Customer</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Worker</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Date Done</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Item</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Location</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Worker Type</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Description</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Comments</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Reference Number</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Hours Worked</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Hourly Rate</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Total Price</th>
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($task->date_inserted)->format('M d Y') }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->companyOwner->name ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->customerBoat->name ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->worker->name ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($task->date_done)->format('M d Y') }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->item ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->location ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->worker_type ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->status ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->description_action ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->comments ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->ref_no ?? '' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->hours ?? 0 }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->hourly_rate ?? 0 }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $task->total_price ?? 0 }} <!-- Assuming this is a calculated field -->
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            @if (auth()->user()->hasRole('Admin'))
                                                <a href="{{ route('tasks.edit', $task) }}" class="px-2 py-1 text-sm text-white bg-primary rounded">
                                                    Edit
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-danger px-2 py-1 rounded text-sm text-white">
                                                        Delete
                                                    </button>
                                                </form>
                                            @elseif(auth()->user()->hasRole('Manager'))
                                                @can('task.update')
                                                    <a href="{{ route('tasks.edit', $task) }}" class="px-2 py-1 text-sm text-white bg-primary rounded">
                                                        Edit
                                                    </a>
                                                @endcan
                                                @can('task.delete')
                                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-danger px-2 py-1 rounded text-sm text-white">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Repeat rows for other tasks -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Data Table End ====== -->
        </div>
    </div>
    <script>
        // Get the elements
        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('fileInput');
        const importForm = document.getElementById('importForm');

        // Trigger the file input click when the button is clicked
        uploadButton.addEventListener('click', function() {
            fileInput.click();
        });

        // Submit the form when a file is selected
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                importForm.submit();
            }
        });
    </script>
@endsection
