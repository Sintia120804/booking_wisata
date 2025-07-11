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
        // User dummy
        User::insert([
            [
                'name' => 'Sintia Admin',
                'email' => 'admin@sintia.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sintia User',
                'email' => 'user@sintia.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        $this->call([
            \Database\Seeders\SintiaCategorySeeder::class,
            \Database\Seeders\SintiaDestinationSeeder::class,
            \Database\Seeders\SintiaBookingSeeder::class,
            \Database\Seeders\SintiaReviewSeeder::class,
        ]);
    }
}
