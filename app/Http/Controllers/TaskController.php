<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\TasksExport;
use App\Imports\TasksImport;
use App\Models\CustomersBoat;
use App\Notifications\TaskNotification;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    public function export()
    {
        return Excel::download(new TasksExport, 'tasks.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new TasksImport, $request->file('file'));

        return redirect()->route('tasks.index')->with('success', 'Tasks imported successfully!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch related data for dropdowns
        if (Auth::user()->hasRole(['Admin','Manager'])) {
            $tasks = Task::all();
        }else if (Auth::user()->hasRole('Customer')){
            $tasks = Auth::user()->tasksAsCustomer;

        }else if (Auth::user()->hasRole('Worker')){

            $tasks = Auth::user()->tasksAsWorker;
        }
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->hasRole(['Admin', 'Manager'])) {
            $customers = User::role('Customer')->get();
            $customer_boats = CustomersBoat::all();
        }else{
            $customers = Auth::user();
            $customer_boats = CustomersBoat::where('user_id', $customers->id)->get();
        }
        $workers = User::role('Worker')->get();
        return view('admin.tasks.create', compact('customers', 'customer_boats','workers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'customer_boat_id' => 'required|exists:customers_boats,id', // Boat customer
            'company_owner' => 'required|exists:users,id', // Company owner (user)
            'date_done' => 'nullable|date',
            'item' => 'nullable|string|max:255', // Item details
            'location' => 'nullable|string|max:255', // Location
            'done_by' => 'nullable|exists:users,id', // Worker ID
            'worker_type' => 'nullable|string|max:255', // Worker type
            'status' => 'required|in:Pending,In-Progress,Completed', // Task status
            'description_action' => 'nullable|string', // Task description
            'comments' => 'nullable|string', // Additional comments
            'ref_no' => 'nullable|string|max:255', // Reference number
            'hours' => 'nullable|numeric|min:0', // Hours worked
            'hourly_rate' => 'nullable|numeric|min:0', // Hourly rate
        ]);

        // Collect the validated data
        $data = $request->all();

        // You might want to calculate the total cost (e.g., hours * hourly_rate)
        if ($request->has('hours') && $request->has('hourly_rate')) {
            $data['total_cost'] = $request->hours * $request->hourly_rate;
        }

        // Add the logged-in user ID as the person who inserted the task
        $data['inserted_by'] = Auth::user()->id;

        // Create the new task
        $task = new Task();
        $task->fill($data);

        // Save the task
        $task->save();

        // Notify Admins
        $admins = User::role('admin')->get(); // Replace 'role' with your actual admin-identifying field
        foreach ($admins as $admin) {
            $admin->notify(new TaskNotification(
                "A new task has been created: {$task->item}",
                url("/tasks")
            ));
        }

        // Notify the Related Customer
        $customer = User::find($task->company_owner_id);
        if ($customer) { // Assuming the customer has an associated user account
            $customer->notify(new TaskNotification(
                "Your task has been created: {$task->item}",
                url("/tasks")
            ));
        }

        // Notify the Assigned Worker
        if ($task->done_by) {
            $worker = User::find($task->done_by);
            if ($worker) { // Assuming the worker has an associated user account
                $worker->notify(new TaskNotification(
                    "You have been assigned a new task: {$task->item}",
                    url("worker/tasks")
                ));
            }
        }
        // Redirect back with a success message
        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch related data for dropdowns
        // $task = Task::find($id);
        // $companyOwners = Customer::all();
        // $workers = Worker::all();
        // return view('admin.tasks.show', compact('task', 'companyOwners', 'workers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the task by its ID
        $task = Task::findOrFail($id);

        // Check if the authenticated user has the required role
        if (Auth::user()->hasRole(['Admin', 'Manager'])) {
            $customers = User::role('Customer')->get();
            $customer_boats = CustomersBoat::all();
        } else {
            $customers = Auth::user();
            $customer_boats = CustomersBoat::where('user_id', $customers->id)->get();
        }

        // Fetch workers based on the role
        $workers = User::role('Worker')->get();

        // Return the edit view with the task data and other necessary data
        return view('admin.tasks.edit', compact('task', 'customers', 'customer_boats', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'customer_boat_id' => 'required|exists:customers_boats,id', // Boat customer
            'company_owner' => 'required|exists:users,id', // Company owner (user)
            'date_done' => 'nullable|date',
            'item' => 'nullable|string|max:255', // Item details
            'location' => 'nullable|string|max:255', // Location
            'done_by' => 'nullable|exists:users,id', // Worker ID
            'worker_type' => 'nullable|string|max:255', // Worker type
            'status' => 'required|in:Pending,In-Progress,Completed', // Task status
            'description_action' => 'nullable|string', // Task description
            'comments' => 'nullable|string', // Additional comments
            'ref_no' => 'nullable|string|max:255', // Reference number
            'hours' => 'nullable|numeric|min:0', // Hours worked
            'hourly_rate' => 'nullable|numeric|min:0', // Hourly rate
        ]);

        // Find the existing task by ID
        $task = Task::findOrFail($id);

        // Collect the validated data
        $data = $request->all();

        // Calculate the total cost if hours and hourly_rate are provided
        if ($request->has('hours') && $request->has('hourly_rate')) {
            $data['total_cost'] = $request->hours * $request->hourly_rate;
        }

        // Add the logged-in user ID as the person who updated the task
        $data['updated_by'] = Auth::user()->id;

        // Update the task with the new data
        $task->fill($data);

        // Save the updated task
        $task->save();

        // Optionally, notify users about the task update (e.g., Admins, Customer, Worker)
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new TaskNotification(
                "A task has been updated: {$task->item}",
                url("/tasks")
            ));
        }

        $customer = User::find($task->company_owner_id);
        if ($customer) {
            $customer->notify(new TaskNotification(
                "Your task has been updated: {$task->item}",
                url("/tasks")
            ));
        }

        if ($task->done_by) {
            $worker = User::find($task->done_by);
            if ($worker) {
                $worker->notify(new TaskNotification(
                    "Your assign task has been updated: {$task->item}",
                    url("worker/tasks")
                ));
            }
        }

        // Redirect back with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Optionally, notify users about the task deletion (e.g., Admins, Customer, Worker)
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new TaskNotification(
                "A task has been deleted: {$task->item}",
                url("/#")
            ));
        }

        $customer = User::find($task->company_owner_id);
        if ($customer) {
            $customer->notify(new TaskNotification(
                "your task has been deleted: {$task->item}",
                url("/#")
            ));
        }

        if ($task->done_by) {
            $worker = User::find($task->done_by);
            if ($worker) {
                $worker->notify(new TaskNotification(
                    "Your assign task has been deleted: {$task->item}",
                    url("/#")
                ));
            }
        }

        $task->delete();
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }


}
