<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'rate',
        'priority',
        'due_date',
        'image_path',
    ];
}
