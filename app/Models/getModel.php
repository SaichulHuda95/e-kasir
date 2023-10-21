<?php

namespace App\Models;

use CodeIgniter\Model;

class getModel extends Model
{
    public function getUserLogin($username)
    {
        $builder = $this->db->table('user');
        $builder->where(['username' => $username]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSession()
    {
        $builder = $this->db->table('user');
        $builder->where(['username' => session()->get('username')]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getCountUser()
    {
        $builder = $this->db->table('user');
        $builder->selectCount('id');
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSumPemasukan()
    {
        $builder = $this->db->table('tbl_jual');
        $builder->selectSum('grand_total');
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSumPemasukanToday($today)
    {
        $builder = $this->db->table('tbl_jual');
        $builder->selectSum('grand_total');
        $builder->where('tgl_jual', $today);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSumPemasukanMonth($month)
    {
        $builder = $this->db->table('tbl_jual');
        $builder->selectSum('grand_total');
        $builder->where('MONTH(tgl_jual)', $month);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSumPemasukanYear($year)
    {
        $builder = $this->db->table('tbl_jual');
        $builder->selectSum('grand_total');
        $builder->where('YEAR(tgl_jual)', $year);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSumPengeluaran()
    {
        $builder = $this->db->table('tbl_pengeluaran');
        $builder->selectSum('jumlah_pengeluaran');
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getTopSale()
    {
        $sql = 'SELECT a.kode_produk,b.nama_produk, SUM(qty) as qty 
                FROM tbl_jual_detil as a 
                LEFT JOIN tbl_produk AS b ON a.kode_produk=b.kode_produk 
                GROUP BY a.kode_produk,b.nama_produk 
                ORDER BY qty 
                DESC LIMIT 5';
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getRecentTransaction()
    {
        $sql = 'SELECT no_faktur, tgl_jual, grand_total, dibayar, kembalian, id_kasir FROM tbl_jual ORDER BY tgl_jual DESC, jam DESC';
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getDetailTransaksi($no_faktur)
    {
        $sql = "SELECT a.*, b.nama_produk, c.grand_total, c.dibayar, c.kembalian FROM tbl_jual_detil AS a 
                LEFT JOIN tbl_produk AS b ON a.kode_produk=b.kode_produk 
                LEFT JOIN tbl_jual AS c ON a.no_faktur=c.no_faktur WHERE a.no_faktur = '$no_faktur'";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getProduk()
    {
        $builder = $this->db->table('tbl_produk');
        $builder->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id_satuan=tbl_produk.id_satuan');
        $builder->orderBy('kode_produk', 'ASC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getProdukByName($nama_produk)
    {
        $builder = $this->db->table('tbl_pengeluaran');
        $builder->select('jumlah_produk, harga_produk');
        $builder->where(['nama_produk' => $nama_produk]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getNamaProduk()
    {
        $sql = "SELECT nama_produk FROM tbl_pengeluaran WHERE nama_produk NOT IN (SELECT nama_produk FROM tbl_produk)";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getKategori()
    {
        $builder = $this->db->table('tbl_kategori');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getKategoriById($id_kategori)
    {
        $builder = $this->db->table('tbl_kategori');
        $builder->where(['id_kategori' => $id_kategori]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getSatuan()
    {
        $builder = $this->db->table('tbl_satuan');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getSatuanById($id_satuan)
    {
        $builder = $this->db->table('tbl_satuan');
        $builder->where(['id_satuan' => $id_satuan]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getMaxKodeBarang()
    {
        $builder = $this->db->table('tbl_produk');
        $builder->selectMax('kode_produk');
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getProdukById($id_produk)
    {
        $builder = $this->db->table('tbl_produk');
        $builder->where(['id_produk' => $id_produk]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getNoFaktur()
    {
        $tgl = date('Ymd');
        $builder = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as no_urut FROM tbl_jual WHERE DATE(tgl_jual) = $tgl");
        $query = $builder->getRow();
        $no_urut = $query->no_urut;
        if ($no_urut > 0) {
            $tmp = $no_urut + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $no_faktur = $tgl . $kd;
        return $no_faktur;
    }

    public function cekProduk($kode_produk)
    {
        $builder = $this->db->table('tbl_produk');
        $builder->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori');
        $builder->join('tbl_satuan', 'tbl_satuan.id_satuan=tbl_produk.id_satuan');
        $builder->where('kode_produk', $kode_produk);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getPengeluaran()
    {
        $builder = $this->db->table('tbl_pengeluaran');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getPengeluaranById($id_pengeluaran)
    {
        $builder = $this->db->table('tbl_pengeluaran');
        $builder->where(['id_pengeluaran' => $id_pengeluaran]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getLaporanPemasukanHarian($tgl_laporan)
    {
        $sql = "SELECT DATE_FORMAT(tgl_jual, '%d/%m/%Y') AS tgl_jual, a.kode_produk, a.harga_jual, a.qty, a.total_harga, b.nama_produk FROM tbl_jual_detil AS a
                LEFT JOIN tbl_produk AS b ON a.kode_produk=b.kode_produk
                LEFT JOIN tbl_jual AS c ON a.no_faktur=c.no_faktur
                WHERE c.tgl_jual = '$tgl_laporan'
                ORDER BY tgl_jual ASC";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getLaporanPengeluaranHarian($tgl_laporan)
    {
        $sql = "SELECT DATE_FORMAT(created_at, '%d/%m/%Y') AS tgl_pengeluaran, nama_produk, jumlah_produk, harga_produk, jumlah_pengeluaran FROM tbl_pengeluaran
                WHERE created_at = '$tgl_laporan'";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getLaporanPemasukanBulananAll($thn_laporan)
    {
        $sql = "SELECT DATE_FORMAT(tgl_jual, '%d/%m/%Y') AS tgl_jual, a.kode_produk, a.harga_jual, a.qty, a.total_harga, b.nama_produk FROM tbl_jual_detil AS a
                LEFT JOIN tbl_produk AS b ON a.kode_produk=b.kode_produk
                LEFT JOIN tbl_jual AS c ON a.no_faktur=c.no_faktur
                WHERE YEAR(tgl_jual) = '$thn_laporan'
                ORDER BY tgl_jual ASC";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getLaporanPemasukanBulanan($bln_laporan, $thn_laporan)
    {
        $sql = "SELECT DATE_FORMAT(tgl_jual, '%d/%m/%Y') AS tgl_jual, a.kode_produk, a.harga_jual, a.qty, a.total_harga, b.nama_produk FROM tbl_jual_detil AS a
                LEFT JOIN tbl_produk AS b ON a.kode_produk=b.kode_produk
                LEFT JOIN tbl_jual AS c ON a.no_faktur=c.no_faktur
                WHERE MONTH(tgl_jual) = '$bln_laporan'
                AND YEAR(tgl_jual) = '$thn_laporan'
                ORDER BY tgl_jual ASC";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getLaporanPengeluaranBulananAll($thn_laporan)
    {
        $sql = "SELECT DATE_FORMAT(created_at, '%d/%m/%Y') AS tgl_pengeluaran, nama_produk, jumlah_produk, harga_produk, jumlah_pengeluaran FROM tbl_pengeluaran
                WHERE YEAR(created_at) = '$thn_laporan'";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getLaporanPengeluaranBulanan($bln_laporan, $thn_laporan)
    {
        $sql = "SELECT DATE_FORMAT(created_at, '%d/%m/%Y') AS tgl_pengeluaran, nama_produk, jumlah_produk, harga_produk, jumlah_pengeluaran FROM tbl_pengeluaran
                WHERE MONTH(created_at) = '$bln_laporan'
                AND YEAR(created_at) = '$thn_laporan'";
        $builder = db_connect()->query($sql);
        $query = $builder->getResult();
        return $query;
    }

    public function getUser()
    {
        $builder = $this->db->table('user_role');
        $builder->join('user', 'user.role_id=user_role.id');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getRole()
    {
        $builder = $this->db->table('user_role');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getUserById($id)
    {
        $db = db_connect();
        $builder = $db->query("SELECT a.*, b.role FROM user AS a INNER JOIN user_role AS b ON b.id=a.role_id WHERE a.id = '$id'");
        $query = $builder->getRow();
        return $query;
    }

    public function getRoleById($id)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getRoleAccess($id)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function getMenu()
    {
        $builder = $this->db->table('user_menu');
        $query = $builder->get()->getResult();
        return $query;
    }
}
