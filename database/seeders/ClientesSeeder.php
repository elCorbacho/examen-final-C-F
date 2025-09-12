<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clientes;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [
            [
                'rut_empresa' => '76.123.456-7',
                'rubro' => 'Tecnología',
                'razon_social' => 'Tech Solutions SPA',
                'telefono' => '912345678',
                'direccion' => 'Av. Siempre Viva 123',
                'contacto_nombre' => 'Juan Pérez',
                'contacto_correo' => 'juan@techspa.cl',
            ],
            [
                'rut_empresa' => '77.234.567-8',
                'rubro' => 'Alimentos',
                'razon_social' => 'Alimentos del Sur Ltda',
                'telefono' => '922345678',
                'direccion' => 'Calle Falsa 456',
                'contacto_nombre' => 'María López',
                'contacto_correo' => 'maria@alimentosur.cl',
            ],
            [
                'rut_empresa' => '78.345.678-9',
                'rubro' => 'Construcción',
                'razon_social' => 'Constructora Andes S.A.',
                'telefono' => '932345678',
                'direccion' => 'Pasaje Central 789',
                'contacto_nombre' => 'Pedro González',
                'contacto_correo' => 'pedro@andesconstruccion.cl',
            ],
            [
                'rut_empresa' => '79.456.789-0',
                'rubro' => 'Educación',
                'razon_social' => 'Colegio Futuro',
                'telefono' => '942345678',
                'direccion' => 'Camino Real 101',
                'contacto_nombre' => 'Ana Torres',
                'contacto_correo' => 'ana@colegiofuturo.cl',
            ],
            [
                'rut_empresa' => '80.567.890-1',
                'rubro' => 'Salud',
                'razon_social' => 'Clínica Vida',
                'telefono' => '952345678',
                'direccion' => 'Av. Salud 202',
                'contacto_nombre' => 'Carlos Ruiz',
                'contacto_correo' => 'carlos@clinicavida.cl',
            ],
            [
                'rut_empresa' => '81.678.901-2',
                'rubro' => 'Transporte',
                'razon_social' => 'Transporte Express',
                'telefono' => '962345678',
                'direccion' => 'Ruta 5 Sur Km 15',
                'contacto_nombre' => 'Sofía Martínez',
                'contacto_correo' => 'sofia@transportexpress.cl',
            ],
            [
                'rut_empresa' => '82.789.012-3',
                'rubro' => 'Retail',
                'razon_social' => 'Comercial Centro',
                'telefono' => '972345678',
                'direccion' => 'Mall Central Local 12',
                'contacto_nombre' => 'Felipe Castro',
                'contacto_correo' => 'felipe@comercialcentro.cl',
            ],
            [
                'rut_empresa' => '83.890.123-4',
                'rubro' => 'Turismo',
                'razon_social' => 'Viajes y Turismo Ltda',
                'telefono' => '982345678',
                'direccion' => 'Plaza Principal 5',
                'contacto_nombre' => 'Laura Herrera',
                'contacto_correo' => 'laura@viajesturismo.cl',
            ],
            [
                'rut_empresa' => '84.901.234-5',
                'rubro' => 'Finanzas',
                'razon_social' => 'Finanzas Seguras SPA',
                'telefono' => '992345678',
                'direccion' => 'Edificio Financiero Piso 8',
                'contacto_nombre' => 'Diego Morales',
                'contacto_correo' => 'diego@finanzasseguras.cl',
            ],
            [
                'rut_empresa' => '85.012.345-6',
                'rubro' => 'Legal',
                'razon_social' => 'Estudio Jurídico Legal',
                'telefono' => '902345678',
                'direccion' => 'Calle Justicia 321',
                'contacto_nombre' => 'Valentina Rojas',
                'contacto_correo' => 'valentina@estudiolegal.cl',
            ],
        ];

        foreach ($clientes as $clienteData) {
            Clientes::create($clienteData);
        }
    }
}
