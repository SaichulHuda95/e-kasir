<?php

namespace App\Models;

use CodeIgniter\Model;

class deleteModel extends Model
{

    public function deletePengeluaran($id_pengeluaran)
    {
        $builder = $this->db->table('tbl_pengeluaran');
        $builder->where(['id_pengeluaran' => $id_pengeluaran]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteProduk($id_produk)
    {
        $builder = $this->db->table('tbl_produk');
        $builder->where(['id_produk' => $id_produk]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteKategori($id_kategori)
    {
        $builder = $this->db->table('tbl_kategori');
        $builder->where(['id_kategori' => $id_kategori]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteSatuan($id_satuan)
    {
        $builder = $this->db->table('tbl_satuan');
        $builder->where(['id_satuan' => $id_satuan]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteUser($id)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->delete();
        return $query;
    }

    public function deleteRole($id)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->delete();
        return $query;
    }
}
