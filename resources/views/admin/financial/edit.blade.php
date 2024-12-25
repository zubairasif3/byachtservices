@extends('admin.layout.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading">
            Edit Financial
        </h2>
        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a></li>
                <li class="font-medium text-primary add-heading">Edit Financial</li>
            </ol>
        </nav>
    </div>

    <!-- Financial Form -->
    <div class="bg-white rounded-md shadow-md border border-stroke p-6 dark:bg-boxdark dark:border-strokedark">
        <form action="{{ route('financials.update', $financial->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT or PATCH method for update -->

            <!-- Transaction Details Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4">Transaction Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Task Selection -->
                    <div>
                        <label for="task_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Task <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="task_id"
                            name="task_id"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                            required
                            onchange="fetchTaskDetails()"
                        >
                            <option value="">Select a Task</option>
                            @foreach ($tasks as $task)
                                <option value="{{ $task->id }}" {{ $financial->task_id == $task->id ? 'selected' : '' }}>
                                    {{ $task->ref_no }} ({{ $task->item }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Customer Selection -->
                    <div class="md:col-span-2">
                        <label for="customer_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Customer
                        </label>
                        <select
                            id="customer_id"
                            name="customer_id"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                            disabled
                        >
                            <option value="">Select a Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $financial->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Worker Selection -->
                    <div>
                        <label for="worker_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Worker
                        </label>
                        <select
                            id="worker_id"
                            name="worker_id"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                            disabled
                        >
                            <option value="">Select a Worker</option>
                            @foreach ($workers as $worker)
                                <option value="{{ $worker->id }}" {{ $financial->worker_id == $worker->id ? 'selected' : '' }}>
                                    {{ $worker->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Invoice Selection -->
                    <div>
                        <label for="invoice_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Invoice
                        </label>
                        <select
                            id="invoice_id"
                            name="invoice_id"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                        >
                            <option value="">Select an Invoice</option>
                            @foreach ($financial->task->invoices as $invoice)
                                <option value="{{ $invoice->id }}"
                                        data-amount="{{ $invoice->paid_amount }}"
                                        {{ $financial->invoice_id == $invoice->id ? 'selected' : '' }}>
                                    {{ $invoice->invoice_no }} (Amount: {{ $invoice->paid_amount }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Financial Information Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4">Financial Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Bank Date -->
                    <div>
                        <label for="bank_date" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Bank Date <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            id="bank_date"
                            name="bank_date"
                            value="{{ $financial->bank_date }}"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                            required
                        >
                    </div>
                    <!-- Bank Reference -->
                    <div>
                        <label for="bank_ref" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Bank Reference
                        </label>
                        <input
                            type="text"
                            id="bank_ref"
                            name="bank_ref"
                            value="{{ $financial->bank_ref }}"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                        >
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label for="supplier" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Supplier
                        </label>
                        <input
                            type="text"
                            id="supplier"
                            name="supplier"
                            value="{{ $financial->supplier }}"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                        >
                    </div>

                    <!-- Details -->
                    <div class="md:col-span-3">
                        <label for="details" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Details
                        </label>
                        <textarea
                            id="details"
                            name="details"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                        >{{ $financial->details }}</textarea>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Amount <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            value="{{ $financial->amount }}"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                            readonly
                        >
                    </div>

                    <!-- Transaction Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Transaction Type <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="type"
                            name="type"
                            class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white"
                            required
                        >
                            <option value="">Select Type</option>
                            <option value="Credit" {{ $financial->type == 'Credit' ? 'selected' : '' }}>Credit</option>
                            <option value="Debit" {{ $financial->type == 'Debit' ? 'selected' : '' }}>Debit</option>
                            <option value="Payment" {{ $financial->type == 'Payment' ? 'selected' : '' }}>Payment</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="px-6 py-2 rounded bg-primary text-white font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 btn-background">
                    Update Financial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
