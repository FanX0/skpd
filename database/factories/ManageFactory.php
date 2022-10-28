<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manage>
 */
class ManageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Male', 'Female']);
        return [
            'name'      =>  $this->faker->name,
            'email'     =>  $this->faker->unique()->safeEmail,
            'gender'    =>  $gender
        ];
    }
}
