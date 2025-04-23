<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KotakSaranModel;
use App\Models\TanggapanModel;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $kotakSaranModel;
    protected $tanggapanModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kotakSaranModel = new KotakSaranModel();
        $this->tanggapanModel = new TanggapanModel();
    }

    public function index()
    {
        $role = session()->get('role');
        
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        }
        
        return redirect()->to('/login');
    }

    public function admin()
    {
        // Data statistik
        $data['total_users'] = $this->userModel->countAll();
        $data['total_saran'] = $this->kotakSaranModel->countAll();
        $data['saran_belum_terbaca'] = $this->kotakSaranModel->where('status', 'belum_terbaca')->countAllResults();
        $data['saran_tanpa_tanggapan'] = $this->kotakSaranModel->getSaranTanpaTanggapan();

        // Data chart
        $data['chart_labels'] = $this->getLast7Days();
        $data['chart_data'] = $this->getSaranChartData();

        // Aktivitas terbaru
        $data['aktivitas_terbaru'] = $this->getAktivitasTerbaru();

        return view('admin/dashboard', $data);
    }

    public function user()
    {
        $userId = session()->get('id');

        // Data statistik
        $data['total_saran'] = $this->kotakSaranModel->where('user_id', $userId)->countAllResults();
        $data['saran_terbaca'] = $this->kotakSaranModel->where([
            'user_id' => $userId,
            'status' => 'terbaca'
        ])->countAllResults();
        $data['saran_tanggapan'] = $this->kotakSaranModel->getSaranDenganTanggapan($userId);

        // Data chart
        $data['chart_labels'] = $this->getLast7Days();
        $data['chart_data'] = $this->getSaranChartData($userId);

        // Aktivitas terbaru
        $data['aktivitas_terbaru'] = $this->getAktivitasTerbaru($userId);

        return view('user/dashboard', $data);
    }

    private function getLast7Days()
    {
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $labels[] = date('d M', strtotime("-$i days"));
        }
        return $labels;
    }

    private function getSaranChartData($userId = null)
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            $builder = $this->kotakSaranModel;
            if ($userId) {
                $builder->where('user_id', $userId);
            }
            
            $data[] = $builder->where('DATE(created_at)', $date)
                ->countAllResults();
        }
        return $data;
    }

    private function getAktivitasTerbaru($userId = null)
    {
        $aktivitas = [];

        // Ambil 5 saran terbaru
        $builder = $this->kotakSaranModel->orderBy('created_at', 'DESC');
        if ($userId) {
            $builder->where('user_id', $userId);
        }
        $saran = $builder->findAll(5);

        foreach ($saran as $s) {
            $aktivitas[] = [
                 'deskripsi' => 'Mengirim saran: ' . substr($s->isi_saran, 0, 50) . '...',
                 'waktu' => date('d M H:i', strtotime($s->created_at))
            ];
        }

        // Ambil 5 tanggapan terbaru
        $builder = $this->tanggapanModel->orderBy('created_at', 'DESC');
        if ($userId) {
            $builder->where('user_id', $userId);
        }
        $tanggapan = $builder->findAll(5);

        foreach ($tanggapan as $t) {
            $aktivitas[] = [
                'deskripsi' => 'Memberi tanggapan: ' . substr($t->isi_tanggapan, 0, 50) . '...',
                'waktu' => date('d M H:i', strtotime($t->created_at))
            ];
        }

        // Urutkan berdasarkan waktu terbaru
        usort($aktivitas, function($a, $b) {
            return strtotime($b['waktu']) - strtotime($a['waktu']);
        });

        return array_slice($aktivitas, 0, 5);
    }
}
