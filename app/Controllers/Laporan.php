<?php

namespace App\Controllers;

use App\Models\getModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->get = new getModel();
    }

    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $data = [
            'title' => 'Rekap Laporan',
            'session' => $session,
        ];
        return view('laporan/index', $data);
    }

    function pemasukan_harian()
    {
        $session = $this->get->getSession();
        $data = [
            'title' => 'Rekap Laporan',
            'session' => $session,
        ];
        return view('laporan/pemasukan_harian', $data);
    }

    function pengeluaran_harian()
    {
        $session = $this->get->getSession();
        $data = [
            'title' => 'Rekap Laporan',
            'session' => $session,
        ];
        return view('laporan/pengeluaran_harian', $data);
    }

    function pemasukan_bulanan()
    {
        $session = $this->get->getSession();
        $data = [
            'title' => 'Rekap Laporan',
            'session' => $session,
        ];
        return view('laporan/pemasukan_bulanan', $data);
    }

    function pengeluaran_bulanan()
    {
        $session = $this->get->getSession();
        $data = [
            'title' => 'Rekap Laporan',
            'session' => $session,
        ];
        return view('laporan/pengeluaran_bulanan', $data);
    }

    function get_laporan_pemasukan_harian()
    {
        $tgl_laporan = $this->request->getVar('tgl_laporan');
        if ($tgl_laporan == '') {
            $tgl_laporan = date('Y-m-d');
        }
        $data = $this->get->getLaporanPemasukanHarian($tgl_laporan);
        echo json_encode($data);
    }

    function get_laporan_pengeluaran_harian()
    {
        $tgl_laporan = $this->request->getVar('tgl_laporan');
        if ($tgl_laporan == '') {
            $tgl_laporan = date('Y-m-d');
        }
        $data = $this->get->getLaporanPengeluaranHarian($tgl_laporan);
        echo json_encode($data);
    }

    function get_laporan_pemasukan_bulanan()
    {
        $bln_laporan = $this->request->getVar('bln_laporan');
        $thn_laporan = $this->request->getVar('thn_laporan');
        if ($bln_laporan == 'all') {
            $data = $this->get->getLaporanPemasukanBulananAll($thn_laporan);
        } else {
            $data = $this->get->getLaporanPemasukanBulanan($bln_laporan, $thn_laporan);
        }
        echo json_encode($data);
    }

    function get_laporan_pengeluaran_bulanan()
    {
        $bln_laporan = $this->request->getVar('bln_laporan');
        $thn_laporan = $this->request->getVar('thn_laporan');
        if ($bln_laporan == 'all') {
            $data = $this->get->getLaporanPengeluaranBulananAll($thn_laporan);
        } else {
            $data = $this->get->getLaporanPengeluaranBulanan($bln_laporan, $thn_laporan);
        }
        echo json_encode($data);
    }
}
