<?php

namespace Database\Seeders;

use App\Models\CustomerCategory;
use App\Models\Source;
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

        //Roles
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'web']);

        //User
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@netwise.gr',
            'password' => bcrypt('netwise'),
        ]);
        $user->assignRole('Admin');


        //Customer Category
        CustomerCategory::create(['name' => 'A']);
        CustomerCategory::create(['name' => 'B']);
        CustomerCategory::create(['name' => 'C']);

        //Customer Category
        Source::create(['name' => 'Internet']);
        Source::create(['name' => 'Σύσταση']);
        Source::create(['name' => 'Διαφήμιση']);
    }
}
