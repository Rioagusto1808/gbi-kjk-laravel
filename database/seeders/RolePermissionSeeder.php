<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definisikan permission dasar
        $permissions = [
            // Jemaat
            'view jemaat', 'create jemaat', 'edit jemaat', 'delete jemaat',
            // Ibadah
            'view ibadah', 'create ibadah', 'edit ibadah', 'delete ibadah', 'absen jemaat',
            // Event
            'view event', 'create event', 'edit event', 'delete event', 'daftar event',
            // Pelayanan
            'view pelayanan', 'create pelayanan', 'edit pelayanan', 'delete pelayanan',
            // Keuangan
            'view keuangan', 'create keuangan', 'edit keuangan', 'delete keuangan',
            // Berita
            'view berita', 'create berita', 'edit berita', 'delete berita',
            // Notifikasi
            'view notifikasi', 'create notifikasi', 'send notifikasi',
            // User Management
            'manage users', 'manage roles', 'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Role
        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $admin      = Role::firstOrCreate(['name' => 'admin']);
        $jemaat     = Role::firstOrCreate(['name' => 'jemaat']);

        // Assign permission ke role
        $superadmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'view jemaat', 'create jemaat', 'edit jemaat',
            'view ibadah', 'create ibadah', 'edit ibadah', 'absen jemaat',
            'view event', 'create event', 'edit event',
            'view pelayanan', 'create pelayanan', 'edit pelayanan',
            'view keuangan', 'create keuangan',
            'view berita', 'create berita',
            'view notifikasi', 'create notifikasi',
        ]);

        $jemaat->givePermissionTo([
            'view jemaat',
            'view ibadah',
            'daftar event',
            'view berita',
            'view notifikasi',
        ]);
    }
}

