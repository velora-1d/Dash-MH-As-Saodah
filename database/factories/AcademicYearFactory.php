<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entity_id' => \App\Models\Entity::factory(),
            'name' => '2023/2024',
            'is_active' => true,
            'start_date' => now()->startOfYear(),
            'end_date' => now()->endOfYear(),
        ];
    }
}
