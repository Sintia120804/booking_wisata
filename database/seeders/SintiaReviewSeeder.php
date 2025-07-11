<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SintiaReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::pluck('id', 'email');
        $destinations = \App\Models\SintiaDestination::pluck('id', 'name');
        \App\Models\SintiaReview::insert([
            [
                'user_id' => $users['user@sintia.com'],
                'destination_id' => $destinations['Pantai Parangtritis'],
                'rating' => 5,
                'comment' => 'Pantainya indah dan bersih!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users['user@sintia.com'],
                'destination_id' => $destinations['Gunung Bromo'],
                'rating' => 4,
                'comment' => 'Pemandangan sunrise sangat bagus.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
