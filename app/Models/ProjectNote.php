<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProjectNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'note',
        'media'
    ];

    // public function project()
    // {
    //     return $this->hasMany(Project::class);
    // }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->created_by = Auth::id();
        });
    }
}
