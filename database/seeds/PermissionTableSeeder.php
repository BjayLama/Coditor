<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'site-setting-list',
            'site-setting-edit',

            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
