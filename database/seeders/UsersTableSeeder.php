<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Role::truncate();
        User::truncate();

        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        $viewPostsPermission = Permission::create(['name' => 'View posts']);
        $createPostsPermission = Permission::create(['name' => 'Create posts']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts']);


        $admin = new User;
        $admin->name = 'Juan Carlos';
        $admin->email = 'jgutierrez@stocksillustrated.com.mx';
        $admin->password = bcrypt('AlphaJuliet2018?*');
        $admin->save();

        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = 'Alejandra Solvg';
        $writer->email = 'avasquez@stocksillustrated.com.mx';
        $writer->password = bcrypt('AlphaJuliet2018?*');
        $writer->save();

        $writer->assignRole($adminRole);

        $writert = new User;
        $writert->name = 'Escritor Prueba';
        $writert->email = 'escritor@stocksillustrated.com.mx';
        $writert->password = bcrypt('AlphaJuliet2018?*');
        $writert->save();

        $writert->assignRole($writerRole);

    }
}
