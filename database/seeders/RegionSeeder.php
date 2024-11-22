<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['region' => 'REGIÓN I', 'sede' => 'TANTOYUCA', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN II', 'sede' => 'TUXPAN', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN III', 'sede' => 'POZA RICA', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN IV', 'sede' => 'MARTÍNEZ DE LA TORRE', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN V', 'sede' => 'XALAPA', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN VI', 'sede' => 'VERACRUZ', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN VII', 'sede' => 'CÓRDOBA', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN VIII', 'sede' => 'ORIZABA', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN IX', 'sede' => 'COSAMALOAPAN', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN X', 'sede' => 'SAN ANDRES TUXTLA', 'created_at' => now(), 'updated_at' => now()],
            ['region' => 'REGIÓN XI', 'sede' => 'MINATITLÁN', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
