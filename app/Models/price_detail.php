<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class price_detail extends Model
{
    use HasFactory;

    protected $table = 'price_detail';

    protected $fillable = ['price_id','row_no','item_type_id','from_address','to_address','discount_for_item','reversal_pricing','price_by_weight','price_by_spc'];

    function to_branch(){
        return $this->belongsTo(Branches::class,'to_address');
    }

    function from_branch(){
        return $this->belongsTo(Branches::class,'from_address');
    }

    // function add_price_by_spc(){
    //     return $this->hasMany(add_price_by_spc::class,'pricing_detail_id');
    // }

    // function add_price_by_weight(){
    //     return $this->hasMany(add_price_by_weight::class,'pricing_detail_id');
    // }

    function price_items(){
        return $this->belongsTo(Items::class,'item_type_id');
    }
}
