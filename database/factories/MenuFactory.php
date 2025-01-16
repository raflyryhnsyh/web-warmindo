<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Menu::class;

    // menentukan format data dummy
    public function definition(): array
    {
        return [
            'menu_name' => fake()->words(3, true), // Nama menu acak
            'price' => fake()->randomFloat(2, 10, 500), // Harga acak antara 10-500
            'description' => fake()->sentence(), // Deskripsi acak
            'id_category' => function (){
                return Categories::inRandomOrder()->first()->id_category;
            }
        ];
    }
}
