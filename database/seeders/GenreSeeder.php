<?php

namespace Database\Seeders;

use App\Models\Admin\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos = [
            ['genero'=>'HOMBRE', 'created_at' => now(), 'updated_at' => now()],
            ['genero'=>'MUJER', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($generos as $generoData) {
            Genre::create([
                'genero' => trim($generoData['genero']),
            ]);
        }
    }
}
