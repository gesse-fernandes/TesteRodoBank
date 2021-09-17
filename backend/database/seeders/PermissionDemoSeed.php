<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class PermissionDemoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'freight.list']);
        Permission::create(['name' => 'freight.create']);
        Permission::create(['name' => 'freight.update']);
        Permission::create(['name' => 'freight.destroy']);
        Permission::create(['name'=> 'freight.findByvehicle_owner']);
        Permission::create(['name'=>'freight.board']);
        Permission::create(['name'=>'freight.show']);
        Permission::create(['name' => 'users.list']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.findUser']);
        Permission::create(['name'=>'users.show']);
        $userRole = Role::create(['name' => 'admin']);
        $userRole->givePermissionTo('freight.list');
        $userRole->givePermissionTo('freight.create');
        $userRole->givePermissionTo('freight.update');
        $userRole->givePermissionTo('freight.destroy');
        $userRole->givePermissionTo('freight.findByvehicle_owner');
        $userRole->givePermissionTo('freight.show');
        $userRole->givePermissionTo('freight.board');
        $userRole->givePermissionTo('users.list');
        $userRole->givePermissionTo('users.destroy');
        $userRole->givePermissionTo('users.findUser');
        $userRole->givePermissionTo('users.update');
        $userRole->givePermissionTo('users.show');
        $userClient = Role::create(['name'=>'client']);
        $userClient->givePermissionTo('freight.board');
        $userClient->givePermissionTo('freight.show');
        $userClient->givePermissionTo('users.update');
        $userClient->givePermissionTo('users.show');
    }
}
