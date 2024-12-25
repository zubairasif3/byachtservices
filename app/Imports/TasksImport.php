<?php
namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Worker;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TasksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $companyOwner = Customer::firstOrCreate(
            ['name' => $row['boat_customer']],  // Assuming the 'name' field is used for matching
            [
                'name' => $row['boat_customer'],
                'user_id' => Auth::user()->id,
            ]   // Here you might want to create the record if it doesn't exist
        );
        // Check if done_by exists by name or another unique identifier
        $worker = Worker::firstOrCreate(
            ['name' => $row['done_by']],  // Assuming the 'name' field is used for matching
            [
                'name' => $row['done_by'],
                'hourly_rate' => 0,
                'company_owner_id' => $companyOwner->id
            ]   // Create new worker if not found
        );
        return new Task([
            'boat_customer' => $row['boat_customer'],
            'company_owner_id' => $companyOwner->id, // Get the ID of the existing or newly created company_owner
            'date_done' => $row['date_done'],
            'description_action' => $row['description'],
            'status' => $row['status'],
            'done_by' => $worker->id, // Get the ID of the existing or newly created worker
            'hours' => $row['hours'],
            'hourly_rate' => $row['hourly_rate'],
            'worker_type' => $row['worker_type'],
            'comments' => $row['comments'],
            'invoice_number' => $row['invoice_number'],
            'invoice_amount' => $row['invoice_amount'],
            'customer_variable' => $row['customer_variable'],
            'customer_credit' => $row['customer_credit'],
            'customer_debit' => $row['customer_debit'],
            'customer_balance' => $row['customer_balance'],
            'inserted_by' => Auth::user()->id,
        ]);
    }
}
