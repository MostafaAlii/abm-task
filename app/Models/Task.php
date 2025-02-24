<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;
class Task extends Model {
    protected $table = "tasks";

    protected $fillable = [
        'title',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
