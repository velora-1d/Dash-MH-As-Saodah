<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PpdbRegistration>
 */
class PpdbRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'academic_year_id' => \App\Models\AcademicYear::factory(),
            'registration_number' => 'REG-' . $this->faker->unique()->randomNumber(5),
            'student_name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['L', 'P']),
            'birth_date' => $this->faker->date(),
            'birth_place' => $this->faker->city,
            'nik' => $this->faker->numerify('################'),
            'no_kk' => $this->faker->numerify('################'),
            'parent_name' => $this->faker->name,
            'parent_phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'previous_school' => $this->faker->company,
            'status' => 'pending',
            'registered_at' => now(),
        ];
    }
}
