<?php
namespace App\DTOs;
class TaskDTO {
    public function __construct(public $title, public $status, public $user_id) {
        $this->title = $title;
        $this->status = $status;
        $this->user_id = $user_id;
    }
}