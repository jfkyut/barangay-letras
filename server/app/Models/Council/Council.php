<?php

namespace App\Models\Council;

use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    protected $fillable = [
        'number',
    ];

    public function officeSessions()
    {
        return $this->hasMany(\App\Models\OfficeSession\OfficeSession::class);
    }
}
