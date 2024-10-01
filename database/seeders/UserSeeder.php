<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Membuat role
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Membuat pengguna admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@posyvisit.com',
            'password' => bcrypt('password'), // Ganti dengan password yang diinginkan
            'kecamatan' => 'Banjarsari',
            'kelurahan' => 'Banjarsari',
            'nama_posyandu' => 'Posyandu A', // Ganti dengan data yang sesuai
        ]);
        $admin->assignRole($adminRole);

        // Membuat pengguna reguler
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@posyvisit.com',
            'password' => bcrypt('password'),
            'kecamatan' => 'Jebres',
            'kelurahan' => 'Kadipiro',
            'nama_posyandu' => 'Posyandu B', // Ganti dengan data yang sesuai
        ]);
        $user->assignRole($userRole);
    }
}
