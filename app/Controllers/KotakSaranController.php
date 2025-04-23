<?php

namespace App\Controllers;

use App\Models\KotakSaranModel;
use App\Models\TanggapanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KotakSaranController extends BaseController
{
    protected $kotakSaranModel;
    protected $tanggapanModel;

    public function __construct()
    {
        $this->kotakSaranModel = new KotakSaranModel();
        $this->tanggapanModel = new TanggapanModel();
    }

    // User: List saran
    public function index()
    {
        $data = [
            'title' => 'Daftar Saran',
            'saran' => $this->kotakSaranModel->getSaranByUser(session()->get('id')),
            'isAdmin' => session()->get('role') === 'admin'
        ];
        return view('kotak_saran/index', $data);
    }

    // User: Form create saran
    public function create()
    {
        $data = [
            'title' => 'Kirim Saran',
            'validation' => \Config\Services::validation()
        ];
        return view('kotak_saran/form', $data);
    }

    // User: Store saran
    public function store()
    {
        $rules = [
            'isi_saran' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kotakSaranModel->save([
            'user_id' => session()->get('id'),
            'isi_saran' => $this->request->getPost('isi_saran'),
            'status' => 'belum terbaca'
        ]);

        return redirect()->to('/kotak-saran')->with('message', 'Saran berhasil dikirim');
    }

    // User: Show detail saran
    public function show($id)
    {
        $saran = $this->kotakSaranModel->getSaranById($id);
        if (!$saran || $saran['user_id'] != session()->get('id')) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Saran',
            'saran' => $saran,
            'tanggapan' => $this->tanggapanModel->getTanggapanBySaran($id)
        ];
        return view('kotak_saran/show', $data);
    }

    // Admin: List semua saran
    public function adminIndex()
    {
        $data = [
            'title' => 'Kelola Saran',
            'saran' => $this->kotakSaranModel->getAllSaran(),
            'isAdmin' => true
        ];
        return view('kotak_saran/index', $data);
    }

    // Admin: Edit saran
    public function edit($id)
    {
        $saran = $this->kotakSaranModel->find($id);
        if (!$saran) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Saran',
            'saran' => $saran,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/kotak_saran/edit', $data);
    }

    // Admin: Update saran
    public function update($id)
    {
        $rules = [
            'isi_saran' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kotakSaranModel->update($id, [
            'isi_saran' => $this->request->getPost('isi_saran')
        ]);

        return redirect()->to('/admin/kotak-saran')->with('message', 'Saran berhasil diperbarui');
    }

    // Admin: Hapus saran
    public function delete($id)
    {
        $saran = $this->kotakSaranModel->find($id);
        if (!$saran) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        $this->kotakSaranModel->delete($id);
        return redirect()->to('/admin/kotak-saran')->with('message', 'Saran berhasil dihapus');
    }

    // Admin: Store tanggapan
    public function storeTanggapan($saranId)
    {
        // Cek apakah saran ada
        $saran = $this->kotakSaranModel->find($saranId);
        if (!$saran) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        $rules = [
            'isi_tanggapan' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan tanggapan
        $this->tanggapanModel->save([
            'saran_id' => $saranId,
            'user_id' => session()->get('id'),
            'isi_tanggapan' => $this->request->getPost('isi_tanggapan')
        ]);

        // Update status saran menjadi terbaca
        $this->kotakSaranModel->update($saranId, [
            'status' => 'terbaca'
        ]);

        return redirect()->to('/admin/kotak-saran')->with('message', 'Tanggapan berhasil dikirim');
    }

    // Admin: Show form tanggapan
    public function showTanggapanForm($id)
    {
        $saran = $this->kotakSaranModel->getSaranById($id);
        if (!$saran) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        $data = [
            'title' => 'Beri Tanggapan',
            'saran' => $saran,
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/kotak_saran/tanggapan', $data);
    }

    // Admin: Update status saran
    public function updateStatus($id)
    {
        // Cek apakah saran ada
        $saran = $this->kotakSaranModel->find($id);
        if (!$saran) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        try {
            $this->kotakSaranModel->update($id, [
                'status' => 'terbaca'
            ]);
            
            return redirect()->to('/admin/kotak-saran')->with('message', 'Status saran berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->to('/admin/kotak-saran')->with('error', 'Gagal mengupdate status saran');
        }
    }
}
