<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        /*
        * Super Admin permissions =====================================================
        */
        /** @var Role $superAdmin */
        // DB::table('roles')->delete();
        $superAdmin = Role::query()->create([
            'title' => 'super-admin',
        ]);
        $superAdmin->permissions()->attach(Permission::all());
        /*
       * normal user permissions =====================================================
       */
        Role::query()->insert([
            'title' => 'normal-user',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }

}
