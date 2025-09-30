<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'requirments',
        'client_id',
        'started_at',
        'delivered_at' => 'datetime',
        'delivery_date',
        'admin_id',
        'created_by',
        'budget',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function projectTask()
    {
        return $this->belongsTo(ProjectTask::class, 'id');
    }

    public function projectPayments()
    {
        return $this->hasMany(ProjectPayment::class, 'project_id');
    }

    public function projectFeedback()
    {
        return $this->belongsTo(ProjectFeedback::class, 'id');
    }

    public function projectIssue()
    {

        return $this->belongsTo(ProjectIssue::class, 'id');
    }

    public function getPaidAmountAttribute()
    {
        return $this->projectPayments()->sum('amount');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectUsers()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function projectTaskUsers()
    {
        return $this->hasMany(ProjectTaskUser::class);
    }


    public function tasks()
    {
        return $this->hasMany(ProjectTask::class, 'project_id');
    }
}
