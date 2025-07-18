<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
