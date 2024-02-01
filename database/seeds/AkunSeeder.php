<?php

use Illuminate\Database\Seeder;
use App\User;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        User::create([
            'nama' => 'ketua',
            'email' => 'ketua@gmail.com',
            'password' => bcrypt('ketua@gmail.com'),
            'level' => 'ketua',
            'tanggal_lahir' => '',
            'avatar' => '',
            'status' => 1,
            'nohp' => '',
            'alamat' => '',
        ]);
        User::create([
            'nama' => 'bendahara',
            'email' => 'bendahara@gmail.com',
            'password' => bcrypt('bendahara@gmail.com'),
            'level' => 'bendahara',
            'tanggal_lahir' => '',
            'avatar' => '',
            'status' => 1,
            'nohp' => '',
            'alamat' => '',
        ]);
        User::create([
            'nama' => 'sekretaris',
            'email' => 'sekretaris@gmail.com',
            'password' => bcrypt('sekretaris@gmail.com'),
            'level' => 'sekretaris',
            'tanggal_lahir' => '',
            'avatar' => '',
            'status' => 1,
            'nohp' => '',
            'alamat' => '',
        ]);
        User::create([
            'nama' => 'supporter',
            'email' => 'supporter@gmail.com',
            'password' => bcrypt('supporter@gmail.com'),
            'level' => 'supporter',
            'tanggal_lahir' => '',
            'avatar' => '',
            'status' => 1,
            'nohp' => '',
            'alamat' => '',
        ]);
    }
}
