<?php

use Illuminate\Database\Seeder;
use App\Model\Menu;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add role
        $roles = [
                [
                    'parent_id' => 2,
                    'nama_menu' => 'kata Pengantar',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 2,
                    'nama_menu' => 'Pengasuh Al-Amin',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 2,
                    'nama_menu' => 'kata Pengantar',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 2,
                    'nama_menu' => 'Profil Sekolah',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 2,
                    'nama_menu' => 'Visi & Misi',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 2,
                    'nama_menu' => 'Struktur Organisasi',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 2,
                    'nama_menu' => 'Pegawai',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
            [
                'parent_id' => 0,
                'nama_menu' => 'Fasilitas',
                'level' => '0',
                'aktif' => 1, 'kunjungan'=> 0,
            ],
                [
                    'parent_id' => 10,
                    'nama_menu' => 'Ruang Kelas',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 10,
                    'nama_menu' => 'Lab Komputer',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 10,
                    'nama_menu' => 'Perpustakaan',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 10,
                    'nama_menu' => 'Tempat Ibadah',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
                [
                    'parent_id' => 10,
                    'nama_menu' => 'Kantin Bersama',
                    'level' => '0',
                    'aktif' => 1, 'kunjungan'=> 0,
                ],
            [
                'parent_id' => 05,
                'nama_menu' => 'Galleri',
                'level' => '0',
                'aktif' => 1, 'kunjungan'=> 0,
            ],
            [
                'parent_id' => 0,
                'nama_menu' => 'Mading Sekolah',
                'level' => '0',
                'aktif' => 0, 'kunjungan'=> 0,
            ],
            [
                'parent_id' => 0,
                'nama_menu' => 'E-Learning',
                'level' => '0',
                'aktif' => 0, 'kunjungan'=> 0,
            ],
            [
                'parent_id' => 0,
                'nama_menu' => 'Rapor Santri',
                'level' => '0',
                'aktif' => 0, 'kunjungan'=> 0,
            ],
            [
                'parent_id' => 2,
                'nama_menu' => 'Alumni',
                'level' => '0',
                'aktif' => 0, 'kunjungan'=> 0,
            ],
        ];
		foreach ($roles as $key => $value) {
            Menu::create($value);
        }
		
    }
}
