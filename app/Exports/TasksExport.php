<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tasks = Task::with([
            'customerBoat',
            'companyOwner',
            'worker',
            'invoices',
            'financialTransactions'
        ])->get();

        // Map task data
        $data = $tasks->map(function ($task) {
            // Get the first invoice (if exists)
            $invoice = $task->invoices->first() ?? null;

            // Get the first financial transaction (if exists)
            $financialTransaction = $task->financialTransactions->first() ?? null;

            return [
                'boat' => $task->customerBoat?->name ?? '',
                'customer_company' => $task->companyOwner?->name ?? '',
                'owner' => $task->companyOwner?->name ?? '',
                'date_done' => $task->date_done,
                'item' => $task->item,
                'location' => $task->location,
                'description_action' => $task->description_action,
                'done_by' => $task->worker?->name ?? '',
                'inserted_by' => $task->companyOwner?->name ?? '',
                'hours' => $task->hours,
                'worker_type' => $task->worker_type,
                'comments' => $task->comments,
                'status' => $task->status,
                'ref_no' => $task->ref_no,
                'bank_date' => $financialTransaction?->bank_date ?? '',
                'bank_ref' => $financialTransaction?->bank_ref ?? '',
                'supplier' => $financialTransaction?->supplier ?? '',
                'transaction_details' => $financialTransaction?->details ?? '',
                'invoice_no' => $invoice?->invoice_no ?? '',
                'invoice_amount' => $invoice?->invoice_amount ?? '',
                'customer_variable' => $invoice?->customer_variable ?? '',
                'customer_credit' => (float) ($invoice?->customer_credit ?? 0),
                'customer_debit' => (float) ($invoice?->customer_debit ?? 0),
                'client_balance' => (float) ($invoice?->balance ?? 0),
                'receipt_link' => '', // You might want to implement a method to generate receipt links
            ];
        });

        // Calculate totals
        $totals = [
            'boat' => '',
            'customer_company' => '',
            'owner' => '',
            'date_done' => '',
            'item' => '',
            'location' => '',
            'description_action' => '',
            'done_by' => '',
            'inserted_by' => '',
            'hours' => '',
            'worker_type' => '',
            'comments' => '',
            'status' => '',
            'ref_no' => '',
            'bank_date' => '',
            'bank_ref' => '',
            'supplier' => '',
            'transaction_details' => '',
            'invoice_no' => 'Total Running Balance',
            'invoice_amount' => '',
            'customer_variable' => '',
            'customer_credit' => $data->sum(fn($row) => (float) $row['customer_credit']),
            'customer_debit' => $data->sum(fn($row) => (float) $row['customer_debit']),
            'client_balance' => $data->sum(fn($row) => (float) $row['client_balance']),
            'receipt_link' => '',
        ];

        // Append totals row to the collection
        $data->push($totals);

        return $data;
    }


    public function headings(): array
    {
        return [
            'Boat',
            'Customer Company',
            'Owner',
            'Date Done',
            'Item',
            'Location',
            'Description / Action',
            'Done By',
            'Inserted By',
            'Hours',
            'Worker Type',
            'Comments',
            'Status',
            'Ref #',
            'Bank Date',
            'Bank Ref.',
            'Supplier',
            'Details',
            'Invoice #',
            'Invoice Amount',
            'Client Variable',
            'Client Credit',
            'Client Debit',
            'Client Balance',
            'Link to Receipt',
        ];
    }
}
