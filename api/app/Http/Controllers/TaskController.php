<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TaskRequest;
use App\Repositories\TasksRepository;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TasksRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->taskRepository->list());
    }

    public function store(TaskRequest $request): JsonResponse
    {
        return response()->json($this->taskRepository->save($request));
    }

    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        return response()->json($this->taskRepository->update($request, $task));
    }

    public function destroy(Task $task): JsonResponse
    {
        return response()->json($this->taskRepository->delete($task));
    }
}
