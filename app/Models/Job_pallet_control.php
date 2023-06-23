<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_pallet_control extends Model
{
    use HasFactory;
    public function job(){
        return $this->belongsTo(Job::class,'job_id');
    }
    public function job_sender(){
        return $this->hasOne(Job_sender::class,'job_id');
    }
}
