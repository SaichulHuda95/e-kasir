<?php

namespace App\Controllers;

use App\Models\getModel;

class Dashboard extends BaseController
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
        $today = date('Y-m-d');
        $month = date('m');
        $year = date('Y');
        $tot_user = $this->get->getCountUser();
        $tot_pemasukan = $this->get->getSumPemasukan();
        $tot_pemasukan_today = $this->get->getSumPemasukanToday($today);
        $tot_pemasukan_month = $this->get->getSumPemasukanMonth($month);
        $tot_pemasukan_year = $this->get->getSumPemasukanYear($year);
        $tot_pengeluaran = $this->get->getSumPengeluaran();
        $top_sales = $this->get->getTopSale();
        $recent_transaction = $this->get->getRecentTransaction();
        $saldo = intval($tot_pemasukan->grand_total) - intval($tot_pengeluaran->jumlah_pengeluaran);
        $data = [
            'title' => 'Dashboard',
            'session' => $session,
            'tot_user' => $tot_user,
            'tot_pemasukan' => $tot_pemasukan,
            'tot_pemasukan_today' => $tot_pemasukan_today,
            'tot_pemasukan_month' => $tot_pemasukan_month,
            'tot_pemasukan_year' => $tot_pemasukan_year,
            'tot_pengeluaran' => $tot_pengeluaran,
            'top_sales' => $top_sales,
            'recent_transaction' => $recent_transaction,
            'saldo' => $saldo
        ];
        return view('dashboard/index', $data);
    }

    public function detail_transaksi()
    {
        $no_faktur = $this->request->getVar('no_faktur');
        $detail_transaksi = $this->get->getDetailTransaksi($no_faktur);
        $data = [
            'detail_transaksi' => $detail_transaksi
        ];
        $msg = [
            'data' => view('dashboard/modaldetailtransaksi', $data)
        ];
        echo json_encode($msg);
    }
}
