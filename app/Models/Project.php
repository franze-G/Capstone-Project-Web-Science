<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'service_fee',
        'image_paths',
        'status',
        'created_by',
        'user_firstname',
        'user_lastname',
        'assigned_id',
        'assigned_firstname',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'image_paths' => 'array', // Cast image_paths to an array
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

}
