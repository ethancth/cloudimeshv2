<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $title=$this->faker->name();
        return [
            //

          'title' =>$title,
          'user_id'=> $this->faker->randomElement(['1']),
          'slug' => str::slug($title),
          'total_cpu' => $this->faker->randomElement(['2', '4','6']),
          'total_memory' => $this->faker->randomElement(['4', '8','12']),
          'total_storage' => $this->faker->randomElement(['100', '200','300'])
        ];
    }
}
