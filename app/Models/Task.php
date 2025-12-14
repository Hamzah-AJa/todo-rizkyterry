<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'status',
        'priority',
        'due_date',
        'notes',
    ];

    protected $casts = [
        'status'   => 'boolean',
        'due_date' => 'date',
    ];
}