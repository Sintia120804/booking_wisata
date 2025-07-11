<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SintiaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SintiaCategory::insert([
            [
                'name' => 'Pantai',
                'description' => 'Wisata pantai dan laut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gunung',
                'description' => 'Wisata pegunungan dan pendakian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taman Hiburan',
                'description' => 'Wisata taman bermain dan hiburan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
