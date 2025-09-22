<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'receipt',
        'description',
        'paid_for',
        'added_by',
        'user_id',
        'type',
        'paid_on'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'added_by');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }   

}
