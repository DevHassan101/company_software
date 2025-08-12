<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'note',
        'media',
        'created_by'
    ];


    public function project(){
        return $this->hasMany(Project::class);
    }
}
