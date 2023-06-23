<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class add_price_by_weight extends Model
{
    use HasFactory;

    protected $table = 'add_price_by_weight';

    protected $fillable = ['pricing_detail_id','row_no','w_from','w_to','w_cost'];

    function price_detail(){
        return $this->belongsTo(price_detail::class,'pricing_detail_id');
    }

}
