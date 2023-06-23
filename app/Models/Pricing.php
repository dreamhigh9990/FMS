<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $table ="prices";
    protected $fillable = [
        'title',
        'discount',
        'con_fee',
        'delivery_fee',
        'fuel_levy',
        'futile_pickup_fee',
        'pickup_fee'
    ];


    function price_detail(){
        return $this->hasMany(price_detail::class,'price_id');
            // ->with('to_branch')
            // ->with('from_branch')
            // ->with('price_items');
    }
}
