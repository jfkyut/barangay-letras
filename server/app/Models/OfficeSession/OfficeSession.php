<?php

namespace App\Models\OfficeSession;

use App\Models\Council\Council;
use Illuminate\Database\Eloquent\Model;

class OfficeSession extends Model
{
    protected $fillable = [
        'council_id',
        'type_id',
        'year',
        'session_no',
        'date',
        'remarks',
    ];

    public function council()
    {
        return $this->belongsTo(Council::class);
    }

    public function type()
    {
        return $this->belongsTo(OfficeSessionType::class, 'type_id');
    }
}
