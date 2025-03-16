<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = auth()->user()?->tasks ?? [];

        return view('index', compact('tasks'));
    }

    public function create(): View
    {

        return view('tasks.create');
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        $tags = $task->tags()->get();
        $tagOptions = auth()->user()->tags()->whereNotIn('id', $tags->pluck('id'))->get() ?? [];
        
        return view('tasks.edit', compact('task', 'tags', 'tagOptions'));
    }

    public function store(CreateTaskRequest $request): RedirectResponse
    {
        Task::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->user()->id]
            )
        );

        flash('Task has been created');

        return redirect()->to(route('tasks.home'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        flash('Task has updated successfully');

        return redirect()->to(route('tasks.home'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        flash('Task has been deleted');


        return redirect()->to(route('tasks.home'));
    }

    public function complete(Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->complete = !$task->complete;
        $task->save();

        flash('Task has been marked as completed');

        return redirect()->to(route('tasks.home'));
    }

    public function addTags(Request $request, Task $task)
    {

        $task->tags()->attach($request->tags);

        flash('Tag(s) have been added to the task');


        return redirect()->to(route('tasks.edit', $task));
    }

    public function removeTag(Request $request, Task $task)
    {

        $task->tags()->detach($request->tag);

        flash('Tag has been removed from the task');

        return redirect()->to(route('tasks.edit', $task));
    }
}
