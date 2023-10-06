<?php

namespace App\Controllers;

use App\Models\getModel;
use App\Models\insertModel;
use App\Models\deleteModel;
use App\Models\updateModel;

class Pengaturan extends BaseController
{
    public function __construct()
    {
        $this->get = new getModel();
        $this->insert = new insertModel();
        $this->delete = new deleteModel();
        $this->update = new updateModel();
    }

    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $kategori = $this->get->getKategori();
        $satuan = $this->get->getSatuan();
        $user = $this->get->getUser();
        $role = $this->get->getRole();
        $data = [
            'title' => 'Pengaturan',
            'kategori' => $kategori,
            'satuan' => $satuan,
            'user' => $user,
            'role' => $role,
            'session' =>  $session
        ];
        return view('setting/index', $data);
    }

    function tambah_kategori()
    {
        $msg = [
            'data' => view('setting/modaltambahkategori')
        ];

        echo json_encode($msg);
    }

    public function simpan_kategori()
    {
        $nama_kategori = $this->request->getVar('nama_kategori');
        $data = [
            'nama_kategori' => $nama_kategori,
        ];
        $this->insert->insertKategori($data);

        session()->setFlashdata('success', 'Penambahan data kategori berhasil.');
        return redirect()->to('/pengaturan');
    }

    function edit_kategori()
    {
        $id_kategori = $this->request->getVar('id_kategori');
        $data_kategori = $this->get->getKategoriById($id_kategori);
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $data_kategori->nama_kategori
        ];
        $msg = [
            'data' => view('setting/modaleditkategori', $data)
        ];
        echo json_encode($msg);
    }

    public function update_kategori()
    {
        $id_kategori = $this->request->getVar('id_kategori');
        $nama_kategori = $this->request->getVar('nama_kategori');
        $data = [
            'nama_kategori' => $nama_kategori
        ];
        $this->update->updateKategori($id_kategori, $data);

        session()->setFlashdata('success', 'Perubahan data kategori berhasil.');
        return redirect()->to('/pengaturan');
    }

    function hapus_kategori()
    {
        $id_kategori = $this->request->getVar('id_kategori');

        $this->delete->deleteKategori($id_kategori);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }

    function tambah_satuan()
    {
        $msg = [
            'data' => view('setting/modaltambahsatuan')
        ];

        echo json_encode($msg);
    }

    public function simpan_satuan()
    {
        $nama_satuan = $this->request->getVar('nama_satuan');
        $data = [
            'nama_satuan' => $nama_satuan,
        ];
        $this->insert->insertSatuan($data);

        session()->setFlashdata('success', 'Penambahan data satuan berhasil.');
        return redirect()->to('/pengaturan');
    }

    function edit_satuan()
    {
        $id_satuan = $this->request->getVar('id_satuan');
        $data_satuan = $this->get->getSatuanById($id_satuan);
        $data = [
            'id_satuan' => $id_satuan,
            'nama_satuan' => $data_satuan->nama_satuan
        ];
        $msg = [
            'data' => view('setting/modaleditsatuan', $data)
        ];
        echo json_encode($msg);
    }

    public function update_satuan()
    {
        $id_satuan = $this->request->getVar('id_satuan');
        $nama_satuan = $this->request->getVar('nama_satuan');
        $data = [
            'nama_satuan' => $nama_satuan
        ];
        $this->update->updateSatuan($id_satuan, $data);

        session()->setFlashdata('success', 'Perubahan data satuan berhasil.');
        return redirect()->to('/pengaturan');
    }

    function hapus_satuan()
    {
        $id_satuan = $this->request->getVar('id_satuan');

        $this->delete->deleteSatuan($id_satuan);

        $msg = [
            'sukses' => 'Data berhasil dihapus'
        ];
        echo json_encode($msg);
    }

    function add_user()
    {
        $session = $this->get->getSession();
        $role = $this->get->getRole();
        $data = [
            'title' => 'Manajemen User',
            'session' => $session,
            'role' => $role,
            'validation' => \Config\Services::validation()
        ];
        return view('setting/adduser', $data);
    }

    public function save_user()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|trim|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username telah terdaftar'
                ],
            ],
            'email' => [
                'rules' => 'required|trim|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email telah terdaftar'
                ],
            ],
            'password1' => [
                'rules' => 'required|trim|min_length[3]|matches[password2]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 3 karakter/angka',
                    'matches' => 'Password tidak sama'
                ],
            ],
            'password2' => [
                'rules' => 'required|trim|min_length[3]|matches[password1]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 3 karakter/angka',
                    'matches' => 'Password tidak sama'
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/pengaturan/add_user')->withInput()->with('validation', $validation);
        } else {
            $data = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->request->getVar('role'),
                'is_active' => $this->request->getVar('is_active'),
                'created_at' => date('Y-m-d')
            ];
            $this->insert->insertUser($data);
            session()->setFlashdata('success', 'Pendaftaran berhasil.');
            return redirect()->to('/pengaturan');
        }
    }

    function hapus_user()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->delete->deleteUser($id);

            $msg = [
                'sukses' => 'User berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function edit_user($id)
    {
        $session = $this->get->getSession();
        $user = $this->get->getUserById($id);
        $role = $this->get->getRole();
        $data = [
            'title' => 'Manajemen User',
            'session' => $session,
            'id' => $id,
            'role' => $role,
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];
        return view('setting/edit_user', $data);
    }

    function update_user()
    {
        $id = $this->request->getVar('id');
        if (!$this->validate([
            'username' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Username harus diisi'
                ],
            ],
            'email' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Email harus diisi'
                ],
            ],
            'password1' => [
                'rules' => 'required|trim|min_length[3]|matches[password2]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 3 karakter/angka',
                    'matches' => 'Password tidak sama'
                ],
            ],
            'password2' => [
                'rules' => 'required|trim|min_length[3]|matches[password1]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 3 karakter/angka',
                    'matches' => 'Password tidak sama'
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        } else {
            $data = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->request->getVar('role'),
                'is_active' => $this->request->getVar('is_active'),
            ];
            $this->update->updateUser($id, $data);
            session()->setFlashdata('success', 'User berhasil diupdate.');
            return redirect()->to('/pengaturan');
        }
    }

    function tambah_role()
    {
        $msg = [
            'data' => view('setting/modaltambahrole')
        ];

        echo json_encode($msg);
    }

    public function simpan_role()
    {
        $role = $this->request->getVar('role');
        $data = [
            'role' => $role
        ];
        $this->insert->insertRole($data);

        session()->setFlashdata('success', 'Penambahan data hak akses berhasil.');
        return redirect()->to('/pengaturan');
    }

    function hapus_role()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->delete->deleteRole($id);

            $msg = [
                'sukses' => 'Data berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function edit_role()
    {
        if ($this->request->isAJAX()) {
            $id =  $this->request->getVar('id');
            $ambildatarole = $this->get->getRoleById($id);
            $data = [
                'id' => $id,
                'role' => $ambildatarole->role
            ];

            $msg = [
                'data' => view('setting/modaleditrole', $data)
            ];
            echo json_encode($msg);
        }
    }

    function update_role()
    {
        $id = $this->request->getVar('id');
        $role = $this->request->getVar('role');
        $data = [
            'role' => $role
        ];

        $this->update->updateRole($id, $data);

        session()->setFlashdata('success', 'Perubahan hak akses berhasil.');
        return redirect()->to('/pengaturan');
    }

    public function roleaccess($id)
    {
        $session = $this->get->getSession();
        $role = $this->get->getRoleAccess($id);
        $menu = $this->get->getMenu();
        $data = [
            'title' => 'Manajemen User',
            'role' => $role,
            'menu' => $menu,
            'session' =>  $session
        ];
        return view('setting/role_access', $data);
    }

    public function change_access()
    {
        $menu_id = $this->request->getVar('menuId');
        $role_id = $this->request->getVar('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('user_access_menu');
        $builder->where($data);
        $query = $builder->get()->getRow();

        if ($query < 1) {
            $builder->insert($data);
        } else {
            $builder->delete($data);
        }

        session()->setFlashdata('success', 'Perubahan hak akses berhasil.');
    }
}
