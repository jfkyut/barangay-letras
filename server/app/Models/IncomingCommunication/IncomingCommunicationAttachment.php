<?php

namespace App\Models\IncomingCommunication;

use App\Models\AttachmentType;
use Illuminate\Database\Eloquent\Model;

class IncomingCommunicationAttachment extends Model
{
    protected $fillable = [
        'incoming_id',
        'file_path',
        'file_name',
        'type_id',
    ];

    public function type()
    {
        return $this->belongsTo(AttachmentType::class, 'type_id');
    }
}
