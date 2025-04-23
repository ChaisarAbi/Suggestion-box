<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KotakSaranModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $kotakSaranModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kotakSaranModel = new KotakSaranModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];

        return view('admin/users/index', $data);
    }

    public function show($id)
    {
        $user = $this->userModel->find($id);
        
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // Get saran by user_id
        $saran = $this->kotakSaranModel->where('user_id', $id)->findAll();

        $data = [
            'title' => 'Detail User',
            'user' => $user,
            'saran' => $saran
        ];

        return view('admin/users/show', $data);
    }
}
