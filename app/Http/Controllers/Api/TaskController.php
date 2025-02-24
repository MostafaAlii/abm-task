<?php
namespace App\Http\Controllers\Api;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Models\Concerns\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\{Auth};
class TaskController extends Controller {
    use ApiResponseTrait;
    protected $taskRepository;
    public function __construct(TaskRepositoryInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function index() {
        $tasks = $this->taskRepository->all();
        return $this->successResponse(TaskResource::collection($tasks), 'Tasks retrieved successfully');
    }

    public function show($id) {
        $task = $this->taskRepository->find($id);
        return $this->successResponse(new TaskResource($task), 'Task retrieved successfully');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $task = $this->taskRepository->create($data);
        return $this->successResponse(new TaskResource($task), 'Task created successfully', 201);
    }

    public function update(Request $request, Task $task) {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $task = $this->taskRepository->update($task, $data);
        return $this->successResponse(new TaskResource($task), 'Task updated successfully');
    }

    public function destroy(Task $task) {
        $this->taskRepository->delete($task);
        return $this->successResponse(null, 'Task deleted successfully');
    }
}