<?php

namespace App\Models;

use CodeIgniter\Model;

class KotakSaranModel extends Model
{
    protected $table      = 'kotak_saran';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'isi_saran', 'status'];

    public function getSaranDenganTanggapan($userId)
    {
        return $this->select('kotak_saran.*')
            ->join('tanggapan', 'tanggapan.saran_id = kotak_saran.id')
            ->where('kotak_saran.user_id', $userId)
            ->groupBy('kotak_saran.id')
            ->findAll();
    }

    public function getSaranTanpaTanggapan()
    {
        return $this->db->table('kotak_saran')
            ->select('kotak_saran.*')
            ->join('tanggapan', 'kotak_saran.id = tanggapan.saran_id', 'left')
            ->where('tanggapan.id IS NULL')
            ->countAllResults();
    }

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getSaranByUser($userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getSaranById($id)
    {
        return $this->find($id);
    }

    public function find($id = null)
    {
        return $this->db->table('kotak_saran')
            ->select('kotak_saran.*, users.username')
            ->join('users', 'users.id = kotak_saran.user_id')
            ->where('kotak_saran.id', $id)
            ->get()
            ->getRowArray();
    }

    public function getAllSaran()
    {
        return $this->select('kotak_saran.*, users.username')
            ->join('users', 'users.id = kotak_saran.user_id')
            ->orderBy('kotak_saran.created_at', 'DESC')
            ->findAll();
    }

    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }
}
