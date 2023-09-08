<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('proj ect@123'),
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'phone' => '9823446421',
            'country' => 'Nepal',
            'city' => 'City',
            'role' => 'Admin',
            'email_verified_at' => Carbon::now(),
        ]);

        $role = Role::create(['name' => 'super-admin']);
        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
