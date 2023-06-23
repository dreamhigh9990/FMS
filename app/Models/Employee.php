<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;

    Protected $table = 'employees';

    protected $fillables = [
        'first_name',
        'last_name',
        'mobile',
        'branch',
        'employee_id',
        'can_login',
        'can_use_app',
        'new_password',
        'new_pin'
    ];

    public function branch(){
        return $this->belongsTo(Branches::class,'branch_id');
    }
}
