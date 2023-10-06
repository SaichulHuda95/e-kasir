<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;

class Pengeluaran extends BaseController
{
    public function __construct()
    {
        $this->delete = new deleteModel();
        $this->get = new getModel();
        $this->insert = new insertModel();
        $this->update = new updateModel();
        helper('form');
    }
    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $pengeluaran = $this->get->getPengeluaran();
        $data = [
            'title' => 'Pengeluaran',
            'session' => $session,
            'pengeluaran' => $pengeluaran
        ];
        return view('pengeluaran/daftar_pengeluaran', $data);
    }

    function tambah_pengeluaran()
    {
        $msg = [
            'data' => view('pengeluaran/modaltambahpengeluaran')
        ];

        echo json_encode($msg);
    }

    public function simpan_pengeluaran()
    {
        $session = $this->get->getSession();
        $nama_produk = $this->request->getVar('nama_produk');
        $jumlah_produk = $this->request->getVar('jumlah_produk');
        $get_harga_produk = $this->request->getVar('harga_produk');
        $harga_produk = preg_replace("/[^0-9]/", "", $get_harga_produk);
        $get_jumlah_pengeluaran = $this->request->getVar('jumlah_pengeluaran');
        $jumlah_pengeluaran = preg_replace("/[^0-9]/", "", $get_jumlah_pengeluaran);
        $created_at = date('Y-m-d');
        $id_kasir = $session->username;
        $data = [
            'nama_produk' => $nama_produk,
            'jumlah_produk' => $jumlah_produk,
            'harga_produk' => $harga_produk,
            'jumlah_pengeluaran' => $jumlah_pengeluaran,
            'created_at' => $created_at,
            'id_kasir' => $id_kasir
        ];
        $this->insert->insertPengeluaran($data);

        session()->setFlashdata('success', 'Penambahan data pengeluaran berhasil.');
        return redirect()->to('/pengeluaran');
    }

    function edit()
    {
        $id_pengeluaran = $this->request->getVar('id_pengeluaran');
        $data_pengeluaran = $this->get->getPengeluaranById($id_pengeluaran);
        $data = [
            'id_pengeluaran' => $id_pengeluaran,
            'nama_produk' => $data_pengeluaran->nama_produk,
            'jumlah_produk' => $data_pengeluaran->jumlah_produk,
            'harga_produk' => $data_pengeluaran->harga_produk,
            'jumlah_pengeluaran' => $data_pengeluaran->jumlah_pengeluaran
        ];
        $msg = [
            'data' => view('pengeluaran/modaleditpengeluaran', $data)
        ];
        echo json_encode($msg);
    }

    public function update_pengeluaran()
    {
        $id_pengeluaran = $this->request->getVar('id_pengeluaran');
        $nama_produk = $this->request->getVar('nama_produk');
        $jumlah_produk = $this->request->getVar('jumlah_produk');
        $get_harga_produk = $this->request->getVar('harga_produk');
        $harga_produk = preg_replace("/[^0-9]/", "", $get_harga_produk);
        $get_jumlah_pengeluaran = $this->request->getVar('jumlah_pengeluaran');
        $jumlah_pengeluaran = preg_replace("/[^0-9]/", "", $get_jumlah_pengeluaran);
        $data = [
            'nama_produk' => $nama_produk,
            'jumlah_produk' => $jumlah_produk,
            'harga_produk' => $harga_produk,
            'jumlah_pengeluaran' => $jumlah_pengeluaran
        ];
        $this->update->updatePengeluaran($id_pengeluaran, $data);

        session()->setFlashdata('success', 'Perubahan data pengeluaran berhasil.');
        return redirect()->to('/pengeluaran');
    }

    function hapus_pengeluaran()
    {
        $id_pengeluaran = $this->request->getVar('id_pengeluaran');

        $this->delete->deletePengeluaran($id_pengeluaran);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }
}
