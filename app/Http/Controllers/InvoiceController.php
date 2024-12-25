<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskNotification;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch related data for dropdowns
        if (Auth::user()->hasRole(['Admin', 'Manager'])) {
            $invoices = Invoice::all();
        }else if (Auth::user()->hasRole('Customer')){
            $invoices = Auth::user()->invoicesAsCustomer;

        }else if (Auth::user()->hasRole('Worker')){

            $invoices = Auth::user()->invoicesAsWorker;
        }
        return view('admin.invoices.index', compact('invoices'));
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
        return view('admin.invoices.create', compact('tasks','customers','workers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate all required fields
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            // 'customer_id' => 'required|exists:customers,id',
            // 'worker_id' => 'required|exists:workers,id',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|unique:invoices,invoice_no',
            'invoice_amount' => 'required|numeric|min:0',
            'pending_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0|max:' . $request->pending_amount,
            'customer_variable' => 'required|numeric|min:1',
            'customer_credit' => 'required|numeric|min:0',
            'customer_debit' => 'required|numeric|min:0',
            'previous_balance' => 'required|numeric',
            'balance' => 'required|numeric',
            'total_balance' => 'required|numeric',
        ]);

        try {
            $task = Task::find($request->task_id);
            // Create the invoice
            $invoice = new Invoice();
            $invoice->task_id = $request->task_id;
            $invoice->customer_id = $task->company_owner;
            $invoice->worker_id = $task->done_by;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->invoice_no = $request->invoice_no;
            $invoice->invoice_amount = $request->invoice_amount;
            // $invoice->pending_amount = $request->pending_amount;
            $invoice->paid_amount = $request->paid_amount;
            $invoice->customer_variable = $request->customer_variable;
            $invoice->customer_credit = $request->customer_credit;
            $invoice->customer_debit = $request->customer_debit;
            // $invoice->previous_balance = $request->previous_balance;
            $invoice->balance = $request->balance;
            // $invoice->total_balance = $request->total_balance;
            $invoice->save();

            // Optionally, notify users about the invoice update (e.g., Admins, Customer, Worker)
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new TaskNotification(
                    "An invoice has been created: {$invoice->invoice_no}",
                    url("/invoices")
                ));
            }

            $customer = User::find($invoice->customer_id);
            if ($customer) {
                $customer->notify(new TaskNotification(
                    "An invoice of your task has been created: {$invoice->invoice_no}",
                    url("/invoices")
                ));
            }

            if ($invoice->worker_id) {
                $worker = User::find($invoice->worker_id);
                if ($worker) {
                    $worker->notify(new TaskNotification(
                        "An invoice of your task has been created: {$invoice->invoice_no}",
                        url("worker/invoices")
                    ));
                }
            }

            return redirect()
                ->route('invoices.index')
                ->with('success', 'Invoice created successfully!');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating invoice: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
       // Get all tasks with relevant data
       $tasks = Task::all(); // You can modify this to retrieve tasks based on conditions if needed

       $customers = User::role('Customer')->get();
       $workers = User::role('Worker')->get();
       // Pass tasks to the view
       return view('admin.invoices.edit', compact('invoice', 'tasks','customers','workers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
       {
        // dd($request->all());
        // Validate all required fields
        // $validated = $request->validate([
        //     'task_id' => 'required|exists:tasks,id',
        //     'invoice_date' => 'required|date',
        //     'invoice_no' => 'required|unique:invoices,invoice_no',
        //     'invoice_amount' => 'required|numeric|min:0',
        //     'pending_amount' => 'required|numeric|min:0',
        //     'paid_amount' => 'required|numeric|min:0|max:' . $request->pending_amount,
        //     'customer_variable' => 'required|numeric|min:1',
        //     'customer_credit' => 'required|numeric|min:0',
        //     'customer_debit' => 'required|numeric|min:0',
        //     'previous_balance' => 'required|numeric',
        //     'balance' => 'required|numeric',
        //     'total_balance' => 'required|numeric',
        // ]);
        // dd($request->all());

        try {
            $task = Task::find($request->task_id);
            // Create the invoice
            $invoice->task_id = $request->task_id;
            $invoice->customer_id = $task->company_owner;
            $invoice->worker_id = $task->done_by;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->invoice_no = $request->invoice_no;
            $invoice->invoice_amount = $request->invoice_amount;
            $invoice->paid_amount = $request->paid_amount;
            $invoice->customer_variable = $request->customer_variable;
            $invoice->customer_credit = $request->customer_credit;
            $invoice->customer_debit = $request->customer_debit;
            $invoice->balance = $request->balance;
            $invoice->save();

            // Optionally, notify users about the invoice update (e.g., Admins, Customer, Worker)
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new TaskNotification(
                    "An invoice has been updated: {$invoice->invoice_no}",
                    url("/invoices")
                ));
            }

            $customer = User::find($invoice->customer_id);
            if ($customer) {
                $customer->notify(new TaskNotification(
                    "An invoice of your task has been updated: {$invoice->invoice_no}",
                    url("/invoices")
                ));
            }

            if ($invoice->worker_id) {
                $worker = User::find($invoice->worker_id);
                if ($worker) {
                    $worker->notify(new TaskNotification(
                        "An invoice of your task has been updated: {$invoice->invoice_no}",
                        url("worker/invoices")
                    ));
                }
            }

            return redirect()
                ->route('invoices.index')
                ->with('success', 'Invoice updated successfully!');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating invoice: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {

        // Optionally, notify users about the invoice update (e.g., Admins, Customer, Worker)
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new TaskNotification(
                "An invoice has been deleted: {$invoice->invoice_no}",
                url("/invoices")
            ));
        }

        $customer = User::find($invoice->customer_id);
        if ($customer) {
            $customer->notify(new TaskNotification(
                "An invoice of your task has been deleted: {$invoice->invoice_no}",
                url("/invoices")
            ));
        }

        if ($invoice->worker_id) {
            $worker = User::find($invoice->worker_id);
            if ($worker) {
                $worker->notify(new TaskNotification(
                    "An invoice of your task has been deleted: {$invoice->invoice_no}",
                    url("worker/invoices")
                ));
            }
        }

        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully');
    }
}
