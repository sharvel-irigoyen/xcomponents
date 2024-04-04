<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Laptops y Notebooks',
            ],
            [
                'name' => 'Computadoras de Escritorio',
            ],
            [
                'name' => 'Tabletas y Convertibles',
            ],
            [
                'name' => 'Componentes de Computadora',
            ],
            [
                'name' => 'Periféricos',
            ],
            [
                'name' => 'Accesorios',
            ],
            [
                'name' => 'Software',
            ],
        ];

        Category::insert($categories);
    }
}
