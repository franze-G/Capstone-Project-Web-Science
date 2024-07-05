<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks_table';

    protected $fillable = [
        'title',
        'description',
        'rate',
        'priority',
        'due_date',
        'image'
    ];
}
