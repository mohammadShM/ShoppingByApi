<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $roleAdminUser = Role::query()->where('title', 'super-admin')->first();
        User::query()->create([
            "name" => "Mohammad",
            "email" => "mohammad@gmail.com",
            "password" => bcrypt(123456),
            "role_id" => $roleAdminUser->id ?? 1,
        ]);
    }
}
