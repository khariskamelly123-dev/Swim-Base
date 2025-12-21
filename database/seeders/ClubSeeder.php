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
                'name' => 'ARWANA SWIMMING CLUB GUNUNG KIDUL',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Gunung Kidul',
                'address' => 'Jl. Baron Km. 2, Wonosari',
                'phone' => '081234560001',
                'email' => 'arwana.gk@gmail.com',
            ],
            [
                'name' => 'ARWANA SWIMMING CLUB SLEMAN',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Sleman',
                'address' => 'Jl. Magelang Km. 9, Sleman',
                'phone' => '081234560002',
                'email' => 'arwana.sleman@gmail.com',
            ],
            [
                'name' => 'AVATAR SWIMMING CLUB KULONPROGO',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Kulon Progo',
                'address' => 'Jl. Wates Km. 10, Wates',
                'phone' => '081234560003',
                'email' => 'avatar.kp@gmail.com',
            ],
            [
                'name' => 'AYAH BINTANG AQUATIC SC KEBUMEN',
                'province' => 'Jawa Tengah',
                'city' => 'Kab. Kebumen',
                'address' => 'Jl. Pemuda No. 45, Kebumen',
                'phone' => '081234560004',
                'email' => 'ayahbintang.sc@gmail.com',
            ],
            [
                'name' => 'CAESAR SWIMMING CLUB KULONPROGO',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Kulon Progo',
                'address' => 'Jl. Bhayangkara No. 12, Wates',
                'phone' => '081234560005',
                'email' => 'caesar.sc@gmail.com',
            ],
            [
                'name' => 'DOLPHIN SWIMMING CLUB SLEMAN',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Sleman',
                'address' => 'Jl. Kaliurang Km. 5, Depok',
                'phone' => '081234560006',
                'email' => 'dolphin.sleman@gmail.com',
            ],
            [
                'name' => 'JAQ YOGYAKARTA',
                'province' => 'DI Yogyakarta',
                'city' => 'Kota Yogyakarta',
                'address' => 'Jl. Kusumanegara No. 88, Umbulharjo',
                'phone' => '081234560007',
                'email' => 'jaq.yogya@gmail.com',
            ],
            [
                'name' => 'JINGGAR GARUDA MUDA SC',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Sleman',
                'address' => 'Jl. Palagan Tentara Pelajar No. 20',
                'phone' => '081234560008',
                'email' => 'jinggar.gm@gmail.com',
            ],
            [
                'name' => 'KAIZEN SWIMMING CLUB BANTUL',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Bantul',
                'address' => 'Jl. Parangtritis Km. 7, Sewon',
                'phone' => '081234560009',
                'email' => 'kaizen.bantul@gmail.com',
            ],
            [
                'name' => 'OSCAR SWIMMING CLUB BANTUL',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Bantul',
                'address' => 'Jl. Bantul Km. 5, Bantul',
                'phone' => '081234560010',
                'email' => 'oscar.sc@gmail.com',
            ],
            [
                'name' => 'PARI SAKTI SWIMMING CLUB JAKARTA',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Selatan',
                'address' => 'Jl. Fatmawati Raya No. 10, Cilandak',
                'phone' => '081234560011',
                'email' => 'parisakti.jkt@gmail.com',
            ],
            [
                'name' => 'PARI SAKTI SWIMMING CLUB YOGYAKARTA',
                'province' => 'DI Yogyakarta',
                'city' => 'Kota Yogyakarta',
                'address' => 'Jl. Kenari No. 5, Muja Muju',
                'phone' => '081234560012',
                'email' => 'parisakti.jogja@gmail.com',
            ],
            [
                'name' => 'PENGUIN STAR SWIMMING CLUB YOGYAKARTA',
                'province' => 'DI Yogyakarta',
                'city' => 'Kota Yogyakarta',
                'address' => 'Jl. Timoho No. 32, Gondokusuman',
                'phone' => '081234560013',
                'email' => 'penguin.star@gmail.com',
            ],
            [
                'name' => 'PINGUIN SWIMMING CLUB SLEMAN',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Sleman',
                'address' => 'Jl. Gejayan No. 15, Depok',
                'phone' => '081234560014',
                'email' => 'pinguin.sleman@gmail.com',
            ],
            [
                'name' => 'SATRIA MATARAM AQUATIC SLEMAN',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Sleman',
                'address' => 'Jl. Godean Km. 4, Gamping',
                'phone' => '081234560015',
                'email' => 'satriamataram@gmail.com',
            ],
            [
                'name' => 'SHARK SWIMMING CLUB KULONPROGO',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Kulon Progo',
                'address' => 'Jl. Pengasih No. 8, Pengasih',
                'phone' => '081234560016',
                'email' => 'shark.kp@gmail.com',
            ],
            [
                'name' => 'SWIFT SWIMMING CLUB',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Sleman',
                'address' => 'Jl. Seturan Raya No. 99, Depok',
                'phone' => '081234560017',
                'email' => 'swift.sc@gmail.com',
            ],
            [
                'name' => 'TIRTA ALVITA BANTUL',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Bantul',
                'address' => 'Jl. Imogiri Barat Km. 10',
                'phone' => '081234560018',
                'email' => 'tirta.alvita@gmail.com',
            ],
            [
                'name' => 'TIRTA AMANDA SWIMMING CLUB YOGYAKARTA',
                'province' => 'DI Yogyakarta',
                'city' => 'Kota Yogyakarta',
                'address' => 'Jl. Menteri Supeno No. 21',
                'phone' => '081234560019',
                'email' => 'tirta.amanda@gmail.com',
            ],
            [
                'name' => 'TIRTA DHAKSINARGA GUNUNG KIDUL',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Gunung Kidul',
                'address' => 'Jl. Kyai Legi No. 5, Wonosari',
                'phone' => '081234560020',
                'email' => 'tirta.dhaksinarga@gmail.com',
            ],
            [
                'name' => 'TIRTA TAMANSARI SWIMMING CLUB BANTUL',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Bantul',
                'address' => 'Jl. Tamansari No. 3, Wijirejo',
                'phone' => '081234560021',
                'email' => 'tirta.tamansari@gmail.com',
            ],
            [
                'name' => 'TIRTA TARUNA YOGYAKARTA',
                'province' => 'DI Yogyakarta',
                'city' => 'Kota Yogyakarta',
                'address' => 'Jl. Sisingamangaraja No. 7',
                'phone' => '081234560022',
                'email' => 'tirta.taruna@gmail.com',
            ],
            [
                'name' => 'UNYLES AQUATIC KULONPROGO',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Kulon Progo',
                'address' => 'Jl. Sentolo-Wates Km. 2',
                'phone' => '081234560023',
                'email' => 'unyles.aquatic@gmail.com',
            ],
            [
                'name' => 'WOLVES SWIMMING CLUB SURABAYA',
                'province' => 'Jawa Timur',
                'city' => 'Kota Surabaya',
                'address' => 'Jl. Raya Darmo No. 55, Surabaya',
                'phone' => '081234560024',
                'email' => 'wolves.sby@gmail.com',
            ],
            [
                'name' => 'YUSO SWIMMING CLUB SLEMAN',
                'province' => 'DI Yogyakarta',
                'city' => 'Kab. Sleman',
                'address' => 'Jl. Ringroad Utara, Condongcatur',
                'phone' => '081234560025',
                'email' => 'yuso.sleman@gmail.com',
            ],
        ];

        foreach ($clubs as $data) {
            Club::updateOrCreate(
                ['email' => $data['email']], // Kolom unik untuk pengecekan
                [
                    'name'     => $data['name'],
                    'province' => $data['province'],
                    'city'     => $data['city'],
                    'address'  => $data['address'],
                    'phone'    => $data['phone'],
                    'password' => $password,
                ]
            );
        }
    }
}