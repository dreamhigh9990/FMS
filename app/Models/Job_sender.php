<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_sender extends Model
{
    use HasFactory;

    protected $table = 'job_senders';

    protected $fillable = [
        'job_id ',
        'sender_name ',
        'sender_address_line_1 ',
        'sender_address_line_2 ',
        'suburb ',
        'postal_code ',
        'sender_state ',
        's_time ',
        'sender_contact ',
        's_phone ',
        'sender_branch ',
        'third_part_collection_charge ',
        'charge_collector_name ',
        'charge_collector_cost ',
        'ready_date ',
        'ready_time ',
        'pick_up_notes ',
    ];

    public function job(){
        return $this->belongsTo(Job::class,'job_id');
    }
}
