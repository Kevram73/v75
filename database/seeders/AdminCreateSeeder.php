<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $first_admin = new Admin();
        $first_admin->username = "Admin One";
        $first_admin->email = "admin@admin.com";
        $first_admin->password = Hash::make('password');
        $first_admin->save();
    }
}
