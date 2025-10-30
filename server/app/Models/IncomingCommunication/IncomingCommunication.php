<?php

namespace App\Models\IncomingCommunication;

use Illuminate\Database\Eloquent\Model;

class IncomingCommunication extends Model
{
    protected $fillable = [
        'year',
        'month',
        'sequence_no',
        'reference_no',
        'classification',
        'sender',
        'subject',
        'date_received',
        'addressee',
        'required_action',
        'remarks',
    ];
}
