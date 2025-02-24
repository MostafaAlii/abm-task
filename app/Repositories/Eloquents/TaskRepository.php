<?php

namespace App\Repositories\Eloquents;
use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\DTOs\TaskDTO;
class TaskRepository implements TaskRepositoryInterface {
    protected $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    public function all() {
        return $this->taskService->all();
    }

    public function find($id) {
        return $this->taskService->find($id);
    }

    public function create(array $data) {
        $taskDTO = new TaskDTO(
            $data['title'],
            $data['status'],
            $data['user_id']
        );
        return $this->taskService->create($taskDTO);
    }

    public function update(Task $task, array $data) {
        $taskDTO = new TaskDTO(
            $data['title'],
            $data['status'],
            $data['user_id']
        );
        return $this->taskService->update($task, $taskDTO);
    }

    public function delete(Task $task) {
        return $this->taskService->delete($task);
    }
}