<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\PermissionsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'john',
            'surname'=>'doe',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password')
        ]);
        $role = PermissionsService::permissionsAdmin();
        $user->assignRole($role);
    }
}
