<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Invoice;
use App\Models\FinancialTransaction;
use App\Models\CustomersBoat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        // Redirect based on user role
        $user = Auth::user();
        if ($user->hasRole('Worker')) {
            return redirect()->route('worker.dashboard');
        }
        if($user->hasRole(['Admin', 'Manager'])){
            // card counts
            $counts = [
                "totalTasks" => Task::count(),
                "compeletedTasks" => Task::where('status','Completed')->count(),
                "inprogressTasks" => Task::where('status','In-Progress')->count(),
                "pendingTasks" => Task::where('status','Pending')->count(),
                "totalCustomers" => CustomersBoat::count(),
                "totalUsers" => User::role('Customer')->count(),
                "totalManagers" => User::role('Manager')->count(),
                "totalWorkers" => User::role('Worker')->count(),
            ];

            // // top workers
            //     // Step 1: Retrieve all workers and their completed tasks
            //     $workers = Worker::with(['tasks' => function($query) {
            //         $query->where('status', 'Completed'); // Filter completed tasks
            //     }])->get();
            //     // Step 2: Calculate total hours worked for each worker
            //     $workersWithTotalHours = $workers->map(function($worker) {
            //         $worker->total_hours_worked = $worker->totalHoursWorked(); // Calculate total hours worked
            //         return $worker;
            //     });
            //     // Step 3: Sort workers by total hours worked in descending order
            //     $topWorkers = $workersWithTotalHours->sortByDesc('total_hours_worked')->take(10);

            // // top Customers
            //     // Step 1: Retrieve all customers and their completed tasks
            //     $customers = Customer::with(['tasks' => function($query) {
            //         $query->where('status', 'Completed'); // Filter completed tasks
            //     }])->get();
            //     // Step 2: Calculate remainng balance for each customer
            //     $workersWithRemainingBalance = $customers->map(function($customer) {
            //         $customer->remaining_balance = $customer->remainingBalance(); // Calculate total hours worked
            //         return $customer;
            //     });
            //     // Step 3: Sort customers by remainng balance customer in descending order
            //     $topCustomers = $workersWithRemainingBalance->sortByDesc('remaining_balance')->take(10);

        }elseif ($user->hasRole('Customer')) {
            // card counts
            $user->load('tasksAsCustomer'); // This loads the tasks for each customer

            // card counts
            $counts = [
                "totalTasks" => $user->tasksAsCustomer->count(),
                "compeletedTasks" => $user->tasksAsCustomer->where('status', 'Completed')->count(),
                "inprogressTasks" => $user->tasksAsCustomer->where('status', 'In-Progress')->count(),
                "pendingTasks" => $user->tasksAsCustomer->where('status', 'Pending')->count(),
            ];

            return view('admin.worker-dashboard', compact('counts'));
        }

        return view('admin.dashboard', compact('counts'));
        // return view('admin.dashboard', compact('counts','topWorkers','topCustomers'));
    }

    public function WorkerDashboard()
    {
        $worker = Auth::user();
        // card counts
        $counts = [
            "totalTasks" => $worker->tasksAsWorker->count(),
            "compeletedTasks" => $worker->tasksAsWorker->where('status','Completed')->count(),
            "inprogressTasks" => $worker->tasksAsWorker->where('status','In-Progress')->count(),
            "pendingTasks" => $worker->tasksAsWorker->where('status','Pending')->count(),
        ];
        return view('admin.worker-dashboard', compact('counts'));
    }
}
