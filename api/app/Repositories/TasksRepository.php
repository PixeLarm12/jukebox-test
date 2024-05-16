<?php

namespace App\Repositories;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TasksRepository
{
    public function list(): Collection
    {
        return Task::getAllTasks();
    }

    public function getTask(Task $model): Task
    {
        return Task::find($model->id);
    }

    public function save(TaskRequest $request): Task
    {
        if($request->validated()) {
            return Task::create($request->getData());
        }
    }

    public function update(TaskRequest $request, Task $model): bool
    {
        if($request->validated()) {
            return $model->update($request->getData());
        }
    }

    public function delete(Task $model): bool
    {
        return $model->delete();
    }
}
