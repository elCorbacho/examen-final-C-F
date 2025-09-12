<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuarios;

use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        $usuario = [
            [
                'rut' => '12345678-9',
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'email' => 'juan.perez@ventasfix.cl',
                'password' => Hash::make('12345678'),
            ],
            [
                'rut' => '98765432-1',
                'nombre' => 'Ana',
                'apellido' => 'Torres',
                'email' => 'ana.torres@ventasfix.cl',
                'password' => Hash::make('87654321'),
            ],
            [
                'rut' => '11222333-4',
                'nombre' => 'Carlos',
                'apellido' => 'Paredes',
                'email' => 'carlos.paredes@ventasfix.cl',
                'password' => Hash::make('11223344'),
            ],
            [
                'rut' => '55667788-5',
                'nombre' => 'Lucía',
                'apellido' => 'Gómez',
                'email' => 'lucia.gomez@ventasfix.cl',
                'password' => Hash::make('55667788'),
            ],
            [
                'rut' => '22334455-6',
                'nombre' => 'Miguel',
                'apellido' => 'Rojas',
                'email' => 'miguel.rojas@ventasfix.cl',
                'password' => Hash::make('22334455'),
            ],
            [
                'rut' => '33445566-7',
                'nombre' => 'Sofía',
                'apellido' => 'Ramírez',
                'email' => 'sofia.ramirez@ventasfix.cl',
                'password' => Hash::make('33445566'),
            ],
            [
                'rut' => '44556677-8',
                'nombre' => 'Pedro',
                'apellido' => 'Castillo',
                'email' => 'pedro.castillo@ventasfix.cl',
                'password' => Hash::make('44556677'),
            ],
            [
                'rut' => '55667788-9',
                'nombre' => 'María',
                'apellido' => 'López',
                'email' => 'maria.lopez@ventasfix.cl',
                'password' => Hash::make('55667788'),
            ],
            [
                'rut' => '66778899-0',
                'nombre' => 'Juan',
                'apellido' => 'Martínez',
                'email' => 'juan.martinez@ventasfix.cl',
                'password' => Hash::make('66778899'),
            ],
            [
                'rut' => '77889900-1',
                'nombre' => 'Valeria',
                'apellido' => 'Díaz',
                'email' => 'valeria.diaz@ventasfix.cl',
                'password' => Hash::make('77889900'),
            ],
        ];

        foreach ($usuario as $key => $value) {
            Usuarios::create($value);
        }
    }
}
