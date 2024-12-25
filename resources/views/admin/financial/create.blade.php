@extends('admin.layout.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading">
            Create Financial
        </h2>
        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a></li>
                <li class="font-medium text-primary add-heading">Create Financial</li>
            </ol>
        </nav>
    </div>

    <!-- Financial Form -->
    <div class="bg-white rounded-md shadow-md border border-stroke p-6 dark:bg-boxdark dark:border-strokedark">
        <form action="{{ route('financials.store') }}" method="POST">
            @csrf

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
                                <option value="{{ $task->id }}">{{ $task->ref_no }} ({{ $task->item }})</option>
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
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
                                <option value="{{ $worker->id }}">{{ $worker->name }}</option>
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
                        ></textarea>
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
                            <option value="Credit">Credit</option>
                            <option value="Debit">Debit</option>
                            <option value="Payment">Payment</option>
                        </select>
                    </div>
                </div>


            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="px-6 py-2 rounded bg-primary text-white font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 btn-background">
                    Create Financial
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const taskSelect = document.getElementById('task_id');
    const customerSelect = document.getElementById('customer_id');
    const workerSelect = document.getElementById('worker_id');
    const invoiceSelect = document.getElementById('invoice_id');
    const amountField = document.getElementById('amount');

    invoiceSelect.addEventListener('change', async function() {
        // Get the selected option
        const selectedOption = invoiceSelect.options[invoiceSelect.selectedIndex];

        // Get the 'data-amount' attribute from the selected option
        const amount = selectedOption.dataset.amount;

        // Set the value of the amount field
        amountField.value = amount;
    });
    taskSelect.addEventListener('change', async function() {
        const taskId = this.value;

        if (!taskId) {
            resetFields();
            return;
        }

        try {
            // Make an AJAX call to get task details
            const response = await fetch(`{{ url('/tasks/detail/${taskId}') }}`);
            const data = await response.json();

            // Update customer
            if (data.company_owner) {
                customerSelect.value = data.company_owner;
            }

            // Update worker
            if (data.done_by) {
                workerSelect.value = data.done_by;
            }

            // Update invoice options
            if (data.invoices && data.invoices.length > 0) {
                invoiceSelect.innerHTML = '<option value="">Select an Invoice</option>';
                data.invoices.forEach(invoice => {
                    const option = document.createElement('option');
                    option.value = invoice.id;
                    option.textContent = invoice.invoice_no + "(Amount: "+invoice.paid_amount+")";
                    option.dataset.amount = invoice.paid_amount;
                    invoiceSelect.appendChild(option);
                });
            } else {
                invoiceSelect.innerHTML = '<option value="">No invoices available</option>';
            }

        } catch (error) {
            console.error('Error fetching task details:', error);
        }
    });

    function resetFields() {
        customerSelect.value = '';
        workerSelect.value = '';
        invoiceSelect.innerHTML = '<option value="">Select an Invoice</option>';
    }
});
</script>
@endsection
