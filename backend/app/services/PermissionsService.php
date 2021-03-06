<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class PermissionsService
{

    public static function permissionsAdmin()
    {
        //buscando a funçao admin
        $adminRole = Role::findById(1);
        $adminRole = $adminRole['name'];
        return $adminRole;
    }

    public static function permissionsClient()
    {
        $client = Role::findById(2);
        $client = $client['name'];
        return $client;
    }
}
