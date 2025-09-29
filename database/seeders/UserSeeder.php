<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'user' => Role::firstOrCreate(['name' => 'user']),
            'doctor' => Role::firstOrCreate(['name' => 'doctor']),
            'admin' => Role::firstOrCreate(['name' => 'admin']),
        ];

        User::factory()->count(10)->create(['role_id' => $roles['user']->id]);
        User::factory()->count(5)->create(['role_id' => $roles['doctor']->id]);
        User::factory()->count(2)->create(['role_id' => $roles['admin']->id]);
    }
}
