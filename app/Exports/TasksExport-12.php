<?php
namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Task::query()->with(['companyOwner', 'worker']); // Include relationships
    }

    public function map($task): array
    {
        return [
            $task->id,
            $task->boat_customer,
            $task->companyOwner ? $task->companyOwner->name : 'N/A', // Show the name instead of ID
            $task->date_done,
            $task->description_action,
            $task->status,
            $task->worker ? $task->worker->name : 'N/A', // Show the name instead of ID
            $task->hours,
            $task->hourly_rate,
            $task->worker_type,
            $task->comments,
            $task->invoice_number,
            $task->invoice_amount,
            $task->customer_variable,
            $task->customer_credit,
            $task->customer_debit,
            $task->customer_balance,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Boat Customer',
            'Company Owner',
            'Date Done',
            'Description',
            'Status',
            'Done By',
            'Hours',
            'Hourly Rate',
            'Worker Type',
            'Comments',
            'Invoice Number',
            'Invoice Amount',
            'Customer Variable',
            'Customer Credit',
            'Customer Debit',
            'Customer Balance',
        ];
    }
}
