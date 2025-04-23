<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Session\Session;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function login()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if ($this->session->get('isLoggedIn')) {
            $role = $this->session->get('role');
            if ($role === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/user/dashboard');
        }

        return view('auth/login');
    }

    public function attemptLogin()
    {
        $validation = \Config\Services::validation();
        
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah');
        }

        // Set session data
        $sessionData = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true
        ];
        $this->session->set($sessionData);

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }
        return redirect()->to('/user/dashboard');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
