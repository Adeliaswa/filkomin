<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
<<<<<<< HEAD
    public function run()
    {
        // ================= ADMIN =================
        User::create([
            'name' => 'Phia',
            'email' => 'amdmin@filkom.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Ael',
            'email' => 'admin2@filkom.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Yupi',
            'email' => 'admin3@filkom.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // ================= EO =================
        $eos = [
            'dosen',
            'dpm',
            'bem',
            'poros',
            'bcc',
            'kepanitiaan',
        ];

        foreach ($eos as $eo) {
            User::create([
                'name' => strtoupper($eo),
                'email' => $eo . '@filkom.ac.id',
                'password' => Hash::make('password'),
                'role' => 'eo',
                'type_eo' => $eo,
            ]);
        }
    }
}
=======
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $eoRole = Role::where('name', 'EO')->first(); // Pastikan role EO sudah ada di tabel roles

        // Seed Admin
        if ($adminRole) {
            User::updateOrCreate(
                ['email' => 'admin@filkom.ac.id'],
                [
                    'role_id' => $adminRole->id,
                    'name' => 'Administrator Filkom',
                    'password' => Hash::make('password'),
                ]
            );
        }

        // Seed EO (Akun yang kamu minta)
        if ($eoRole) {
            User::updateOrCreate(
                ['email' => 'eo@filkom.ac.id'],
                [
                    'role_id' => $eoRole->id,
                    'name' => 'Event Organizer FILKOM',
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
>>>>>>> origin/feature/p3-dashboardeo
