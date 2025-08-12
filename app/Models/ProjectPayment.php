<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'amount',
        'note',
        'media',
        'created_by'
    ];

    public function project(){
        return $this->hasMany(Project::class);
    }
}
