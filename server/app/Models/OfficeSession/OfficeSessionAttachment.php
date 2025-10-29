<?php

namespace App\Models\OfficeSession;

use App\Models\AttachmentType;
use Illuminate\Database\Eloquent\Model;

class OfficeSessionAttachment extends Model
{
    protected $fillable = [
        'file_name',
        'file_path',
        'type_id',
        'session_id'
    ];

    public function type()
    {
        return $this->belongsTo(AttachmentType::class, 'type_id');
    }
}
