<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil role
        $adminRole = Role::where('name', 'Admin')->first();
        $eoRole    = Role::where('name', 'User')->first(); // EO = User

        // ================= ADMIN =================
        if ($adminRole) {
            $admins = [
                ['name' => 'Phia', 'email' => 'admin@filkom.ac.id'],
                ['name' => 'Ael',  'email' => 'admin2@filkom.ac.id'],
                ['name' => 'Yupi', 'email' => 'admin3@filkom.ac.id'],
            ];

            foreach ($admins as $admin) {
                User::updateOrCreate(
                    ['email' => $admin['email']],
                    [
                        'name'     => $admin['name'],
                        'password' => Hash::make('password'),
                        'role_id'  => $adminRole->id,
                    ]
                );
            }
        }

        // ================= EO / USER =================
        if ($eoRole) {
            $eos = [
                'dosen',
                'dpm',
                'bem',
                'poros',
                'bcc',
                'kepanitiaan',
            ];

            foreach ($eos as $eo) {
                User::updateOrCreate(
                    ['email' => $eo . '@filkom.ac.id'],
                    [
                        'name'     => strtoupper($eo),
                        'password' => Hash::make('password'),
                        'role_id'  => $eoRole->id,
                        'type_eo'  => $eo,
                    ]
                );
            }
        }
    }
}
