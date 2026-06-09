<?php

namespace Database\Seeders;

use App\Models\Personaje;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $personajes = [
            [
                'nombre' => 'Homer',
                'tipo' => 'Padre',
                'color_pelo' => 'Calvo',
                'trabajo' => 'Inspector de seguridad',
            ],
            [
                'nombre' => 'Marge',
                'tipo' => 'Madre',
                'color_pelo' => 'Azul',
                'trabajo' => 'Ama de casa',
            ],
            [
                'nombre' => 'Bart',
                'tipo' => 'Hijo',
                'color_pelo' => 'Rubio',
                'trabajo' => 'Estudiante',
            ],
            [
                'nombre' => 'Lisa',
                'tipo' => 'Hija',
                'color_pelo' => 'Rubio',
                'trabajo' => 'Estudiante',
            ],
            [
                'nombre' => 'Mr. Burns',
                'tipo' => 'Antagonista',
                'color_pelo' => 'Gris',
                'trabajo' => 'Dueño de la central nuclear',
            ],
            [
                'nombre' => 'Milhouse',
                'tipo' => 'Amigo',
                'color_pelo' => 'Azul',
                'trabajo' => 'Estudiante',
            ],
            [
                'nombre' => 'Maggie',
                'tipo' => 'Familia',
                'color_pelo' => 'Amarillo',
                'trabajo' => 'Bebe',
            ],
        ];

        foreach ($personajes as $personaje) {
            Personaje::updateOrCreate(
                ['nombre' => $personaje['nombre']],
                $personaje
            );
        }
    }
}
