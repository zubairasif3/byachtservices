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
                Your Tasks
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-primary add-heading">Your Tasks</li>
                </ol>
            </nav>
        </div>
        {{-- <div class="flex gap-3 justify-end mb-5">
            <a href="{{ route('tasks.export') }}"  class="bg-primary flex gap-2 hover:bg-opacity-80 items-center p-1 rounded text-white px-2.5" style="font-size: 14px;line-height: 1.5;">Export to Excel</a>
            <form action="{{ route('tasks.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                @csrf
                <!-- Hidden file input -->
                <input type="file" name="file" accept=".xlsx, .csv" id="fileInput" style="display: none;" required>

                <!-- Button that triggers the file input click -->
                <button type="button" id="uploadButton" class="bg-primary flex gap-2 hover:bg-opacity-80 items-center p-1 rounded text-white px-2.5" style="font-size: 14px;line-height: 1.5;">
                    Import from Excel
                </button>
            </form>
        </div> --}}
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
                                <th class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">Worker</th>
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
                                        {{ $task->worker->name ?? "" }}
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('worker.tasks.show', $task->id) }}" class="px-2 py-1 text-sm text-white bg-primary rounded">
                                                View
                                            </a>
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
    {{-- <script>
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
    </script> --}}
@endsection
