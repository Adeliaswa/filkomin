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