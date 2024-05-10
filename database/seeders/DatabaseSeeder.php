<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'nama' => 'Admin User',
            'nip' => '1234567890',
            'jabatan' => 'Administrator',
            'alamat' => '123 Admin Street',
            'no_tlp' => '987-654-3210',
            'nama_gambar' => 'admin.jpg',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'), // You can use bcrypt() to hash the password
        ]);
    }
}
