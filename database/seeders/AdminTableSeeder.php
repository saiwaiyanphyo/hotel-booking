<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::query()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('P@ssw0rd'),
        ]);
    }
}
