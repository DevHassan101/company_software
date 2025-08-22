<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->created_by = Auth::id();
        });
    }
}
