<?php
namespace App\Services;
use App\DTOs\TaskDTO;
use App\Models\Task;

class TaskService {
    public function all() {
        return Task::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->get();
    }

    public function find($id) {
        return Task::findOrFail($id);
    }

    public function create(TaskDTO $taskDTO) {
        return Task::create([
            'title' => $taskDTO->title,
            'status' => $taskDTO->status,
            'user_id' => $taskDTO->user_id,
        ]);
    }

    public function update(Task $task, TaskDTO $taskDTO) {
        $task->update([
            'title' => $taskDTO->title,
            'status' => $taskDTO->status,
            'user_id' => $taskDTO->user_id,
        ]);
        return $task;
    }

    public function delete(Task $task) {
        $task->delete();
        return $task;
    }
}