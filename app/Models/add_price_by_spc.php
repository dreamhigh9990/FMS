<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class add_price_by_spc extends Model
{
    use HasFactory;

    protected $table = 'add_price_by_spc';

    protected $fillable = ['pricing_detail_id','row_no','spc_cost','spc_form','spc_to'];


    function price_detail(){
        return $this->belongsTo(price_detail::class,'pricing_detail_id');
    }
}
