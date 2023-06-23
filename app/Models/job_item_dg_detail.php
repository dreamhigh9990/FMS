<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_item_dg_detail extends Model
{
    use HasFactory;

    public function item(){
        return $this->belongsTo(Job_items::class,'item_id');
    }
}
