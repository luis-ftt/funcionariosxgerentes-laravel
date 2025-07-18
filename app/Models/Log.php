<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs_users';
    protected $fillable = [
        'user_id',
        'task_id',
        'title',
        'status',
        'status_novo',
        'action',
        'priority',
        'title',
        'due_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
}
