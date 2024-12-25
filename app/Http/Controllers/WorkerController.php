<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function YourTasks()
    {
        $user = auth()->user();
        $tasks = Task::where('done_by', $user->id)->get();
        return view('admin.tasks.index', compact('tasks'));
    }
}
