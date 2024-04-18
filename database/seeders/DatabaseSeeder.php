<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@inversionespijao.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');
    }
}