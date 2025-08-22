<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'note',
        'media',
        'created_by',
        'status'
    ];

    // public function project(){
    //     return $this->hasMany(Project::class);
    // }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
