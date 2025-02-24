<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class TaskResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'user' => [
                'id' => $this->user->id, 
                'name' => $this->user->name,
            ],
        ];
    }
}
