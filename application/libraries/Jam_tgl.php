<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jam_tgl
{

    function tgl_indo($tanggal)
    {
        $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
        $hari = array(
        1 => 'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );
        $pecahkan = explode('-', $tanggal);
        // Contoh tanggal 20 Maret 2016 adalah hari Minggu
        $num = date(
        'N',
        strtotime($tanggal)
    );
        return $pecahkan[2]  . '-' . $bulan[(int)$pecahkan[1]] . '-' . $pecahkan[0];
    }
    
}
