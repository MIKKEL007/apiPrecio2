<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PreciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('precio')->insert(
            [
                [
                    "tipo" => "f",
                    "nombre" => "cemento",
                    "precio" => 9.15
                ],
                [
                    "tipo" => "v",
                    "nombre" => "cemento",
                    "precio" => 9.15
                ],

                [
                    "tipo" => "f",
                    "nombre" => "ladrillo",
                    "precio" => 0.42
                ],
                [
                    "tipo" => "v",
                    "nombre" => "ladrillo",
                    "precio" => 0.00
                ],

                [
                    "tipo" => "f",
                    "nombre" => "bloque",
                    "precio" => 0.47
                ],
                [
                    "tipo" => "v",
                    "nombre" => "bloque",
                    "precio" => 0.00
                ],
                [
                    "tipo" => "f",
                    "nombre" => "acero",
                    "precio" => 12.47
                ],
                [
                    "tipo" => "v",
                    "nombre" => "acero",
                    "precio" => 12.00
                ],
                [
                    "tipo" => "f",
                    "nombre" => "encofrado",
                    "precio" => 15.50
                ],
                [
                    "tipo" => "v",
                    "nombre" => "encofrado",
                    "precio" => 25.50
                ],

            ]
        );
    }
}
