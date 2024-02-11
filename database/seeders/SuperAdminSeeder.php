<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Sherif Author',
            'student_name' => 'Student1',
            'username' => 'sherif1',
            'email' => 'author@test.com',
            'role' => '0',
            'password' => Hash::make('123456')
        ]);
        $superAdmin->assignRole('Author');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Sherif Owner', 
            'student_name' => 'Student2',
            'username' => 'sherif2',
            'email' => 'owner@test.com',
            'role' => '1',
            'password' => Hash::make('123456')
        ]);
        $admin->assignRole('School Owner');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Sherif Teacher', 
            'student_name' => 'Student3',
            'username' => 'sherif3',
            'email' => 'teacher@test.com',
            'role' => '2',
            'password' => Hash::make('123456')
        ]);
        $productManager->assignRole('Teacher');
    }
}
