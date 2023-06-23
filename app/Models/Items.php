<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = ['items', 'description'];

    public function dg_detail(){
        return $this->hasOne(job_item_dg_detail::class,'item_id');
    }

    public function item(){
        return $this->hasOne(Job_items::class,'item_type');
    }

    public function pricing(){
        return $this->belongsTo(price_detail::class,'item_type_id');
    }
}
