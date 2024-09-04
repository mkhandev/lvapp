<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Vistitor two User',
            'email' => 'visitor2@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Vistitor three User',
            'email' => 'visitor3@example.com',
        ]);

        \App\Models\Listing::factory(3)->create([
            'by_user_id' => 1
        ]);

        \App\Models\Listing::factory(3)->create([
            'by_user_id' => 2
        ]);

        \App\Models\Listing::factory(3)->create([
            'by_user_id' => 3
        ]);
    }
}
