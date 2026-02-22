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
        $entity = Entity::create([
            'name' => 'Yayasan Pendidikan MH As-Saodah',
            'type' => 'yayasan',
            'description' => 'Yayasan Pendidikan MH As-Saodah',
            'status' => 'active',
        ]);

        // 2. Create Units
        $unitSD = Unit::create([
            'entity_id' => $entity->id,
            'name' => 'SD',
        ]);

        $unitSMP = Unit::create([
            'entity_id' => $entity->id,
            'name' => 'SMP',
        ]);

        $unitSMA = Unit::create([
            'entity_id' => $entity->id,
            'name' => 'SMA',
        ]);

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

        // 4. Create Mitra User (Admin SMP)
        $mitraSmp = User::create([
            'name' => 'Admin SMP',
            'email' => 'adminsmp@test.com',
            'username' => 'admin_smp',
            'role' => 'mitra',
            'phone' => '0822222222',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        // Assign Scope Mitra
        UserScope::create([
            'user_id' => $mitraSmp->id,
            'entity_id' => $entity->id,
            'unit_id' => $unitSMP->id, // Mitra specific to SMP
            'role' => 'mitra'
        ]);

        // 5. Create Mitra User (Admin SD)
        $mitraSd = User::create([
            'name' => 'Admin SD',
            'email' => 'adminsd@test.com',
            'username' => 'admin_sd',
            'role' => 'mitra',
            'phone' => '0833333333',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        // Assign Scope Mitra
        UserScope::create([
            'user_id' => $mitraSd->id,
            'entity_id' => $entity->id,
            'unit_id' => $unitSD->id, // Mitra specific to SD
            'role' => 'mitra'
        ]);
    }
}