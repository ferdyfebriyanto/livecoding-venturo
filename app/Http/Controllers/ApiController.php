<?php

namespace App\Http\Controllers;

use App\Models\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function beranda()
    {
        // Menampung tahun jika kosong
        $tahun = '';

        // Masuk ke halaman App
        return view('app', compact('tahun'));
    }

    public function ambilData(Request $request)
    {
        // ambil value dari select/memilih tahun pada halaman app
        $tahun = $request->tahun;

        // Parameter nilai sebagai penampung total
        $nilai = 0;

        // Mengambil API dari web tes-web.landa.id
        $apiMenu = Http::get('http://tes-web.landa.id/intermediate/menu');
        $apiTransaksi = Http::get('https://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun);

        // Mengubah format API Menu ke bentuk JSON
        $menu = json_decode($apiMenu);

        // Mengubah format API transaksi ke bentuk JSON
        $transaksi = json_decode($apiTransaksi);

        // Merubah format dalam bahasa indonesia
        setlocale(LC_ALL, 'id-ID', 'id_ID');

        // Jika berhasil value Tahun
        if($tahun) {

            // Menghitung total keseluruhan
            foreach ($transaksi as $hasil) {
                $nilai += $hasil->total;
            }

            // Membuat penampung untuk menghitung total menu per bulan
            foreach ($menu as $item) {
                for ($i = 1; $i <= 12; $i++) {
                    $result[$item->menu][$i] = 0;
                }
            }

            // Menghitung total menu per bulan
            foreach ($transaksi as $data) {
                $bulan = date('n', strtotime($data->tanggal));
                $result[$data->menu][$bulan] += $data->total;
            }

            // Membuat penampung untuk jumlah transaksi per bulan
            foreach ($transaksi as $jml) {
                for ($i = 1; $i <= 12; $i++) {
                    $jumlah[$i] = 0;
                }
            }

            // Menghitung jumlah total transaksi per bulan
            foreach($transaksi as $perbulan) {
                $hari = date('n', strtotime($perbulan->tanggal));
                $jumlah[$hari] += $perbulan->total;
            }

            // Membuat penampung untuk menu per tahun
            foreach ($menu as $permenu) {
                $jumlahmenu[$permenu->menu] = 0;
            }

            // Menghitung total menu per tahun
            foreach ($transaksi as $jmltrans) {
                $jumlahmenu[$jmltrans->menu] += $jmltrans->total;
            }

            // Untuk mengecek seluruh data
            $data = [
                'a' => $menu,
                'b' => $transaksi,
                'c' => $jumlahmenu,
                'd' => $jumlah,
                'e' => $result,
            ];

            // Mengirim data ke view App
            return view('app', compact('tahun', 'menu', 'transaksi', 'result', 'nilai', 'jumlah', 'jumlahmenu', 'data'));

        } else {
            return redirect('/');
        }
    }
}
