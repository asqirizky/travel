<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Tugu Jogja',
                'location' => 'Yogyakarta',
                'image' => 'https://images.unsplash.com/photo-1602057512587-76d5cc4b34e2?q=80',
                'short_description' => 'Ikon kota Yogyakarta yang menjadi simbol semangat dan persatuan.',
                'description' => 'Tugu Yogyakarta atau Tugu Pal Putih berdiri di jantung kota sebagai penanda sejarah dan budaya. Kawasan ini menjadi titik awal menjelajahi Malioboro, Keraton, serta wisata kuliner khas Jogja.',
                'sections' => [
                    [
                        'title' => 'Sejarah Singkat',
                        'description' => 'Dibangun pada masa Sultan Hamengkubuwono I, tugu ini menjadi bagian dari sumbu imajiner Keraton Yogyakarta yang menghubungkan Gunung Merapi, Tugu, dan Laut Selatan.',
                        'image' => '/landing_hero/borobudur.jpg',
                    ],
                    [
                        'title' => 'Daya Tarik',
                        'description' => 'Suasana malam dengan lampu taman, becak wisata, dan pedagang kaki lima membuat kawasan ini selalu hidup. Cocok untuk berfoto dan menikmati kota bersama keluarga.',
                        'image' => null,
                    ],
                    [
                        'title' => 'Tips Berkunjung',
                        'description' => 'Datanglah pada sore hingga malam hari. Gunakan transportasi online atau andong untuk pengalaman khas Yogyakarta, dan tetap jaga kebersihan kawasan.',
                        'image' => null,
                    ],
                ],
            ],
            [
                'name' => 'Tumpak Sewu',
                'location' => 'Lumajang',
                'image' => '/landing_hero/tumpak_sewu.jpg',
                'short_description' => 'Air terjun megah berbentuk tirai yang dikelilingi tebing hijau.',
                'description' => 'Tumpak Sewu dikenal sebagai salah satu air terjun terindah di Indonesia. Aliran airnya membentuk tirai lebar dari ketinggian tebing, dengan latar Gunung Semeru yang menakjubkan.',
                'sections' => [
                    [
                        'title' => 'Keindahan Alam',
                        'description' => 'Ratusan aliran air jatuh secara bersamaan menciptakan kabut halus dan suara gemuruh. Vegetasi tropis yang lebat membuat suasana terasa sejuk sepanjang hari.',
                        'image' => '/landing_hero/tumpak_sewu.jpg',
                    ],
                    [
                        'title' => 'Akses Menuju Lokasi',
                        'description' => 'Perjalanan dilanjutkan dengan trekking dan menuruni tangga menuju dasar jurang. Gunakan alas kaki anti licin dan ikuti arahan pemandu lokal.',
                        'image' => null,
                    ],
                ],
            ],
            [
                'name' => 'Ijen',
                'location' => 'Banyuwangi',
                'image' => '/landing_hero/ijen.jpg',
                'short_description' => 'Danau kawah toska dengan fenomena api biru yang langka.',
                'description' => 'Kawah Ijen menawarkan pemandangan danau asam berwarna toska yang memukau. Fenomena blue fire yang muncul pada dini hari menjadi daya tarik utama bagi wisatawan dari seluruh dunia.',
                'sections' => [
                    [
                        'title' => 'Blue Fire',
                        'description' => 'Api biru terbentuk dari pembakaran gas sulfur pada suhu tinggi. Fenomena ini paling baik disaksikan pada dini hari sebelum matahari terbit.',
                        'image' => '/kawah-ijen.jpg',
                    ],
                    [
                        'title' => 'Pertambangan Sulfur',
                        'description' => 'Di sekitar kawah masih aktif penambangan sulfur tradisional. Wisatawan diimbau menggunakan masker dan tidak mendekati area tambang tanpa pemandu.',
                        'image' => null,
                    ],
                ],
            ],
            [
                'name' => 'Bromo',
                'location' => 'East Java',
                'image' => '/landing_hero/bromo.jpg',
                'short_description' => 'Sunrise legendaris di atas lautan pasir dan kawah vulkanik.',
                'description' => 'Gunung Bromo adalah salah satu destinasi paling ikonik di Jawa Timur. Menyaksikan matahari terbit dari Penanjakan dengan latar kawah berasap menjadi pengalaman yang tak terlupakan.',
                'sections' => [
                    [
                        'title' => 'Sunrise Penanjakan',
                        'description' => 'Titik pandang terbaik berada di Bukit Penanjakan. Datang lebih awal untuk mendapatkan spot favorit dan siapkan jaket karena suhu sangat dingin.',
                        'image' => '/landing_hero/bromo.jpg',
                    ],
                    [
                        'title' => 'Lautan Pasir',
                        'description' => 'Kawasan lautan pasir dapat dijelajahi dengan jeep 4x4 menuju kaki kawah. Nikmati juga suasana Pura Luhur Poten di tengah lautan pasir.',
                        'image' => '/landing_hero/ijen.jpg',
                    ],
                ],
            ],
        ];

        foreach ($destinations as $data) {
            $destination = Destination::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'name' => $data['name'],
                    'location' => $data['location'],
                    'short_description' => $data['short_description'],
                    'description' => $data['description'],
                    'image' => $data['image'],
                    'is_active' => true,
                ],
            );

            foreach ($data['sections'] as $index => $section) {
                $destination->sections()->updateOrCreate(
                    ['title' => $section['title']],
                    [
                        'description' => $section['description'],
                        'image' => $section['image'],
                        'sort_order' => $index,
                    ],
                );
            }
        }
    }
}
