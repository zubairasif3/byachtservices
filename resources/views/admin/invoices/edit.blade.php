@extends('admin.layout.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading">
            Update Invoice
        </h2>
        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a></li>
                <li class="font-medium text-primary add-heading">Update Invoice</li>
            </ol>
        </nav>
    </div>

    <!-- Invoice Form -->
    <div class="grid grid-cols-1 gap-6">
        <!-- Invoice Details Card -->
        <div class="bg-white rounded-md shadow-md border border-stroke p-6 dark:bg-boxdark dark:border-strokedark">
            <h3 class="text-lg font-semibold mb-4">Invoice Details</h3>
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" id="invoiceForm">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Task Selection -->
                    <div>
                        <label for="task_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Task <span class="text-red-500">*</span>
                        </label>
                        <select id="task_id" name="task_id" class="w-full rounded border border-gray-300 px-4 py-2" required>
                            <option value="">Select a Task</option>
                            @foreach ($tasks as $task)
                                <option value="{{ $task->id }}"
                                    data-customer-id="{{ $task->company_owner }}"
                                    data-worker-id="{{ $task->done_by }}"
                                    data-hourly-rate="{{ $task->hourly_rate }}"
                                    data-hours="{{ $task->hours }}"
                                    {{ $task->id == $invoice->task_id ? 'selected' : '' }}
                                    data-pending-amount="{{ $task->pending_amount() }}"
                                    >
                                    {{ $task->ref_no }} ({{ $task->item }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Customer -->
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Customer
                        </label>
                        <select id="customer_id" name="customer_id" class="w-full rounded border border-gray-300 px-4 py-2" disabled>
                            <option value="">Select a Company Owner</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    data-previous-blance="{{ $customer->customer_runing_balance() }}"
                                    {{ $customer->id == $invoice->customer_id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Worker -->
                    <div>
                        <label for="worker_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Worker
                        </label>
                        <select id="worker_id" name="worker_id" class="w-full rounded border border-gray-300 px-4 py-2" disabled>
                            <option value="">Select a Worker</option>
                            @foreach ($workers as $worker)
                                <option value="{{ $worker->id }}" {{ $worker->id == $invoice->worker_id ? 'selected' : '' }}>
                                    {{ $worker->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Invoice Date -->
                    <div>
                        <label for="invoice_date" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Invoice Date
                        </label>
                        <input type="date" id="invoice_date" name="invoice_date"
                            class="w-full rounded border border-gray-300 px-4 py-2"
                            value="{{ $invoice->invoice_date }}" required>
                    </div>

                    <!-- Invoice Number -->
                    <div>
                        <label for="invoice_no" class="block text-sm font-medium text-black dark:text-white mb-2">
                            Invoice Number
                        </label>
                        <input type="text" id="invoice_no" name="invoice_no"
                            class="w-full rounded border border-gray-300 px-4 py-2"
                            value="{{ $invoice->invoice_no }}" required>
                    </div>
                </div>

                <!-- Financial Details Card -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Financial Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Invoice Amount -->
                        <div>
                            <label for="invoice_amount" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Invoice Amount
                            </label>
                            <input type="number" id="invoice_amount" name="invoice_amount"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->invoice_amount }}" readonly>
                        </div>

                        <!-- Pending Amount -->
                        <div>
                            <label for="pending_amount" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Pending Amount
                            </label>
                            <input type="number" id="pending_amount" name="pending_amount"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->task->pending_amount() }}" readonly>
                        </div>

                        <!-- Paid Amount -->
                        <div>
                            <label for="paid_amount" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Paid Amount
                            </label>
                            <input type="number" id="paid_amount" name="paid_amount"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->paid_amount }}">
                        </div>
                    </div>

                    <!-- Adjustments -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="customer_variable" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Customer Variable
                            </label>
                            <input type="number" id="customer_variable" name="customer_variable"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->customer_variable }}">
                        </div>

                        <div>
                            <label for="customer_credit" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Customer Credit
                            </label>
                            <input type="number" id="customer_credit" name="customer_credit"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->customer_credit }}">
                        </div>

                        <div>
                            <label for="customer_debit" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Customer Debit
                            </label>
                            <input type="number" id="customer_debit" name="customer_debit"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->customer_debit }}">
                        </div>
                    </div>

                    <!-- Balance Information -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="previous_balance" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Previous Balance
                            </label>
                            <input type="number" id="previous_balance" name="previous_balance"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->customer->customer_runing_balance() }}" readonly>
                        </div>

                        <div>
                            <label for="balance" class="block text-sm font-medium text-black dark:text-white mb-2">
                                This Invoice Balance
                            </label>
                            <input type="number" id="balance" name="balance"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->balance }}" readonly>
                        </div>

                        <div>
                            <label for="total_balance" class="block text-sm font-medium text-black dark:text-white mb-2">
                                Total Balance
                            </label>
                            <input type="number" id="total_balance" name="total_balance"
                                class="w-full rounded border border-gray-300 px-4 py-2" value="{{ $invoice->total_balance }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-right mt-6">
                    <button type="submit" class="px-6 py-2 rounded bg-primary text-white font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                        Update Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('invoiceForm');
        const fields = {
            task: document.getElementById('task_id'),
            customer: document.getElementById('customer_id'),
            worker: document.getElementById('worker_id'),
            invoiceAmount: document.getElementById('invoice_amount'),
            pendingAmount: document.getElementById('pending_amount'),
            paidAmount: document.getElementById('paid_amount'),
            customerVariable: document.getElementById('customer_variable'),
            customerCredit: document.getElementById('customer_credit'),
            customerDebit: document.getElementById('customer_debit'),
            previousBalance: document.getElementById('previous_balance'),
            balance: document.getElementById('balance'),
            totalBalance: document.getElementById('total_balance')
        };

        // Task selection change handler
        fields.task.addEventListener('change', function() {
            const taskId = this.value;
            if (!taskId) {
                resetFields();
                return;
            }

            const selectedTask = this.options[this.selectedIndex];
            const customerId = selectedTask.dataset.customerId;
            const workerId = selectedTask.dataset.workerId;
            const hourlyRate = parseFloat(selectedTask.dataset.hourlyRate);
            const pendingAmount1 = selectedTask.dataset.pendingAmount;
            const hours = parseFloat(selectedTask.dataset.hours);

            // Update related fields
            fields.customer.value = customerId;
            fields.worker.value = workerId;

            // Calculate invoice amount
            const invoiceAmount = hourlyRate * hours;
            fields.invoiceAmount.value = invoiceAmount.toFixed(2);

            // Get customer's previous balance from the customer select option
            const customerOption = [...fields.customer.options].find(option => option.value === customerId);
            if (customerOption) {
                const previousBalance = parseFloat(customerOption.dataset.previousBlance) || 0;
                fields.previousBalance.value = previousBalance.toFixed(2);
            }

            // Set pending amount equal to invoice amount initially
            // You can modify this if you want to use the data-pending-amount from task
            fields.pendingAmount.value = pendingAmount1.toFixed(2);

            calculateBalances();
        });

        calculateBalances();
        // Add event listeners for reactive calculations
        ['paidAmount', 'customerVariable', 'customerCredit', 'customerDebit'].forEach(fieldName => {
            fields[fieldName].addEventListener('input', calculateBalances);
        });

        function calculateBalances() {
            const paidAmount = parseFloat(fields.paidAmount.value) || 0;
            const customerVariable = Math.max(parseFloat(fields.customerVariable.value) || 1, 1);
            const customerCredit = parseFloat(fields.customerCredit.value) || 0;
            const customerDebit = parseFloat(fields.customerDebit.value) || 0;
            const previousBalance = parseFloat(fields.previousBalance.value) || 0;

            // Calculate this invoice's balance
            const balance = paidAmount - ((customerVariable / 100) * paidAmount) + customerCredit - customerDebit;
            fields.balance.value = balance.toFixed(2);

            // Calculate total balance
            const totalBalance = balance + previousBalance;
            fields.totalBalance.value = totalBalance.toFixed(2);
        }

        function resetFields() {
            fields.customer.value = '';
            fields.worker.value = '';
            fields.invoiceAmount.value = '';
            fields.pendingAmount.value = '';
            fields.previousBalance.value = '';
            fields.balance.value = '';
            fields.totalBalance.value = '';
        }
    });
</script>
@endsection
