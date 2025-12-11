<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'image' => 'https://randomuser.me/api/portraits/' . ($gender === 'male' ? 'men' : 'women') . '/' . $this->faker->numberBetween(1, 99) . '.jpg',
            'bio' => $this->faker->text(),
            'major_id' => Major::factory(),
        ];
    }
}
