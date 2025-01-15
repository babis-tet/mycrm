<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'web']);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@netwise.gr',
            'password' => bcrypt('netwise'),
        ]);

        $user->assignRole('Admin');
    }
}
