<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggapanModel extends Model
{
    protected $table      = 'tanggapan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['saran_id', 'user_id', 'isi_tanggapan'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getTanggapanBySaran($saranId)
    {
        return $this->where('saran_id', $saranId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getTanggapanById($id)
    {
        return $this->find($id);
    }

    public function createTanggapan($data)
    {
        return $this->insert($data);
    }

    public function getTanggapanWithUser($saranId)
    {
        return $this->select('tanggapan.*, users.username')
            ->join('users', 'users.id = tanggapan.user_id')
            ->where('saran_id', $saranId)
            ->orderBy('tanggapan.created_at', 'DESC')
            ->findAll();
    }
}
