<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
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
            $teacher = User::create([
                'name' => 'Teacher User',
                'email' => 'teacher@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('0000'),
            ])->assignRole('Teacher');

            Teacher::create([
                'user_id' => $teacher->id,
                "name" => "Teacher User",
                "email" => "teacher@test.com",
                "phone" => "1234567890",
                "address" => "colombo, Sri Lanka",

            ]);

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
            $student = User::create([
                'name' => 'Student User',
                'email' => 'student@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('0000'),
            ])->assignRole('Student');

            Student::create([
                'user_id' => $student->id,
                "name" => "Student User",
                "email" => "student@test.com",
                "phone" => "1234567890",
                "address" => "colombo, Sri Lanka",
            ]);

        } catch (\Exception $e) {
            // Handle exception if needed
        }
    }
}
