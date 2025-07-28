<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('tasks', [
            'tasks' => Task::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            $task = Task::create($validatedData);
            return redirect()->route('tasks.index')->with('message', 'Task added.');
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), ['inputData' => $request->all()]);
            return redirect()->route('tasks.index')->with('error', 'Could not create task, please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            $task->update($validatedData);
            return redirect()->route('tasks.index')->with('message', 'Task updated.');
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), ['task_id' => $task->id, 'inputData' => $request->all()]);
            return redirect()->route('tasks.index')->with('error', 'Could not update task, please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(Task $task): RedirectResponse
     {
         try {
             $task->delete();
             return redirect()->route('tasks.index')->with('message', 'Task deleted.');
         } catch (Exception $exception) {
             Log::error($exception->getMessage(), ['task_id' => $task->id]);
             return redirect()->route('tasks.index')->with('error', 'Could not delete task, please try again.');
         }
     }
}
