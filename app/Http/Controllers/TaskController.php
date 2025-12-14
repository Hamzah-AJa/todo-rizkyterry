<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('status')->orderBy('due_date')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'nullable|date',
        'notes'    => 'nullable|string',
    ]);

    Task::create([
        'name'     => $request->name,
        'priority' => $request->priority,
        'due_date' => $request->due_date,
        'status'   => false,
        'notes'    => $request->notes,  // <- simpan catatan
    ]);

    return redirect()->route('tasks.index')
        ->with('success', 'Tugas berhasil ditambahkan.');
}

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'nullable|date',
        'status'   => 'required|boolean',
        'notes'    => 'nullable|string',
    ]);

    $task->update([
        'name'     => $request->name,
        'priority' => $request->priority,
        'due_date' => $request->due_date,
        'status'   => $request->status,
        'notes'    => $request->notes,  // <- update catatan
    ]);

    return redirect()->route('tasks.index')
        ->with('success', 'Tugas berhasil diperbarui.');
}


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }

    public function toggleStatus(Task $task)
    {
        $task->status = ! $task->status;
        $task->save();

        return redirect()->route('tasks.index');
    }
}

