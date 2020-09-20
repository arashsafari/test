<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultValue extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([[
            'name' => 'users',
            'label' => 'users access',
        ],[
            'name' => 'products',
            'label' => 'products access',
        ]]);

        DB::table('roles')->insert([[
            'name' => 'admin',
            'label' => 'admin user',
        ],[
            'name' => 'seller',
            'label' => 'seller user',
        ],[
            'name' => 'customer',
            'label' => 'customer user',
        ]]);
        DB::table('permission_role')->insert([[
            'role_id' => '1',
            'permission_id' => '1',
        ],[
            'role_id' => '1',
            'permission_id' => '2',
        ],[
            'role_id' => '2',
            'permission_id' => '2',
        ]]);
        DB::table('users')->insert([[
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'level' => 'admin',
        ]]);
        DB::table('role_user')->insert([[
            'role_id' => '1',
            'user_id' => '1',
        ]]);
    }
}
