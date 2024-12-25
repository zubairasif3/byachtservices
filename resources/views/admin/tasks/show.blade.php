@extends('admin.layout.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading">
            View Task
        </h2>
        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary add-heading">View Task</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- Task Form -->
    <div class="bg-white rounded-md shadow-md border border-stroke p-6 dark:bg-boxdark dark:border-strokedark">
        <form  id="myForm">
            <!-- Row 1: Boat Customer and Company Owner -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="boat_customer" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Boat Customer <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="boat_customer"
                        name="boat_customer"
                        value="{{ old('boat_customer', $task->boat_customer) }}"
                        placeholder="Enter the boat customer's name"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    />
                </div>
                <div>
                    <label for="company_owner_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Company Owner <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="company_owner_id"
                        name="company_owner_id"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                        <option value="">Select a Company Owner</option>
                        @foreach ($companyOwners as $owner)
                            <option value="{{ $owner->id }}" {{ old('company_owner_id', $task->company_owner_id) == $owner->id ? 'selected' : '' }}>
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
                    <label for="description_action" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Description
                    </label>
                    <textarea
                        id="description_action"
                        name="description_action"
                        rows="4"
                        placeholder="Enter task description"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    >{{ old('description_action', $task->description_action) }}</textarea>
                </div>
            </div>

            <!-- Row 4: Status and Done By -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                            <option value="{{ $worker->id }}" {{ old('done_by', $task->done_by) == $worker->id ? 'selected' : '' }}>
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
                        value="{{ old('hourly_rate') }}"
                        step="0.01"
                        placeholder="Enter hourly rate"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>
            <!-- Row 6: Worker Type and Comments -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="worker_type" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Worker Type
                    </label>
                    <input
                        type="text"
                        id="worker_type"
                        name="worker_type"
                        value="{{ old('worker_type', $task->worker_type) }}"
                        placeholder="Enter worker type"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                <div>
                    <label for="comments" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Comments
                    </label>
                    <textarea
                        id="comments"
                        name="comments"
                        rows="4"
                        placeholder="Enter comments"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    >{{ old('comments', $task->comments) }}</textarea>
                </div>
            </div>

            <!-- Row 7: Reference Number and Bank Date -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="ref_number" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Reference Number
                    </label>
                    <input
                        type="text"
                        id="ref_number"
                        name="ref_number"
                        value="{{ old('ref_number', $task->ref_number) }}"
                        placeholder="Enter reference number"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                <div>
                    <label for="bank_date" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Bank Date
                    </label>
                    <input
                        type="datetime-local"
                        id="bank_date"
                        name="bank_date"
                        value="{{ old('bank_date', $task->bank_date) }}"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <!-- Row 8: Bank Reference and Supplier -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="bank_ref" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Bank Reference
                    </label>
                    <input
                        type="text"
                        id="bank_ref"
                        name="bank_ref"
                        value="{{ old('bank_ref', $task->bank_ref) }}"
                        placeholder="Enter bank reference"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                <div>
                    <label for="supplier" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Supplier
                    </label>
                    <input
                        type="text"
                        id="supplier"
                        name="supplier"
                        value="{{ old('supplier', $task->supplier) }}"
                        placeholder="Enter supplier name"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <!-- Row 9: Details and Invoice Number -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="details" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Details
                    </label>
                    <textarea
                        id="details"
                        name="details"
                        rows="4"
                        placeholder="Enter additional details"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    >{{ old('details', $task->details) }}</textarea>
                </div>
                <div>
                    <label for="invoice_number" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Invoice Number
                    </label>
                    <input
                        type="text"
                        id="invoice_number"
                        name="invoice_number"
                        value="{{ old('invoice_number', $task->invoice_number) }}"
                        placeholder="Enter invoice number"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <!-- Row 10: Invoice Amount and Customer Variable -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="invoice_amount" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Invoice Amount
                    </label>
                    <input
                        type="number"
                        id="invoice_amount"
                        name="invoice_amount"
                        value="{{ old('invoice_amount', $task->invoice_amount) }}"
                        step="0.01"
                        placeholder="Enter invoice amount"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                <div>
                    <label for="customer_variable" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Customer Variable
                    </label>
                    <input
                        type="number"
                        id="customer_variable"
                        name="customer_variable"
                        value="{{ old('customer_variable', $task->customer_variable) }}"
                        step="0.01"
                        placeholder="Enter customer variable"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <!-- Row 11: Customer Credit and Debit -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="customer_credit" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Customer Credit
                    </label>
                    <input
                        type="number"
                        id="customer_credit"
                        name="customer_credit"
                        value="{{ old('customer_credit', $task->customer_credit) }}"
                        step="0.01"
                        placeholder="Enter customer credit"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                <div>
                    <label for="customer_debit" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Customer Debit
                    </label>
                    <input
                        type="number"
                        id="customer_debit"
                        name="customer_debit"
                        value="{{ old('customer_debit', $task->customer_debit) }}"
                        step="0.01"
                        placeholder="Enter customer debit"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <!-- Row 12: Customer Balance and Receipt -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="customer_balance" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Customer Balance
                    </label>
                    <input
                        type="number"
                        id="customer_balance"
                        name="customer_balance"
                        value="{{ old('customer_balance', $task->customer_balance) }}"
                        step="0.01"
                        placeholder="Enter customer balance"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
                {{-- <div>
                    <label for="receipt" class="block text-sm font-medium text-black dark:text-white mb-2">
                        Receipt
                    </label>
                    <input
                        type="file"
                        id="receipt"
                        name="receipt"
                        class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div> --}}
            </div>


            <!-- Submit Button -->
            <div class="text-right">
                <a
                    href="{{ route('tasks.index') }}"
                    class="px-6 py-2 rounded bg-primary text-white font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 btn-background"
                >
                Back
                </a>
            </div>
        </form>
    </div>
</div>
<script>
    // JavaScript function to disable all inputs in the form
    const form = document.getElementById('myForm');

    // Get all input, textarea, and select elements within the form
    const inputs = form.querySelectorAll('input, textarea, select');

    // Disable each input
    inputs.forEach(input => {
    input.disabled = true;
    });
</script>
@endsection
