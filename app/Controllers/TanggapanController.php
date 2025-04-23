<?php

namespace App\Controllers;

use App\Models\KotakSaranModel;
use App\Models\TanggapanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class TanggapanController extends BaseController
{
    protected $kotakSaranModel;
    protected $tanggapanModel;

    public function __construct()
    {
        $this->kotakSaranModel = new KotakSaranModel();
        $this->tanggapanModel = new TanggapanModel();
    }

    public function create($saranId)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'isi_tanggapan' => 'required|min_length[10]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Ambil data saran
        $saran = $this->kotakSaranModel->getSaranById($saranId);
        if (!$saran) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        // Simpan tanggapan
        $data = [
            'saran_id' => $saranId,
            'user_id' => session()->get('user_id'),
            'isi_tanggapan' => $this->request->getPost('isi_tanggapan')
        ];

        $this->tanggapanModel->createTanggapan($data);

        // Update status saran menjadi terbaca
        $this->kotakSaranModel->updateStatus($saranId, 'terbaca');

        return redirect()->to("/kotak-saran/$saranId")
            ->with('message', 'Tanggapan berhasil dikirim');
    }

    public function show($saranId)
    {
        $saran = $this->kotakSaranModel->getSaranById($saranId);
        if (!$saran) {
            throw new PageNotFoundException('Saran tidak ditemukan');
        }

        $tanggapan = $this->tanggapanModel->getTanggapanWithUser($saranId);

        return view('tanggapan/show', [
            'saran' => $saran,
            'tanggapan' => $tanggapan
        ]);
    }
}
