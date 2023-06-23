<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    use HasFactory;
    protected $table = 'job_statuses';
    protected $fillable = ['job_status','status_color'];

    public function job(){
        return $this->hasMany(Job::class,'job_status');
    }
}
