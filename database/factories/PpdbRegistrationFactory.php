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
            'registration_number' => 'REG-' . \fake()->unique()->randomNumber(5),
            'student_name' => \fake()->name,
            'gender' => \fake()->randomElement(['L', 'P']),
            'birth_date' => \fake()->date(),
            'birth_place' => \fake()->city,
            'nik' => \fake()->numerify('################'),
            'no_kk' => \fake()->numerify('################'),
            'parent_name' => \fake()->name,
            'parent_phone' => \fake()->phoneNumber,
            'address' => \fake()->address,
            'previous_school' => \fake()->company,
            'status' => 'pending',
            'registered_at' => now(),

            // Dapodik Fields Dummy
            'family_status' => \fake()->randomElement(['Anak Kandung', 'Anak Tiri', 'Anak Angkat']),
            'sibling_count' => \fake()->numberBetween(0, 5),
            'child_position' => \fake()->numberBetween(1, 4),
            'religion' => \fake()->randomElement(['Islam', 'Kristen', 'Katolik']),
            'village' => \fake()->citySuffix,
            'district' => \fake()->city,
            'residence_type' => \fake()->randomElement(['Orang tua', 'Kerabat', 'Kos', 'Lainnya']),
            'transportation' => \fake()->randomElement(['Jalan kaki', 'Motor', 'Jemputan Sekolah', 'Kendaraan Umum']),
            'student_phone' => \fake()->phoneNumber,
            'height' => \fake()->numberBetween(110, 160),
            'weight' => \fake()->numberBetween(25, 60),
            'distance_to_school' => \fake()->numberBetween(1, 10) . ' km',
            'travel_time' => \fake()->numberBetween(5, 45),
            'father_name' => \fake()->name('male'),
            'father_birth_place' => \fake()->city,
            'father_birth_date' => \fake()->dateTimeBetween('-50 years', '-30 years')->format('Y-m-d'),
            'father_nik' => \fake()->numerify('320100##########'),
            'father_education' => \fake()->randomElement(['SMA/Sederajat', 'D3', 'S1']),
            'father_occupation' => \fake()->jobTitle,
            'mother_name' => \fake()->name('female'),
            'mother_birth_place' => \fake()->city,
            'mother_birth_date' => \fake()->dateTimeBetween('-45 years', '-28 years')->format('Y-m-d'),
            'mother_nik' => \fake()->numerify('320100##########'),
            'mother_education' => \fake()->randomElement(['SMA/Sederajat', 'D3', 'S1']),
            'mother_occupation' => \fake()->jobTitle,
            'parent_income' => \fake()->randomElement(['Kurang dari Rp 1.000.000', 'Rp 1.000.000 - Rp 1.999.999', 'Rp 2.000.000 - Rp 4.999.999', 'Lebih dari Rp 5.000.000']),
        ];
    }
}
