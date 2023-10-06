<?php

namespace App\Models;

use CodeIgniter\Model;

class insertModel extends Model
{
    public function insertProduk($data)
    {
        $builder = $this->db->table('tbl_produk');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertPembayaran($data)
    {
        $builder = $this->db->table('tbl_jual');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertPembayaranDetil($produk_list)
    {
        $builder = $this->db->table('tbl_jual_detil');
        $query = $builder->insertBatch($produk_list);
        return $query;
    }

    public function insertPengeluaran($data)
    {
        $builder = $this->db->table('tbl_pengeluaran');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertKategori($data)
    {
        $builder = $this->db->table('tbl_kategori');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertSatuan($data)
    {
        $builder = $this->db->table('tbl_satuan');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertUser($data)
    {
        $builder = $this->db->table('user');
        $query = $builder->insert($data);
        return $query;
    }


    public function insertRole($data)
    {
        $builder = $this->db->table('user_role');
        $query = $builder->insert($data);
        return $query;
    }
}
