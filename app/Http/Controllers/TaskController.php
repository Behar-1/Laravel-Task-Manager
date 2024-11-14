<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Task;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        try {
           $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            Task::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => $request->status ?? false,
                'priority' => $request->priority,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function edit(Task $task)
    {
        if($task->user_id != Auth::id()){
            return redirect()->route('tasks.index')->with('error', 'You dont have permission to edit this task.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if($task->user_id != Auth::id()){
            return redirect()->route('tasks.index')->with('error', 'You dont have permission to update this task.');
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $task->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => $request->status,
                'priority' => $request->priority,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function destroy(Task $task)
    {
        if($task->user_id != Auth::id()){
            return redirect()->route('tasks.index')->with('error', 'You dont have permission to delete this task.');
        }

        try {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
