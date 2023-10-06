<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;

class Produk extends BaseController
{
    public function __construct()
    {
        $this->delete = new deleteModel();
        $this->get = new getModel();
        $this->insert = new insertModel();
        $this->update = new updateModel();
    }
    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $produk = $this->get->getProduk();
        $data = [
            'title' => 'Produk',
            'session' => $session,
            'produk' => $produk
        ];
        return view('produk/daftar_produk', $data);
    }

    public function tambah_produk()
    {
        $session = $this->get->getSession();
        $nama_produk = $this->get->getNamaProduk();
        $kategori = $this->get->getKategori();
        $satuan = $this->get->getSatuan();
        $data = [
            'title' => 'Produk',
            'session' => $session,
            'nama_produk' => $nama_produk,
            'kategori' => $kategori,
            'satuan' => $satuan
        ];
        return view('produk/tambah_produk', $data);
    }

    function get_produk()
    {
        $nama_produk = $this->request->getVar('nama_produk');
        $produk = $this->get->getProdukByName($nama_produk);
        $data = [
            'jumlah_produk' => $produk->jumlah_produk,
            'harga_produk' => $produk->harga_produk
        ];
        echo json_encode($data);
    }

    public function simpan_produk()
    {
        $nama_produk = $this->request->getVar('nama_produk');
        $id_kategori = $this->request->getVar('id_kategori');
        $id_satuan = $this->request->getVar('id_satuan');
        $get_harga_beli = $this->request->getVar('harga_beli');
        $harga_beli = preg_replace("/[^0-9]/", "", $get_harga_beli);
        $get_harga_jual = $this->request->getVar('harga_jual');
        $harga_jual = preg_replace("/[^0-9]/", "", $get_harga_jual);
        $stok = $this->request->getVar('stok');
        $maxKodeBarang = $this->get->getMaxKodeBarang();
        $no = (int)$maxKodeBarang->kode_produk + 1;
        $kode_produk = sprintf("%04s", $no);
        $data = [
            'kode_produk' => $kode_produk,
            'nama_produk' => $nama_produk,
            'id_kategori' => $id_kategori,
            'id_satuan' => $id_satuan,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $stok
        ];

        $this->insert->insertProduk($data);
        session()->setFlashdata('success', 'Penambahan produk berhasil.');
        return redirect()->to('/produk');
    }

    public function edit_produk($id_produk)
    {
        $session = $this->get->getSession();
        $kategori = $this->get->getKategori();
        $satuan = $this->get->getSatuan();
        $data_produk = $this->get->getProdukById($id_produk);
        $data = [
            'title' => 'Produk',
            'session' => $session,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'data_produk' => $data_produk
        ];
        return view('produk/edit_produk', $data);
    }

    public function update_produk()
    {
        $id_produk = $this->request->getVar('id_produk');
        $nama_produk = $this->request->getVar('nama_produk');
        $id_kategori = $this->request->getVar('id_kategori');
        $id_satuan = $this->request->getVar('id_satuan');
        $harga_beli = $this->request->getVar('harga_beli');
        $harga_jual = $this->request->getVar('harga_jual');
        $stok = $this->request->getVar('stok');
        $data = [
            'nama_produk' => $nama_produk,
            'id_kategori' => $id_kategori,
            'id_satuan' => $id_satuan,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $stok
        ];

        $this->update->updateProduk($id_produk, $data);
        session()->setFlashdata('success', 'Perubahan produk berhasil.');
        return redirect()->to('/produk');
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');

            $this->delete->deleteProduk($id_produk);

            $msg = [
                'sukses' => 'Data berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }
}
