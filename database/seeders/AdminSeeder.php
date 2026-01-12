<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'username' => 'Super Admin',
                'email' => 'admin@v75pro.com',
                'password' => Hash::make('admin123'),
                'usdt_account' => null,
            ],
            [
                'username' => 'Admin Manager',
                'email' => 'manager@v75pro.com',
                'password' => Hash::make('manager123'),
                'usdt_account' => null,
            ],
            [
                'username' => 'Support Admin',
                'email' => 'support@v75pro.com',
                'password' => Hash::make('support123'),
                'usdt_account' => null,
            ],
        ];

        foreach ($admins as $adminData) {
            // Vérifier si l'admin existe déjà
            $existingAdmin = Admin::where('email', $adminData['email'])->first();
            
            if (!$existingAdmin) {
                Admin::create($adminData);
                $this->command->info("Admin créé : {$adminData['email']}");
            } else {
                $this->command->warn("Admin déjà existant : {$adminData['email']}");
            }
        }

        $this->command->info('Seeder des admins terminé !');
        $this->command->info('Comptes créés :');
        $this->command->info('1. admin@v75pro.com / admin123');
        $this->command->info('2. manager@v75pro.com / manager123');
        $this->command->info('3. support@v75pro.com / support123');
    }
}

