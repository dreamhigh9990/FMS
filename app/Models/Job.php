<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function job_items(){
        return $this->hasMany(Job_items::class,'job_id')->with('item');
    }

    public function job_load_restraints(){
        return $this->hasOne(Job_load_restraints::class,'job_id');
    }

    public function job_pallet_control(){
        return $this->hasOne(Job_pallet_control::class,'job_id');
    }

    public function job_receiver(){
        return $this->hasOne(Job_receiver::class,'job_id');
    }

    public function job_sender(){
        return $this->hasOne(Job_sender::class,'job_id');
    }

    public function job_total_price(){
        return $this->hasOne(Job_total_price::class,'job_id');
    }

    public function job_status_data(){
        return $this->belongsTo(JobStatus::class,'job_status');
    }

    public function job_receiver_branch(){
        return $this->belongsTo(Branches::class,'receiver_branch');
    }

    public function job_current_branch(){
        return $this->belongsTo(Branches::class,'current_branch');
    }

    public function job_sender_branch(){
        return $this->belongsTo(Branches::class,'sender_branch');
    }

    public function job_photos(){
        return $this->hasMany(Job_photos::class,'job_id');
    }

    public function job_notes(){
        return $this->hasMany(Job_notes::class,'job_id');
    }

    public function manifest(){
        return $this->belongsTo(Manifest::class,'manifest_id');
    }

    public function driver(){
        return $this->belongsTo(User::class,'assigned_driver');
    }
}
