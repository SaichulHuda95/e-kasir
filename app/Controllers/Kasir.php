<?php

namespace App\Controllers;

use App\Models\deleteModel;
use App\Models\getModel;
use App\Models\insertModel;
use App\Models\updateModel;

class Kasir extends BaseController
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
        $no_faktur = $this->get->getNoFaktur();
        $cart = \Config\Services::cart();
        $isi_cart = $cart->contents();
        $total = 0;
        foreach ($isi_cart as $row) {
            $subtotal = (int)$row['subtotal'];
            $total += $subtotal;
        }
        $data = [
            'title' => 'Kasir',
            'session' => $session,
            'no_faktur' => $no_faktur,
            'isi_cart' => $isi_cart,
            'total' => $total
        ];
        return view('kasir/kasir', $data);
    }

    function CekProduk()
    {
        $kode_produk = $this->request->getVar('kode_produk');
        $produk = $this->get->cekProduk($kode_produk);
        if ($produk == null) {
            $data = [
                'nama_produk' => '',
                'nama_kategori' => '',
                'nama_satuan' => '',
                'harga_jual' => ''
            ];
        } else {
            $data = [
                'kode_produk' => $produk->kode_produk,
                'nama_produk' => $produk->nama_produk,
                'nama_kategori' => $produk->nama_kategori,
                'nama_satuan' => $produk->nama_satuan,
                'stok' => $produk->stok,
                'harga_jual' => $produk->harga_jual
            ];
        }
        echo json_encode($data);
    }

    function cariProduk()
    {
        $produk = $this->get->getProduk();
        $data = [
            'produk' => $produk
        ];
        $msg = [
            'data' => view('kasir/modalcariproduk', $data)
        ];
        echo json_encode($msg);
    }

    public function clearCart()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to('/kasir');
    }

    public function addCart()
    {
        $kode_produk = $this->request->getVar('kode_produk');
        $produk = $this->get->cekProduk($kode_produk);
        $qty = $this->request->getVar('qty');
        if ($qty > $produk->stok) {
            session()->setFlashdata('fail', 'Stok tidak mencukupi.');
            return redirect()->to('/kasir');
        } else {
            $cart = \Config\Services::cart();
            $cart->insert(array(
                'id'      => $this->request->getVar('kode_produk'),
                'qty'     => $this->request->getVar('qty'),
                'price'   => $this->request->getVar('harga_jual'),
                'name'    => $this->request->getVar('nama_produk'),
                'options' => array(
                    'kategori' => $this->request->getVar('kategori'),
                    'satuan' => $this->request->getVar('satuan')
                )
            ));
            return redirect()->to('/kasir');
        }
    }

    public function deleteCart($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to('/kasir');
    }

    function pembayaran()
    {
        $session = $this->get->getSession();
        $cart = \Config\Services::cart();
        $isi_cart = $cart->contents();
        $no_faktur = $this->request->getVar('no_faktur');
        $grand_total = $this->request->getVar('grand_total');
        $data = [
            'session' => $session,
            'isi_cart' => $isi_cart,
            'no_faktur' => $no_faktur,
            'grand_total' => $grand_total,
        ];
        $msg = [
            'data' => view('kasir/modalpembayaran', $data)
        ];
        echo json_encode($msg);
    }

    function prosesBayar()
    {
        $cart = \Config\Services::cart();
        $isi_cart = $cart->contents();
        $no_faktur = $this->request->getVar('no_faktur');
        $tgl_jual = $this->request->getVar('tgl_jual');
        $jam = $this->request->getVar('jam');
        $grand_total = $this->request->getVar('grand_total');
        $get_dibayar = $this->request->getVar('dibayar');
        $dibayar = preg_replace("/[^0-9]/", "", $get_dibayar);
        $get_kembalian = $this->request->getVar('kembalian');
        $kembalian = preg_replace("/[^0-9]/", "", $get_kembalian);
        $id_kasir = $this->request->getVar('id_kasir');
        $data = [
            'no_faktur' => $no_faktur,
            'tgl_jual' => $tgl_jual,
            'jam' => $jam,
            'grand_total' => $grand_total,
            'dibayar' => $dibayar,
            'kembalian' => $kembalian,
            'id_kasir' => $id_kasir
        ];
        $this->insert->insertPembayaran($data);

        $produk_list = array();
        foreach ($isi_cart as $row) {
            $produk_list[] = array(
                'no_faktur' => $no_faktur,
                'kode_produk' => $row['id'],
                'harga_jual' => $row['price'],
                'qty' => $row['qty'],
                'total_harga' => $row['subtotal']
            );
        }
        $this->insert->insertPembayaranDetil($produk_list);
        $cart->destroy();

        session()->setFlashdata('success', 'Pembayaran berhasil.');
        return redirect()->to('/kasir');
    }
}
