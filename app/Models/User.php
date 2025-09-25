<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'salary',
        'designation'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'admin_id');
    }

    public function projectNotes()
    {
        return $this->belongsTo(ProjectNote::class);
    }

    public function projectTasks()
    {
        return $this->hasMany(ProjectTask::class);
    }

    public function projectTaskUsers()
    {
        return $this->hasMany(ProjectTaskUser::class);
    }

    public function projectUser()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function isAdmin()
    {
        return $this->role === 'super admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
