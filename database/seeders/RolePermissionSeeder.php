<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'superAdmin'
        ]);

        // $userRole = Role::create([
        //     'name' => 'user'
        // ]);

        $fundraisersRole = Role::create([
            'name' => 'fundraisers'
        ]);

        $fundraiser = User::create([
            'name' => 'ilman',
            'email' => 'ilman@gmail.com',
            'password' => bcrypt('123123123')
        ]);

        $user =  User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'whatsapp' => '082214504645'
        ]);

        $fundraiser->assignRole($fundraisersRole);
        $user->assignRole($adminRole);

    }
}
