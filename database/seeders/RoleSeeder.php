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
                'name' => 'Superadmin',
                'description' => 'Super Administrator dengan akses penuh',
            ],
            [
                'name' => 'Admin',
                'description' => 'Administrator aplikasi',
            ],
            [
                'name' => 'Petani',
                'description' => 'Pengguna yang mengelola lahan dan tanaman',
            ],
            [
                'name' => 'Penyuluh Pertanian',
                'description' => 'Pengawas dan penyuluh aktivitas pertanian',
            ],
            [
                'name' => 'Pembeli',
                'description' => 'Pembeli hasil panen',
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
