<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SintiaBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::pluck('id', 'email');
        $destinations = \App\Models\SintiaDestination::pluck('id', 'name');
        \App\Models\SintiaBooking::insert([
            [
                'user_id' => $users['user@sintia.com'],
                'destination_id' => $destinations['Pantai Parangtritis'],
                'booking_date' => now()->subDays(2),
                'total_person' => 3,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users['user@sintia.com'],
                'destination_id' => $destinations['Gunung Bromo'],
                'booking_date' => now()->subDays(1),
                'total_person' => 2,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
