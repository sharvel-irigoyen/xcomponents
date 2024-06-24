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
                'id'   =>  1,
                'name' => 'Desktop & All-in-One Computers',
            ],
            [
                'id'   =>  2,
                'name' => 'Digital Cameras',
            ],
            [
                'id'   =>  3,
                'name' => 'Headphones',
            ],
            [
                'id'   =>  4,
                'name' => 'iPad, Tablets & E-Readers',
            ],
            [
                'id'   =>  5,
                'name' => 'Laptops',
            ],
            [
                'id'   =>  6,
                'name' => 'Portable & Wireless Speakers',
            ],
            [
                'id'   =>  7,
                'name' => 'TVs',
            ],
        ];

        Category::insert($categories);
    }
}
