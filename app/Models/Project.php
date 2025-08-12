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
        'delivered_at',
        'delivery_date',
        'admin_id',
        'created_by',
        'budget'
    ];


    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function project_task(){
        return $this->belongsTo(ProjectTask::class, 'id');
    }

    public function project_payment(){
        return $this->belongsTo(ProjectPayment::class, 'id');
    }

    public function project_feedback(){
        return $this->belongsTo(ProjectFeedback::class, 'id');
    }

    public function project_issue(){
        return $this->belongsTo(ProjectIssue::class, 'id');
    }
}
