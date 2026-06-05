<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'nama'           => 'Servis Ringan',
                'deskripsi'      => 'Perawatan rutin untuk menjaga performa kendaraan dan mencegah kerusakan lebih lanjut.',
                'harga_mulai'    => 75000,
                'estimasi_waktu' => '30-60 Menit',
                'items'          => [
                    'Ganti Oli',
                    'Cek Rem',
                    'Cek Ban',
                    'Cek Aki',
                    'Cek Lampu',
                    'Cek Filter Udara',
                ],
            ],
            [
                'nama'           => 'Servis Berkala',
                'deskripsi'      => 'Perawatan sesuai jadwal kilometer kendaraan.',
                'harga_mulai'    => 150000,
                'estimasi_waktu' => '1-2 Jam',
                'items'          => [
                    'Ganti Oli',
                    'Pemeriksaan Sistem Injeksi',
                    'Pemeriksaan Busi',
                    'Pemeriksaan Filter Udara',
                    'Pemeriksaan Rem',
                ],
            ],
            [
                'nama'           => 'Tune Up',
                'deskripsi'      => 'Penyetelan dan pemeriksaan mesin agar performa kembali optimal.',
                'harga_mulai'    => 200000,
                'estimasi_waktu' => '1-2 Jam',
                'items'          => [
                    'Cek Busi',
                    'Bersihkan Throttle Body',
                    'Cek Injektor',
                    'Setel Idle Mesin',
                ],
            ],
            [
                'nama'           => 'Servis Rem',
                'deskripsi'      => 'Pemeriksaan dan perawatan sistem pengereman.',
                'harga_mulai'    => 100000,
                'estimasi_waktu' => '30-90 Menit',
                'items'          => [
                    'Cek Kampas Rem',
                    'Cek Cakram',
                    'Cek Minyak Rem',
                    'Pembersihan Komponen Rem',
                ],
            ],
            [
                'nama'           => 'Servis Kelistrikan',
                'deskripsi'      => 'Pemeriksaan seluruh sistem listrik kendaraan.',
                'harga_mulai'    => 100000,
                'estimasi_waktu' => '1-3 Jam',
                'items'          => [
                    'Cek Aki',
                    'Cek Sekring',
                    'Cek Lampu',
                    'Cek Starter',
                    'Cek Sistem Pengisian',
                ],
            ],
            [
                'nama'           => 'Overhaul Mesin',
                'deskripsi'      => 'Perbaikan menyeluruh untuk mesin yang mengalami kerusakan berat.',
                'harga_mulai'    => 500000,
                'estimasi_waktu' => '1-7 Hari',
                'items'          => [
                    'Bongkar Mesin',
                    'Pemeriksaan Piston',
                    'Pemeriksaan Ring Piston',
                    'Pemeriksaan Silinder',
                    'Pemeriksaan Klep',
                ],
            ],
        ];

        foreach ($services as $serviceData) {
            $items = $serviceData['items'];
            unset($serviceData['items']);

            $serviceData['slug'] = Str::slug($serviceData['nama']);

            $service = Service::create($serviceData);

            foreach ($items as $item) {
                ServiceItem::create([
                    'service_id'     => $service->id,
                    'nama_pekerjaan' => $item,
                ]);
            }
        }
    }
}
