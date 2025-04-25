<?php

namespace Database\Seeders;

use App\Models\Categoris;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoris::insert([
            ['category_name' => 'makanan'],
            ['category_name' => 'minuman'],
            ['category_name' => 'non Alkohol'],

        ]);
    }
}
