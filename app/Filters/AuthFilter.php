<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Jika belum login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Jika ada argument role
        if (!empty($arguments)) {
            $role = $arguments[0];
            
            // Cek role user
            if ($role === 'admin' && $session->get('role') !== 'admin') {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses');
            }
            
            if ($role === 'user' && $session->get('role') !== 'user') {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
