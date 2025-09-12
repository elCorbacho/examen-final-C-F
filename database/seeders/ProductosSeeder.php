<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productos;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'sku' => 'SKU001',
                'nombre' => 'Producto 1',
                'descripcion_corta' => 'Desc corta 1',
                'descripcion_larga' => 'Descripción larga del producto 1',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 1000,
                'precio_con_iva' => 1190,
                'stock_actual' => 50,
                'stock_minimo' => 10,
                'stock_bajo' => 5,
                'stock_alto' => 100,
            ],
            [
                'sku' => 'SKU002',
                'nombre' => 'Producto 2',
                'descripcion_corta' => 'Desc corta 2',
                'descripcion_larga' => 'Descripción larga del producto 2',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 2000,
                'precio_con_iva' => 2380,
                'stock_actual' => 30,
                'stock_minimo' => 8,
                'stock_bajo' => 3,
                'stock_alto' => 80,
            ],
            [
                'sku' => 'SKU003',
                'nombre' => 'Producto 3',
                'descripcion_corta' => 'Desc corta 3',
                'descripcion_larga' => 'Descripción larga del producto 3',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 1500,
                'precio_con_iva' => 1785,
                'stock_actual' => 20,
                'stock_minimo' => 5,
                'stock_bajo' => 2,
                'stock_alto' => 50,
            ],
            [
                'sku' => 'SKU004',
                'nombre' => 'Producto 4',
                'descripcion_corta' => 'Desc corta 4',
                'descripcion_larga' => 'Descripción larga del producto 4',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 500,
                'precio_con_iva' => 595,
                'stock_actual' => 60,
                'stock_minimo' => 12,
                'stock_bajo' => 6,
                'stock_alto' => 120,
            ],
            [
                'sku' => 'SKU005',
                'nombre' => 'Producto 5',
                'descripcion_corta' => 'Desc corta 5',
                'descripcion_larga' => 'Descripción larga del producto 5',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 3000,
                'precio_con_iva' => 3570,
                'stock_actual' => 15,
                'stock_minimo' => 4,
                'stock_bajo' => 2,
                'stock_alto' => 40,
            ],
            [
                'sku' => 'SKU006',
                'nombre' => 'Producto 6',
                'descripcion_corta' => 'Desc corta 6',
                'descripcion_larga' => 'Descripción larga del producto 6',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 1200,
                'precio_con_iva' => 1428,
                'stock_actual' => 25,
                'stock_minimo' => 6,
                'stock_bajo' => 3,
                'stock_alto' => 60,
            ],
            [
                'sku' => 'SKU007',
                'nombre' => 'Producto 7',
                'descripcion_corta' => 'Desc corta 7',
                'descripcion_larga' => 'Descripción larga del producto 7',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 800,
                'precio_con_iva' => 952,
                'stock_actual' => 40,
                'stock_minimo' => 9,
                'stock_bajo' => 4,
                'stock_alto' => 90,
            ],
            [
                'sku' => 'SKU008',
                'nombre' => 'Producto 8',
                'descripcion_corta' => 'Desc corta 8',
                'descripcion_larga' => 'Descripción larga del producto 8',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 2500,
                'precio_con_iva' => 2975,
                'stock_actual' => 35,
                'stock_minimo' => 7,
                'stock_bajo' => 3,
                'stock_alto' => 70,
            ],
            [
                'sku' => 'SKU009',
                'nombre' => 'Producto 9',
                'descripcion_corta' => 'Desc corta 9',
                'descripcion_larga' => 'Descripción larga del producto 9',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 1800,
                'precio_con_iva' => 2142,
                'stock_actual' => 10,
                'stock_minimo' => 2,
                'stock_bajo' => 1,
                'stock_alto' => 20,
            ],
            [
                'sku' => 'SKU010',
                'nombre' => 'Producto 10',
                'descripcion_corta' => 'Desc corta 10',
                'descripcion_larga' => 'Descripción larga del producto 10',
                'imagen_url' => 'https://via.placeholder.com/150',
                'precio_neto' => 4000,
                'precio_con_iva' => 4760,
                'stock_actual' => 12,
                'stock_minimo' => 3,
                'stock_bajo' => 1,
                'stock_alto' => 30,
            ],
        ];

        foreach ($productos as $producto) {
            Productos::create($producto);
        }
    }
}
