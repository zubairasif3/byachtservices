<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\FinancialTransaction;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskNotification;

class FinancialController extends Controller
{
    public function index(){
        // Fetch related data for dropdowns
        if (Auth::user()->hasRole(['Admin', 'Manager'])) {
            $financials = FinancialTransaction::all();
        }else if (Auth::user()->hasRole('Customer')){
            $financials = Auth::user()->financialTransactionsAsCustomer;

        }else if (Auth::user()->hasRole('Worker')){

            $financials = Auth::user()->financialTransactionsAsWorker;
        }
        return view('admin.financial.index', compact('financials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all tasks with relevant data
        $tasks = Task::all(); // You can modify this to retrieve tasks based on conditions if needed

        $customers = User::role('Customer')->get();
        $workers = User::role('Worker')->get();
        // Pass tasks to the view
        return view('admin.financial.create', compact('tasks','customers','workers'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'task_id' => 'required|exists:tasks,id',
                'invoice_id' => 'nullable|exists:invoices,id',
                'bank_date' => 'required|date',
                'bank_ref' => 'nullable|string|max:255',
                'supplier' => 'nullable|string|max:255',
                'details' => 'nullable|string',
                'amount' => 'required|numeric|min:0',
                'type' => 'required|in:Credit,Debit,Payment',
            ]);

            $invoice = Invoice::find($request->invoice_id);

            // Create the financial record
            $financial = FinancialTransaction::create([
                'task_id' => $validated['task_id'],
                'customer_id' => $invoice->customer_id,
                'worker_id' => $invoice->worker_id,
                'invoice_id' => $validated['invoice_id'],
                'bank_date' => $validated['bank_date'],
                'bank_ref' => $validated['bank_ref'],
                'supplier' => $validated['supplier'],
                'details' => $validated['details'],
                'amount' => $validated['amount'],
                'type' => $validated['type'],
            ]);

            // Optionally, notify users about the invoice update (e.g., Admins, Customer, Worker)
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new TaskNotification(
                    "A financial transaction has been created: {$financial->bank_ref}",
                    url("/financials")
                ));
            }

            $customer = User::find($invoice->customer_id);
            if ($customer) {
                $customer->notify(new TaskNotification(
                    "A financial transaction of your invoice has been created: {$financial->bank_ref}",
                    url("/financials")
                ));
            }

            if ($invoice->worker_id) {
                $worker = User::find($invoice->worker_id);
                if ($worker) {
                    $worker->notify(new TaskNotification(
                        "A financial transaction of your invoice has been created: {$financial->bank_ref}",
                        url("worker/financials")
                    ));
                }
            }

            return redirect()
                ->route('financials.index')
                ->with('success', 'Financial Transaction created successfully!');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating financials: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            // Find the financial transaction by ID
            $financial = FinancialTransaction::findOrFail($id);

            // Get all tasks, customers, and workers
            $tasks = Task::all();
            $customers = User::role('Customer')->get();
            $workers = User::role('Worker')->get();

            // Pass the data to the view
            return view('admin.financial.edit', compact('financial', 'tasks', 'customers', 'workers'));
        } catch (\Exception $e) {
            return redirect()
                ->route('financials.index')
                ->with('error', 'Error loading the financial record: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the financial transaction
            $financial = FinancialTransaction::findOrFail($id);

            // Validate the incoming request
            $validated = $request->validate([
                'task_id' => 'required|exists:tasks,id',
                'invoice_id' => 'nullable|exists:invoices,id',
                'bank_date' => 'required|date',
                'bank_ref' => 'nullable|string|max:255',
                'supplier' => 'nullable|string|max:255',
                'details' => 'nullable|string',
                'amount' => 'required|numeric|min:0',
                'type' => 'required|in:Credit,Debit,Payment',
            ]);

            // Update financial transaction details
            $invoice = Invoice::find($request->invoice_id);

            $financial->update([
                'task_id' => $validated['task_id'],
                'customer_id' => $invoice ? $invoice->customer_id : null,
                'worker_id' => $invoice ? $invoice->worker_id : null,
                'invoice_id' => $validated['invoice_id'],
                'bank_date' => $validated['bank_date'],
                'bank_ref' => $validated['bank_ref'],
                'supplier' => $validated['supplier'],
                'details' => $validated['details'],
                'amount' => $validated['amount'],
                'type' => $validated['type'],
            ]);

            // Optionally, notify users about the update
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new TaskNotification(
                    "Financial transaction updated: {$financial->bank_ref}",
                    url("/financials")
                ));
            }

            $customer = User::find($financial->customer_id);
            if ($customer) {
                $customer->notify(new TaskNotification(
                    "A financial transaction associated with you has been updated: {$financial->bank_ref}",
                    url("/financials")
                ));
            }

            if ($financial->worker_id) {
                $worker = User::find($financial->worker_id);
                if ($worker) {
                    $worker->notify(new TaskNotification(
                        "A financial transaction associated with you has been updated: {$financial->bank_ref}",
                        url("worker/financials")
                    ));
                }
            }

            return redirect()
                ->route('financials.index')
                ->with('success', 'Financial Transaction updated successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating financials: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialTransaction $financial)
    {

        // Optionally, notify users about the financial update (e.g., Admins, Customer, Worker)
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new TaskNotification(
                "A financial transaction has been deleted: {$financial->bank_ref}",
                url("/financials")
            ));
        }

        $customer = User::find($financial->customer_id);
        if ($customer) {
            $customer->notify(new TaskNotification(
                "A financial transaction of your invoice has been deleted: {$financial->bank_ref}",
                url("/financials")
            ));
        }

        if ($financial->worker_id) {
            $worker = User::find($financial->worker_id);
            if ($worker) {
                $worker->notify(new TaskNotification(
                    "A financial transaction of your invoice has been deleted: {$financial->bank_ref}",
                    url("worker/financials")
                ));
            }
        }

        $financial->delete();
        return redirect()->route('financials.index')
            ->with('success', 'Financial Transaction deleted successfully');
    }
}
