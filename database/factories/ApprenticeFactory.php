<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apprentice>
 */
class ApprenticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();
        $startDate = fake()->date;
        return [
            'user_id' => $user->id,
            'candidate_number' => fake()->randomNumber(6, true),
            'start_date' => $startDate,
            'end_date' => fake()->dateTimeBetween($startDate, '+4 years')->format('Y-m-d'),
        ];
    }
}
