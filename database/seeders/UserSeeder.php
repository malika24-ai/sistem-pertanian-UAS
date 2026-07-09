<?php

namespace Database\Seeders;

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
        $users = [
            [
                'name' => 'Tamus Tahir',
                'email' => 'tamus@gmail.com',
                'role' => 'Superadmin',
            ],
            [
                'name' => 'Joh Doe',
                'email' => 'admin@gmail.com',
                'role' => 'Admin',
            ],
            [
                'name' => 'Petani Satu',
                'email' => 'petani1@gmail.com',
                'role' => 'Petani',
            ],
            [
                'name' => 'Penyuluh Satu',
                'email' => 'penyuluh1@gmail.com',
                'role' => 'Penyuluh Pertanian',
            ],
            [
                'name' => 'Pembeli Satu',
                'email' => 'pembeli1@gmail.com',
                'role' => 'Pembeli',
            ],
        ];

        foreach ($users as $user) {
            if (User::where('email', $user['email'])->exists()) {
                continue;
            }

            $role = \App\Models\Role::where('name', $user['role'])->first();

            User::factory()->create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role_id' => $role->id ?? 1,
            ]);
        }
    }
}
