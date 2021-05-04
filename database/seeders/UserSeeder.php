<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'boss']);
        Role::create(['name' => 'ds']);


        $boss = User::create([
            'name' => 'Afifah',
            'email' => 'afifah@gmail.com',
            'password' => Hash::make('password')
        ]);

        $ds = User::create([
            'name' => 'Dropshipper01',
            'email' => 'dropshipper@gmail.com',
            'password' => Hash::make('password')
        ]);

        $boss->assignRole('boss');
        $ds->assignRole('ds');
    }
}
