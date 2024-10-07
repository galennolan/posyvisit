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
        $petugasKesehatanRole = Role::create(['name' => 'PetugasKesehatan']);
        $ketuaPosyanduRole = Role::create(['name' => 'KetuaPosyandu']);
        $kaderRole = Role::create(['name' => 'Kader']);

        // Membuat pengguna admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@posyvisit.com',
            'password' => bcrypt('password'), // Ganti dengan password yang diinginkan
            'kecamatan' => 'Banjarsari',
            'kelurahan' => 'Banjarsari',
            'nama_posyandu' => 'Posyandu A',
        ]);
        $admin->assignRole($adminRole);

        // Membuat pengguna PetugasKesehatan
        $petugasKesehatan = User::create([
            'name' => 'Petugas Kesehatan',
            'email' => 'petugaskesehatan@posyvisit.com',
            'password' => bcrypt('password'),
            'kecamatan' => 'Laweyan',
            'kelurahan' => 'Purwosari',
            'nama_posyandu' => 'Posyandu C',
        ]);
        $petugasKesehatan->assignRole($petugasKesehatanRole);

        // Membuat pengguna KetuaPosyandu
        $ketuaPosyandu = User::create([
            'name' => 'Ketua Posyandu',
            'email' => 'ketuaposyandu@posyvisit.com',
            'password' => bcrypt('password'),
            'kecamatan' => 'Serengan',
            'kelurahan' => 'Serengan',
            'nama_posyandu' => 'Posyandu D',
        ]);
        $ketuaPosyandu->assignRole($ketuaPosyanduRole);

        // Membuat pengguna Kader
        $kader = User::create([
            'name' => 'Kader Posyandu',
            'email' => 'kader@posyvisit.com',
            'password' => bcrypt('password'),
            'kecamatan' => 'Serengan',
            'kelurahan' => 'Serengan',
            'nama_posyandu' => 'Posyandu D',
        ]);
        $kader->assignRole($kaderRole);
    }

}
