<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Author']);
        $school_owner = Role::create(['name' => 'School Owner']);
        $teacher = Role::create(['name' => 'Teacher']);

        $school_owner->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user'
        ]);

        $teacher->givePermissionTo([
            'create-unit'
        ]);
    }
}
