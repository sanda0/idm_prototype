<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        try {
            $createdBy = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('0000'),
            ])->assignRole('Admin');
        } catch (\Exception $e) {
            // Handle exception if needed
        }

        try {
            $createdBy = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('0000'),
            ])->assignRole('Teacher');
        } catch (\Exception $e) {
            // Handle exception if needed
        }

        try {
            $createdBy = User::create([
            'name' => 'Academic Head User',
            'email' => 'academic_head@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('0000'),
            ])->assignRole('Academic Head');
        } catch (\Exception $e) {
            // Handle exception if needed
        }

        try {
            $createdBy = User::create([
            'name' => 'Student User',
            'email' => 'student@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('0000'),
            ])->assignRole('Student');
        } catch (\Exception $e) {
            // Handle exception if needed
        }
    }
}
