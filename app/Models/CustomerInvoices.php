<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInvoices extends Model
{
    use HasFactory;

    protected $table = 'customer_invoices';

    // protected $fillable = [];

    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }
}
