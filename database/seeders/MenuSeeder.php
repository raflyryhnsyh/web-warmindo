<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // membuat data dummy dari factory
    public function run(): void
    {
        Menu::factory()
                ->count(10)
                ->create();
    }
}
