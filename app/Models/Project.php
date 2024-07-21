<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'service_fee',
        'image_paths',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'image_paths' => 'array', // Cast image_paths to an array
    ];

}
