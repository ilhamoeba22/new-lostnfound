<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ==== USERS ====
        if (!DB::table('users')->where('email', 'admin@gmail.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@gmail.com')
            ]);
        }

        if (!DB::table('users')->where('email', 'user@gmail.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'user',
                'role' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user@gmail.com')
            ]);
        }

        // ==== KATEGORI ====
        $kategoris = [
            'Bagasi/Tas',
            'Elektronik & gadget',
            'Pakaian & Aksesoris',
            'Dokumen & Identitas',
            'Kantor & Industri',
            'Kosmetik & Perawatan',
            'Konsumsi & Barang Kecil',
            'Barang Bernilai/Dompet',
            'Perlengkapan Pribadi/transportasi'
        ];

        foreach ($kategoris as $value) {
            if (!DB::table('kategoris')->where('nama', $value)->exists()) {
                DB::table('kategoris')->insert(['nama' => $value]);
            }
        }

        // ==== STASIUN ====
        $stasiun = [
            'Tugu Yogyakarta',
            'Lempuyangan',
            'Maguwo',
            'Brambanan',
            'Srowot',
            'Klaten',
            'Ceper',
            'Delanggu',
            'Gawok',
            'Purwosari',
            'Solo Balapan',
            'Solo Jebres',
            'Palur'
        ];

        foreach ($stasiun as $value) {
            if (!DB::table('statiuns')->where('nama', $value)->exists()) {
                DB::table('statiuns')->insert(['nama' => $value]);
            }
        }

        // ==== AREA ====
        $area = [
            'Area Check-in & Boarding',
            'Area Merokok',
            'Area Penjemputan',
            'ATM Center',
            'Di Dalam Kereta (Gerbong)',
            'Kantin / Food Court',
            'Layanan Pelanggan (CS)',
            'Lobi Utama',
            'Loket Tiket',
            'Mesin Penjual Otomatis (Vending Machine)',
            'Minimarket',
            'Musholla',
            'Peron',
            'Pintu Keluar',
            'Pintu Masuk',
            'Pos Keamanan',
            'Pos Kesehatan',
            'Restorasi Kereta (Gerbong Makan)',
            'Ruang Laktasi',
            'Ruang Tunggu',
            'Shelter Ojek Online / Taksi',
            'Tempat Parkir',
            'Toko Ritel / Oleh-oleh',
            'Toilet / Kamar Mandi',
        ];

        foreach ($area as $value) {
            if (!DB::table('areas')->where('nama', $value)->exists()) {
                DB::table('areas')->insert(['nama' => $value]);
            }
        }
    }
}
