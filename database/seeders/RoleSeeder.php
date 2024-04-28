<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => '1',
                'name' => 'admin',
            ],
            [
                'id' => '2',
                'name' => 'customer',
            ],
        ];

        Role::insert($roles);
    }
}
