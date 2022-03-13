<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'mohamed',
            'username'=>'Admin',
            'email' =>'mohamedn085@gmail.com',
            'password' => Hash::make(12345678),
            'role_id'=>1
        ]);

        DB::table('roles')->insert([
            'name' =>'Admin',
            'description' => 'Full Access'
        ]);

        DB::table('permissions')->insert([
            'role_id' => 1,
            'permissions' =>'{"categories":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"questions":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"pages":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"templates":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"users":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"permissions":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"roles":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"walls":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"},"system_links":{"can-add":"on","can-edit":"on","can-view":"on","can-delete":"on","can-list":"on","can-publish":"on"}}'
        ]);
    }
}
