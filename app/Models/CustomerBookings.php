<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBookings extends Model
{
    use HasFactory;

    protected $table = 'customer_bookings';

    // protected $fillable = [];

    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }
}
