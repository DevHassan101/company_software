<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fname',
        'dob',
        'gender',
        'profile',
        'cnic',
        'phone',
        'address',
        'cnic_frnt',
        'cnic_back'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } 
}
