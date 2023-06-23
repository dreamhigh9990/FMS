<?php

namespace App\Models;

use App\Http\Controllers\Admin\ManifestController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    use HasFactory;
    protected $table = 'branches';
    protected $fillable = ['branches'];

    function from_price_detail(){
        return $this->hasMany(price_detail::class,'from_address');
    }

    function to_price_detail(){
        return $this->hasMany(price_detail::class,'to_address');
    }

    public function job(){
        return $this->hasMany(Job::class,'job_status');
    }

    public function from_manifest(){
        return $this->hasMany(Manifest::class,'dispatch_branch');
    }

    public function to_manifest(){
        return $this->hasMany(Manifest::class,'receiving_branch');
    }

    public function employees(){
        return $this->hasMany(Employee::class,'branch_id');
    }
}
