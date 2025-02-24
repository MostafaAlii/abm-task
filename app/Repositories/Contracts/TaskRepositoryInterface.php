<?php
namespace App\Repositories\Contracts;
use App\Models\Task;
interface TaskRepositoryInterface {
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(Task $task, array $data); 
    public function delete(Task $task);
}