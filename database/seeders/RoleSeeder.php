<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'Admin']);


        $permission_create_product = Permission::create(['name' => 'crear producto']);
        $permission_read_product = Permission::create(['name' => 'ver producto']);
        $permission_update_product = Permission::create(['name' => 'editar producto']);
        $permission_delete_product = Permission::create(['name' => 'eliminar producto']);

        $permission_create_category = Permission::create(['name' => 'crear categorias']);
        $permission_read_category = Permission::create(['name' => 'ver categorias']);
        $permission_update_category = Permission::create(['name' => 'editar categorias']);
        $permission_delete_category = Permission::create(['name' => 'eliminar categorias']);

        $permission_create_cupon = Permission::create(['name' => 'crear cupon']);
        $permission_read_cupon = Permission::create(['name' => 'ver cupon']);
        $permission_update_cupon = Permission::create(['name' => 'editar cupon']);
        $permission_delete_cupon = Permission::create(['name' => 'eliminar cupon']);

        $permission_create_resenia = Permission::create(['name' => 'crear resenia']);
        $permission_read_resenia = Permission::create(['name' => 'ver resenia']);
        $permission_update_resenia = Permission::create(['name' => 'editar resenia']);
        $permission_delete_resenia = Permission::create(['name' => 'eliminar resenia']);

        $permissions_admin =
            [
                $permission_create_product, $permission_read_product, $permission_update_product, $permission_delete_product,
                $permission_create_category, $permission_read_category, $permission_update_category, $permission_delete_category,
                $permission_create_category, $permission_read_category, $permission_update_category, $permission_delete_category,
                $permission_create_cupon, $permission_read_cupon, $permission_update_cupon, $permission_delete_cupon,
                $permission_create_resenia, $permission_read_resenia, $permission_update_resenia, $permission_delete_resenia,
                ];

        $role_admin->syncPermissions($permissions_admin);
    }
}
