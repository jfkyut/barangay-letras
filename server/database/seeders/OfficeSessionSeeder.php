<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessionTypes = [
            'Regular',
            'Special',
            'Inaugural',
        ];

        foreach ($sessionTypes as $type) {
            \App\Models\OfficeSession\OfficeSessionType::create([
                'name' => $type,
            ]);
        }
    }
}
