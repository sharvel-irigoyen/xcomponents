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
                'name' => 'Desktop & All-in-One Computers',
            ],
            [
                'name' => 'Digital Cameras',
            ],
            [
                'name' => 'Headphones',
            ],
            [
                'name' => 'iPad, Tablets & E-Readers',
            ],
            [
                'name' => 'Laptops',
            ],
            [
                'name' => 'Portable & Wireless Speakers',
            ],
            [
                'name' => 'TVs',
            ],
        ];

        Category::insert($categories);
    }
}
