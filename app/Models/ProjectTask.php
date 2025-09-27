<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'admin_id',
        'user_id',
        'title',
        'description',
        'status',
        'created_by'
    ];

    public function projectTaskUsers()
    {
        return $this->hasMany(ProjectTaskUser::class, 'task_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function assign()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    // public function user()
    // {
    //     return $this->belongsTo(User::class, '');
    // }
}
