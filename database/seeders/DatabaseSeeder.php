<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            // Ajouter d'autres seeders ici si nécessaire
            // PlanSeeder::class,
            // ClientSeeder::class,
        ]);
    }
}
