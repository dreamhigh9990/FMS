<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_total_price extends Model
{
    use HasFactory;

    protected $table = 'job_total_prices';

    protected $fillable = [
        'job_id',
        'job_total_price',
        'job_handling_fee',
        'job_unload_fee',
        'job_pick_up_fee',
        'job_delivery_fee',
    ];

    public function job(){
        return $this->belongsTo(Job::class,'job_id');
    }
}
