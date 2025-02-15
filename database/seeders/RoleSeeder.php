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
        // أعمل الأدوار
            $admin = Role::firstOrCreate(['name' => 'Admin']);
            $pharmacist = Role::firstOrCreate(['name' => 'Pharmacist']);
            $cashier = Role::firstOrCreate(['name' => 'Cashier']);


        // أعمل الصلاحيات
        $permissions =[
            'manage user',
            'manage product',
            'view reports',
            'process sales',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        //  صلاحيات للادوار
        $admin->givePermissionTo('manage user');
        $pharmacist->givePermissionTo('manage product');
        $cashier->givePermissionTo('process sales');

    }
}
