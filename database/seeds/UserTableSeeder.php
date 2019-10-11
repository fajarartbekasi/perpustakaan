<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ketua
        $petugas = factory(User::class)->create([
            'nis'      => '199312102018081001',
            'name'     => 'Taylor Otwell',
            'email'    => 'petugas@perpustakaan.com',
            'password' => bcrypt('perpustakaan'),
        ]);

        $petugas->assignRole('petugas');

        $this->command->info('>_ Here is your petugas details to login:');
        $this->command->warn($petugas->email);
        $this->command->warn('Password is "perpustakaan"');

        // anggota
        $anggota = factory(User::class)->create([
            'nis'      => '199312102018081004',
            'name'     => 'John Doe',
            'email'    => 'anggota@perpustakaan.com',
            'password' => bcrypt('perpustakaan'),
        ]);

        $anggota->assignRole('anggota');

        $this->command->info('>_ Here is your anggota details to login:');
        $this->command->warn($anggota->email);
        $this->command->warn('Password is "perpustakaan"');

        // bersihkan cache
        $this->command->call('cache:clear');
    }
}
