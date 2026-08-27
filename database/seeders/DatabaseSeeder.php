<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@logicsgrid.com'],
            [
                'name' => 'LogicsGrid Admin',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'designation' => 'Administrator',
                'status' => User::STATUS_ACTIVE,
            ]
        );

        $this->call(ContentSeeder::class);
        $this->call(CrmSeeder::class);
    }
}
