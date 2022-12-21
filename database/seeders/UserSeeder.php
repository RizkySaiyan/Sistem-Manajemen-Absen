<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\divisi;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Bibo Murphy',
                'alamat' => 'Jalan Buluh Indah',
                'notelp' => '085847172850',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'divisi_id' => 1,
                'golongan_id' => 1,
                'email' => 'bibomurphy@gmail.com',
                'nik' => '134124234',
                'role' => 'Admin'
            ],
        ];

        $divisi = [
            [
                'id' => 1,
                'nama_divisi' => 'Marketing',
                'kode_divisi' => 'MKT-01'
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        };

        foreach ($divisi as $key => $value) {
            divisi::create($value);
        };
    }
}
