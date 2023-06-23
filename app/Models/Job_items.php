<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_items extends Model
{
    use HasFactory;

    public function job(){
        return $this->belongsTo(Job::class,'job_id')->with('job_current_branch')->with('job_receiver_branch')->with('job_sender_branch')->with('job_receiver');
    }

    public function item(){
        return $this->belongsTo(Items::class,'item_type');
    }

}
