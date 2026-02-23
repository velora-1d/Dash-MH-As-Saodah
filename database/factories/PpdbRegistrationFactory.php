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

            // Dapodik Fields Dummy
            'family_status' => $this->faker->randomElement(['Anak Kandung', 'Anak Tiri', 'Anak Angkat']),
            'sibling_count' => $this->faker->numberBetween(0, 5),
            'child_position' => $this->faker->numberBetween(1, 4),
            'religion' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik']),
            'village' => $this->faker->citySuffix,
            'district' => $this->faker->city,
            'residence_type' => $this->faker->randomElement(['Orang tua', 'Kerabat', 'Kos', 'Lainnya']),
            'transportation' => $this->faker->randomElement(['Jalan kaki', 'Motor', 'Jemputan Sekolah', 'Kendaraan Umum']),
            'student_phone' => $this->faker->phoneNumber,
            'height' => $this->faker->numberBetween(110, 160),
            'weight' => $this->faker->numberBetween(25, 60),
            'distance_to_school' => $this->faker->numberBetween(1, 10) . ' km',
            'travel_time' => $this->faker->numberBetween(5, 45),
            'father_name' => $this->faker->name('male'),
            'father_birth_place' => $this->faker->city,
            'father_birth_date' => $this->faker->dateTimeBetween('-50 years', '-30 years')->format('Y-m-d'),
            'father_nik' => $this->faker->numerify('320100##########'),
            'father_education' => $this->faker->randomElement(['SMA/Sederajat', 'D3', 'S1']),
            'father_occupation' => $this->faker->jobTitle,
            'mother_name' => $this->faker->name('female'),
            'mother_birth_place' => $this->faker->city,
            'mother_birth_date' => $this->faker->dateTimeBetween('-45 years', '-28 years')->format('Y-m-d'),
            'mother_nik' => $this->faker->numerify('320100##########'),
            'mother_education' => $this->faker->randomElement(['SMA/Sederajat', 'D3', 'S1']),
            'mother_occupation' => $this->faker->jobTitle,
            'parent_income' => $this->faker->randomElement(['Kurang dari Rp 1.000.000', 'Rp 1.000.000 - Rp 1.999.999', 'Rp 2.000.000 - Rp 4.999.999', 'Lebih dari Rp 5.000.000']),
        ];
    }
}
