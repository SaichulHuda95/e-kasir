<?php

namespace App\Controllers;

use App\Models\getModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->get = new getModel();
    }

    public function harian()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $data = [
            'title' => 'Laporan Harian',
            'session' => $session,
        ];
        return view('laporan/harian', $data);
    }

    function get_laporan_harian()
    {
        $tgl_laporan = $this->request->getVar('tgl_laporan');
        if ($tgl_laporan == '') {
            $tgl_laporan = date('Y-m-d');
        }
        $data = $this->get->getLaporanHarian($tgl_laporan);
        echo json_encode($data);
    }

    public function bulanan()
    {
        $session = $this->get->getSession();
        $data = [
            'title' => 'Laporan Bulanan',
            'session' => $session,
        ];
        return view('laporan/bulanan', $data);
    }

    function get_laporan_bulanan()
    {
        $bln_laporan = $this->request->getVar('bln_laporan');
        $thn_laporan = $this->request->getVar('thn_laporan');
        if ($bln_laporan == 'all') {
            $data = $this->get->getLaporanBulananAll($thn_laporan);
        } else {
            $data = $this->get->getLaporanBulanan($bln_laporan, $thn_laporan);
        }
        echo json_encode($data);
    }
}
