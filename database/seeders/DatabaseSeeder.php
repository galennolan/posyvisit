<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            // Membuat role
            $adminRole = Role::create(['name' => 'admin']);
            $petugasKesehatanRole = Role::create(['name' => 'PetugasKesehatan']);
            $ketuaPosyanduRole = Role::create(['name' => 'KetuaPosyandu']);
            $kaderRole = Role::create(['name' => 'Kader']);
    
            // Membuat pengguna admin
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@simponiku.com',
                'password' => bcrypt('password'), // Ganti dengan password yang diinginkan
                'kecamatan' => 'Banjarsari',
                'kelurahan' => 'Banjarsari',
                'nama_posyandu' => 'Posyandu A',
            ]);
            $admin->assignRole($adminRole);
    
            // Membuat pengguna PetugasKesehatan di 5 kecamatan dengan kelurahan dan posyandu null
                
            $kecamatanList = ['Banjarsari', 'Jebres', 'Laweyan', 'Pasar Kliwon', 'Serengan'];
    
            foreach ($kecamatanList as $kecamatan) {
                $petugasKesehatan = User::create([
                    'name' => 'Petugas Kesehatan ' . $kecamatan,
                    'email' => strtolower($kecamatan . '@simponiku.com'),
                    'password' => bcrypt('password'),
                    'kecamatan' => $kecamatan,
                    'kelurahan' => null,
                    'nama_posyandu' => null,
                ]);
                $petugasKesehatan->assignRole($petugasKesehatanRole);
            }
            // Membuat pengguna KetuaPosyandu
            $ketuaPosyandu = User::create([
                'name' => 'Ketua Posyandu',
                'email' => 'ketuaposyandu@simponiku.com',
                'password' => bcrypt('password'),
                'kecamatan' => 'Serengan',
                'kelurahan' => 'Serengan',
                'nama_posyandu' => 'Posyandu D',
            ]);
            $ketuaPosyandu->assignRole($ketuaPosyanduRole);
    
            // Membuat pengguna Kader
            $kader = User::create([
                'name' => 'Kader Posyandu',
                'email' => 'kader@simponiku.com',
                'password' => bcrypt('password'),
                'kecamatan' => 'Serengan',
                'kelurahan' => 'Serengan',
                'nama_posyandu' => 'Posyandu D',
            ]);
            $kader->assignRole($kaderRole);
        }
    
}
