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

        // 3. Create Owner User
        $owner = User::create([
            'name' => 'Super Owner',
            'email' => 'owner@test.com',
            'username' => 'super_owner',
            'role' => 'owner',
            'phone' => '0811111111',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        // Assign Scope Owner
        UserScope::create([
            'user_id' => $owner->id,
            'entity_id' => $entity->id,
            'unit_id' => null, // Owner has access to all units
            'role' => 'owner'
        ]);

        // 4. Create Mitra User (Admin MI)
        $mitraMi = User::create([
            'name' => 'Admin MI',
            'email' => 'adminmi@test.com',
            'username' => 'admin_mi',
            'role' => 'mitra',
            'phone' => '0822222222',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        // Assign Scope Mitra
        UserScope::create([
            'user_id' => $mitraMi->id,
            'entity_id' => $entity->id,
            'unit_id' => $unitMI->id, // Mitra specific to MI
            'role' => 'mitra'
        ]);
    }
}