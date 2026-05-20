<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        Equipo::create([
            'marca' => 'Lenovo',
            'modelo' => 'IdeaPad 5',
            'diagnostico' => 'Falla de placa madre / Error Kernel-Power 41. Pruebas de energía y swap de SSD realizados.',
            'estado' => 'En Taller'
        ]);

        Equipo::create([
            'marca' => 'HP',
            'modelo' => 'Pavilion',
            'diagnostico' => 'Mantenimiento preventivo.',
            'estado' => 'Operativo'
        ]);

        Equipo::create([
            'marca' => 'Asus',
            'modelo' => 'TUF Gaming',
            'diagnostico' => 'Fallo en controlador principal. Reparación de hardware requerida.',
            'estado' => 'Pendiente'
        ]);
    }
}