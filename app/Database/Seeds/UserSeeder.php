<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'user1',
                'email' => 'user1@kotaksaran.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'username' => 'user2',
                'email' => 'user2@kotaksaran.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
