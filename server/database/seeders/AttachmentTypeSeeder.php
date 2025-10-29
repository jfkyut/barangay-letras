<?php

namespace Database\Seeders;

use App\Models\AttachmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfficeSession\OfficeSessionAttachmentType;

class AttachmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attachmentTypes = [
            'agenda',
            'minutes',
            'journal',
            'photo',
            'attendance',
            'audio',
        ];

        foreach ($attachmentTypes as $type) {
            AttachmentType::create([
                'name' => $type
            ]);
        }
    }
}
