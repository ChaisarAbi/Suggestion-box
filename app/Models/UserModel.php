<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'email', 'role'];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'password' => 'required|min_length[6]',
        'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
        'role' => 'required|in_list[admin,user]'
    ];
    
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Username sudah digunakan'
        ],
        'email' => [
            'is_unique' => 'Email sudah digunakan'
        ]
    ];
    
    protected $beforeInsert = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
    
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
    
    public function updatePassword($id, $password)
    {
        return $this->update($id, [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
    
    public function getAllUsers()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
}
