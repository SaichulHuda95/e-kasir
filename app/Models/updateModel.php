<?php

namespace App\Models;

use CodeIgniter\Model;

class updateModel extends Model
{
    public function updatePengeluaran($id_pengeluaran, $data)
    {
        $builder = $this->db->table('tbl_pengeluaran');
        $builder->where(['id_pengeluaran' => $id_pengeluaran]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateProduk($id_produk, $data)
    {
        $builder = $this->db->table('tbl_produk');
        $builder->where(['id_produk' => $id_produk]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateKategori($id_kategori, $data)
    {
        $builder = $this->db->table('tbl_kategori');
        $builder->where(['id_kategori' => $id_kategori]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateSatuan($id_satuan, $data)
    {
        $builder = $this->db->table('tbl_satuan');
        $builder->where(['id_satuan' => $id_satuan]);
        $query = $builder->update($data);
        return $query;
    }

    public function updatePassword($id, $data)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateUser($id, $data)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateRole($id, $data)
    {
        $builder = $this->db->table('user_role');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }

    public function updateFoto($id, $data)
    {
        $builder = $this->db->table('user');
        $builder->where(['id' => $id]);
        $query = $builder->update($data);
        return $query;
    }
}
