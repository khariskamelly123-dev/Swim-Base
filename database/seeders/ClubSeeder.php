<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        // Kita hash password sekali saja agar performa lebih cepat
        $password = Hash::make('password123');

        $clubs = [
            [
                'nama_klub' => 'ARWANA SWIMMING CLUB GUNUNG KIDUL',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Gunung Kidul',
                'alamat_klub' => 'Jl. Baron Km. 2, Wonosari',
                'kontak_club' => '081234560001',
                'email_resmi' => 'arwana.gk@gmail.com',
            ],
            [
                'nama_klub' => 'ARWANA SWIMMING CLUB SLEMAN',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Sleman',
                'alamat_klub' => 'Jl. Magelang Km. 9, Sleman',
                'kontak_club' => '081234560002',
                'email_resmi' => 'arwana.sleman@gmail.com',
            ],
            [
                'nama_klub' => 'AVATAR SWIMMING CLUB KULONPROGO',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Kulon Progo',
                'alamat_klub' => 'Jl. Wates Km. 10, Wates',
                'kontak_club' => '081234560003',
                'email_resmi' => 'avatar.kp@gmail.com',
            ],
            [
                'nama_klub' => 'AYAH BINTANG AQUATIC SC KEBUMEN',
                'provinsi' => 'Jawa Tengah',
                'kota' => 'Kab. Kebumen',
                'alamat_klub' => 'Jl. Pemuda No. 45, Kebumen',
                'kontak_club' => '081234560004',
                'email_resmi' => 'ayahbintang.sc@gmail.com',
            ],
            [
                'nama_klub' => 'CAESAR SWIMMING CLUB KULONPROGO',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Kulon Progo',
                'alamat_klub' => 'Jl. Bhayangkara No. 12, Wates',
                'kontak_club' => '081234560005',
                'email_resmi' => 'caesar.sc@gmail.com',
            ],
            [
                'nama_klub' => 'DOLPHIN SWIMMING CLUB SLEMAN',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Sleman',
                'alamat_klub' => 'Jl. Kaliurang Km. 5, Depok',
                'kontak_club' => '081234560006',
                'email_resmi' => 'dolphin.sleman@gmail.com',
            ],
            [
                'nama_klub' => 'JAQ YOGYAKARTA',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kota Yogyakarta',
                'alamat_klub' => 'Jl. Kusumanegara No. 88, Umbulharjo',
                'kontak_club' => '081234560007',
                'email_resmi' => 'jaq.yogya@gmail.com',
            ],
            [
                'nama_klub' => 'JINGGAR GARUDA MUDA SC',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Sleman',
                'alamat_klub' => 'Jl. Palagan Tentara Pelajar No. 20',
                'kontak_club' => '081234560008',
                'email_resmi' => 'jinggar.gm@gmail.com',
            ],
            [
                'nama_klub' => 'KAIZEN SWIMMING CLUB BANTUL',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Bantul',
                'alamat_klub' => 'Jl. Parangtritis Km. 7, Sewon',
                'kontak_club' => '081234560009',
                'email_resmi' => 'kaizen.bantul@gmail.com',
            ],
            [
                'nama_klub' => 'OSCAR SWIMMING CLUB BANTUL',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Bantul',
                'alamat_klub' => 'Jl. Bantul Km. 5, Bantul',
                'kontak_club' => '081234560010',
                'email_resmi' => 'oscar.sc@gmail.com',
            ],
            [
                'nama_klub' => 'PARI SAKTI SWIMMING CLUB JAKARTA',
                'provinsi' => 'DKI Jakarta',
                'kota' => 'Jakarta Selatan',
                'alamat_klub' => 'Jl. Fatmawati Raya No. 10, Cilandak',
                'kontak_club' => '081234560011',
                'email_resmi' => 'parisakti.jkt@gmail.com',
            ],
            [
                'nama_klub' => 'PARI SAKTI SWIMMING CLUB YOGYAKARTA',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kota Yogyakarta',
                'alamat_klub' => 'Jl. Kenari No. 5, Muja Muju',
                'kontak_club' => '081234560012',
                'email_resmi' => 'parisakti.jogja@gmail.com',
            ],
            [
                'nama_klub' => 'PENGUIN STAR SWIMMING CLUB YOGYAKARTA',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kota Yogyakarta',
                'alamat_klub' => 'Jl. Timoho No. 32, Gondokusuman',
                'kontak_club' => '081234560013',
                'email_resmi' => 'penguin.star@gmail.com',
            ],
            [
                'nama_klub' => 'PINGUIN SWIMMING CLUB SLEMAN',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Sleman',
                'alamat_klub' => 'Jl. Gejayan No. 15, Depok',
                'kontak_club' => '081234560014',
                'email_resmi' => 'pinguin.sleman@gmail.com',
            ],
            [
                'nama_klub' => 'SATRIA MATARAM AQUATIC SLEMAN',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Sleman',
                'alamat_klub' => 'Jl. Godean Km. 4, Gamping',
                'kontak_club' => '081234560015',
                'email_resmi' => 'satriamataram@gmail.com',
            ],
            [
                'nama_klub' => 'SHARK SWIMMING CLUB KULONPROGO',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Kulon Progo',
                'alamat_klub' => 'Jl. Pengasih No. 8, Pengasih',
                'kontak_club' => '081234560016',
                'email_resmi' => 'shark.kp@gmail.com',
            ],
            [
                'nama_klub' => 'SWIFT SWIMMING CLUB',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Sleman',
                'alamat_klub' => 'Jl. Seturan Raya No. 99, Depok',
                'kontak_club' => '081234560017',
                'email_resmi' => 'swift.sc@gmail.com',
            ],
            [
                'nama_klub' => 'TIRTA ALVITA BANTUL',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Bantul',
                'alamat_klub' => 'Jl. Imogiri Barat Km. 10',
                'kontak_club' => '081234560018',
                'email_resmi' => 'tirta.alvita@gmail.com',
            ],
            [
                'nama_klub' => 'TIRTA AMANDA SWIMMING CLUB YOGYAKARTA',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kota Yogyakarta',
                'alamat_klub' => 'Jl. Menteri Supeno No. 21',
                'kontak_club' => '081234560019',
                'email_resmi' => 'tirta.amanda@gmail.com',
            ],
            [
                'nama_klub' => 'TIRTA DHAKSINARGA GUNUNG KIDUL',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Gunung Kidul',
                'alamat_klub' => 'Jl. Kyai Legi No. 5, Wonosari',
                'kontak_club' => '081234560020',
                'email_resmi' => 'tirta.dhaksinarga@gmail.com',
            ],
            [
                'nama_klub' => 'TIRTA TAMANSARI SWIMMING CLUB BANTUL',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Bantul',
                'alamat_klub' => 'Jl. Tamansari No. 3, Wijirejo',
                'kontak_club' => '081234560021',
                'email_resmi' => 'tirta.tamansari@gmail.com',
            ],
            [
                'nama_klub' => 'TIRTA TARUNA YOGYAKARTA',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kota Yogyakarta',
                'alamat_klub' => 'Jl. Sisingamangaraja No. 7',
                'kontak_club' => '081234560022',
                'email_resmi' => 'tirta.taruna@gmail.com',
            ],
            [
                'nama_klub' => 'UNYLES AQUATIC KULONPROGO',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Kulon Progo',
                'alamat_klub' => 'Jl. Sentolo-Wates Km. 2',
                'kontak_club' => '081234560023',
                'email_resmi' => 'unyles.aquatic@gmail.com',
            ],
            [
                'nama_klub' => 'WOLVES SWIMMING CLUB SURABAYA',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Kota Surabaya',
                'alamat_klub' => 'Jl. Raya Darmo No. 55, Surabaya',
                'kontak_club' => '081234560024',
                'email_resmi' => 'wolves.sby@gmail.com',
            ],
            [
                'nama_klub' => 'YUSO SWIMMING CLUB SLEMAN',
                'provinsi' => 'DI Yogyakarta',
                'kota' => 'Kab. Sleman',
                'alamat_klub' => 'Jl. Ringroad Utara, Condongcatur',
                'kontak_club' => '081234560025',
                'email_resmi' => 'yuso.sleman@gmail.com',
            ],
        ];

        foreach ($clubs as $data) {
            Club::updateOrCreate(
                ['email_resmi' => $data['email_resmi']], // Kolom unik untuk pengecekan
                [
                    'nama_klub' => $data['nama_klub'],
                    'provinsi' => $data['provinsi'],
                    'kota' => $data['kota'],
                    'alamat_klub' => $data['alamat_klub'],
                    'kontak_club' => $data['kontak_club'],
                    'password' => $password, // Password yang sudah di-hash
                ]
            );
        }
    }
}