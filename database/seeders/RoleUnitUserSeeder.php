<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserScope;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUnitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Entity
        $entity = Entity::firstOrCreate(
            ['name' => 'MI As-Saodah'],
            [
                'type' => 'sekolah',
                'description' => 'Madrasah Ibtidaiyah As-Saodah',
                'status' => 'active',
            ]
        );

        // 2. Create Unit MI
        $unitMI = Unit::firstOrCreate(
            ['entity_id' => $entity->id, 'name' => 'MI As-Saodah']
        );

        // Users creation moved to DatabaseSeeder (if any).
    }
}