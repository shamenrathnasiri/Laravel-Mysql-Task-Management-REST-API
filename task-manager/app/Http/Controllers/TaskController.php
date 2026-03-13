<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $tasks = $query->latest()->paginate(10)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'status'      => 'required|in:pending,in_progress,completed',
        ]);

        $validated['user_id'] = Auth::id();
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'status'      => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task moved to trash.');
    }

    public function trashed()
    {
        $tasks = Task::onlyTrashed()->where('user_id', Auth::id())->latest()->paginate(10);

        return view('tasks.trashed', compact('tasks'));
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->restore();

        return redirect()->route('tasks.trashed')->with('success', 'Task restored successfully.');
    }

    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->forceDelete();

        return redirect()->route('tasks.trashed')->with('success', 'Task permanently deleted.');
    }
}
