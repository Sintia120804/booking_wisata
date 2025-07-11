<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SintiaDestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\SintiaCategory::pluck('id', 'name');
        \App\Models\SintiaDestination::insert([
            [
                'category_id' => $categories['Pantai'],
                'name' => 'Pantai Parangtritis',
                'location' => 'Yogyakarta',
                'description' => 'Pantai terkenal di Yogyakarta dengan pasir hitam dan ombak besar.',
                'price' => 25000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories['Gunung'],
                'name' => 'Gunung Bromo',
                'location' => 'Jawa Timur',
                'description' => 'Gunung berapi aktif dengan pemandangan matahari terbit yang indah.',
                'price' => 50000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories['Taman Hiburan'],
                'name' => 'Dufan',
                'location' => 'Jakarta',
                'description' => 'Taman hiburan terbesar di Indonesia.',
                'price' => 150000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
