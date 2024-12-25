@extends('admin.layout.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading">
            Update Task
        </h2>
        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary add-heading">Update Task</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- Task Form -->
    <div class="bg-white rounded-md shadow-md border border-stroke p-6 dark:bg-boxdark dark:border-strokedark">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Row 1: Boat Customer and Company Owner -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="customer_boat_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Boat Customer <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="customer_boat_id"
                        name="customer_boat_id"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                        <option value="">Select a Boat</option>
                        @foreach ($customer_boats as $boat)
                            <option value="{{ $boat->id }}" {{ $task->customer_boat_id == $boat->id ? 'selected' : '' }}>
                                {{ $boat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="company_owner" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Company Owner <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="company_owner"
                        name="company_owner"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                        <option value="">Select a Company Owner</option>
                        @foreach ($customers as $owner)
                            <option value="{{ $owner->id }}" {{ $task->company_owner == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Row 2: Date Done and Item -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="date_done" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Date Done <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="date"
                        id="date_done"
                        name="date_done"
                        value="{{ old('date_done', $task->date_done) }}"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    />
                </div>
                <div>
                    <label for="item" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Item
                    </label>
                    <input
                        type="text"
                        id="item"
                        name="item"
                        value="{{ old('item', $task->item) }}"
                        placeholder="Enter item details"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <!-- Row 3: Location and Description -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="location" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Location
                    </label>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location', $task->location) }}"
                        placeholder="Enter the location"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                <div>
                    <label for="done_by" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Done By (Worker)
                    </label>
                    <select
                        id="done_by"
                        name="done_by"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                        <option value="">Select a Worker</option>
                        @foreach ($workers as $worker)
                            <option value="{{ $worker->id }}" data-rate="{{ $worker->hourly_rate }}" {{ old('done_by', $task->done_by) == $worker->id ? 'selected' : '' }}>
                                {{ $worker->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Row 5: Hours and Hourly Rate -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="hours" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Hours Worked
                    </label>
                    <input
                        type="number"
                        id="hours"
                        name="hours"
                        value="{{ old('hours', $task->hours) }}"
                        step="0.01"
                        placeholder="Enter hours worked"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                <div>
                    <label for="hourly_rate" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Hourly Rate
                    </label>
                    <input
                        type="number"
                        id="hourly_rate"
                        name="hourly_rate"
                        value="{{ old('hourly_rate', $task->hourly_rate) }}"
                        step="0.01"
                        placeholder="Enter hourly rate"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        readonly
                    />
                </div>
            </div>
            <!-- Row 4: Status and Done By -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="total_price" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Total Price
                    </label>
                    <input
                        type="number"
                        id="total_price"
                        name="total_price"
                        value="{{ old('total_price', $task->total_price) }}"
                        step="0.01"
                        placeholder="Enter Total Price"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        readonly
                    />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Status
                    </label>
                    <select
                        id="status"
                        name="status"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                        <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In-Progress" {{ old('status', $task->status) == 'In-Progress' ? 'selected' : '' }}>In-Progress</option>
                        <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>

            <!-- Row 6: Description and Comments -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="description_action" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Description
                    </label>
                    <textarea
                        id="description_action"
                        name="description_action"
                        placeholder="Enter task description"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    >{{ old('description_action', $task->description_action) }}</textarea>
                </div>
                <div>
                    <label for="comments" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Comments
                    </label>
                    <textarea
                        id="comments"
                        name="comments"
                        placeholder="Enter comments"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    >{{ old('comments', $task->comments) }}</textarea>
                </div>
            </div>

            <!-- Row 7: Reference Number -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="ref_no" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Reference Number
                    </label>
                    <input
                        type="text"
                        id="ref_no"
                        name="ref_no"
                        value="{{ old('ref_no', $task->ref_no) }}"
                        placeholder="Enter reference number"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button
                    type="submit"
                    class="px-6 py-2 rounded bg-primary text-white font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 btn-background"
                >
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const doneBySelect = document.getElementById('done_by');
        const hourlyRateInput = document.getElementById('hourly_rate');
        const hoursWorkedInput = document.getElementById('hours');
        const invoiceAmountInput = document.getElementById('total_price');

        function calculateInvoiceAmount() {
            const hourlyRate = parseFloat(hourlyRateInput.value) || 0;
            const hoursWorked = parseFloat(hoursWorkedInput.value) || 0;
            const invoiceAmount = hourlyRate * hoursWorked;
            invoiceAmountInput.value = invoiceAmount.toFixed(2);
        }

        doneBySelect.addEventListener('change', function() {
            const selectedOption = doneBySelect.options[doneBySelect.selectedIndex];
            const hourlyRate = selectedOption.getAttribute('data-rate');

            if (hourlyRate) {
                hourlyRateInput.value = hourlyRate;
                calculateInvoiceAmount();
            } else {
                hourlyRateInput.value = '';
                invoiceAmountInput.value = '';
            }
        });

        hoursWorkedInput.addEventListener('input', calculateInvoiceAmount);

        if (doneBySelect.value && hoursWorkedInput.value) {
            calculateInvoiceAmount();
        }
    });
</script>
@endsection
