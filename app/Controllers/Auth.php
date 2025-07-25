<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends BaseController{

    public function login()
    {
        return view('auth/login');
    }

    public function auth()
    {
        // Validación de los datos del formulario
        $usuario = $this->request->getPost('usuario');
        $clave = $this->request->getPost('clave');

        // lógica para verificar las credenciales
        if ($usuario === 'admin' && $clave === 'admin') {
            session()->set('logueado', true);
            return redirect()->to('/admin');
        } else {
            return redirect()->to('/login')->with('error', 'Credenciales incorrectas');
        }
    }

    public function logout()
    {
        // Destruye la sesión y redirige al login
        session()->destroy();
        return redirect()->to('/login');
    }
}