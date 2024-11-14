<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
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
           $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'priority' => 'required|integer'
            ], [
                'title.required' => 'The task title is required.',
                'title.max' => 'The task title should not exceed 255 characters.',
                'description.required' => 'The task description is required.',
                'priority.required' => 'The task title is required.'
            ]);

            Tasks::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => $request->status ?? false,
                'priority' => $validated['priority'],
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Tasks $task)
    {
        if($task->user_id != Auth::id()){
            return redirect()->route('tasks.index')->with('error', 'You dont have permission to edit this task.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Tasks $task)
    {
        if($task->user_id != Auth::id()){
            return redirect()->route('tasks.index')->with('error', 'You dont have permission to update this task.');
        }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'priority' => 'required|integer'
            ], [
                'title.required' => 'The task title is required.',
                'title.max' => 'The task title should not exceed 255 characters.',
                'description.required' => 'The task description is required.',
                'priority.required' => 'The task title is required.',
            ]);

            $task->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => $request->status,
                'priority' => $validated['priority'],
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Tasks $task)
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
