<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Manifest extends Model
{
    use HasFactory;
    protected $table = 'manifests';

    protected $fillable = [
        'driver',
        'manifest_no',
        'dispatch_branch',
        'receiving_branch',
        'type',
        'arrival_date'
    ];

    public function from_manifest(){
        return $this->belongsTo(Branches::class,'dispatch_branch');
    }

    public function to_manifest(){
        return $this->belongsTo(Branches::class,'receiving_branch');
    }

    public function jobs(){
        return $this->hasMany(Job::class,'manifest_id');
    }

    public function driver_name(){
        return $this->belongsTo(User::class,'driver');
    }

}
