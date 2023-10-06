<?php

namespace App\Controllers;

use App\Models\getModel;
use App\Models\updateModel;

class Profil extends BaseController
{
    public function __construct()
    {
        $this->get = new getModel();
        $this->update = new updateModel();
    }

    public function index()
    {
        if (session()->get('logged_in') == FALSE) {
            return redirect()->to('/');
        }
        $session = $this->get->getSession();
        $data = [
            'title' => 'Profil Saya',
            'session' =>  $session
        ];
        return view('profil/index', $data);
    }

    public function edit_profil()
    {
        $session = $this->get->getSession();
        $data = [
            'title' => 'Profil Saya',
            'validation' => \Config\Services::validation(),
            'session' =>  $session
        ];
        return view('profil/edit_profil', $data);
    }

    public function update_profil()
    {
        if (!$this->validate([
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image, image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran foto terlalu besar',
                    'is_image' => 'File bukan berupa gambar',
                    'mime_in' => 'File bukan berupa gambar'
                ],
            ],
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/user/editprofil')->withInput()->with('validation', $validation);
            return redirect()->to('/profil/edit_profil')->withInput();
        }
        // ambil gambar
        $foto = $this->request->getFile('image');
        // generate nama file
        $nama_foto = $foto->getRandomName();
        // pindahkan file
        $foto->move('assets/img/profil', $nama_foto);
        $image_lama = $this->request->getVar('image_lama');
        // hapus file yang lama
        if ($image_lama != 'default.jpg') {
            unlink('assets/img/profil/' . $image_lama);
        }

        $id = $this->request->getVar('id');
        $data = [
            'image' => $nama_foto
        ];
        $this->update->updateFoto($id, $data);

        session()->setFlashdata('success', 'Perubahan foto berhasil.');
        return redirect()->to('/profil');
    }

    public function change_password()
    {
        $session = $this->get->getSession();
        $data = [
            'title' => 'Profil Saya',
            'validation' => \Config\Services::validation(),
            'session' =>  $session
        ];
        return view('profil/change_password', $data);
    }

    public function update_password()
    {
        $session = $this->get->getSession();
        if (!$this->validate([
            'current_password' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Password harus diisi'
                ],
            ],
            'new_password1' => [
                'rules' => 'required|trim|min_length[3]|matches[new_password2]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 3 karakter/angka',
                    'matches' => 'Password tidak sama'
                ],
            ],
            'new_password2' => [
                'rules' => 'required|trim|min_length[3]|matches[new_password1]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 3 karakter/angka',
                    'matches' => 'Password tidak sama'
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/profil/change_password')->withInput()->with('validation', $validation);
        } else {
            $current_password = $this->request->getVar('current_password');
            $new_password = $this->request->getVar('new_password1');
            if (!password_verify($current_password, $session->password)) {
                session()->setFlashdata('fail', 'Password lama salah.');
                return redirect()->to('/profil/change_password');
            } else {
                if ($current_password == $new_password) {
                    session()->setFlashdata('fail', 'Password baru tidak boleh sama dengan yang lama.');
                    return redirect()->to('/profil/change_password');
                } else {
                    // sukses
                    $id = $session->id;
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $data = [
                        'password' => $password_hash
                    ];

                    $this->update->updatePassword($id, $data);
                    session()->setFlashdata('success', 'Password berhasil dirubah.');
                    return redirect()->to('/profil');
                }
            }
        }
    }
}
