<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
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
