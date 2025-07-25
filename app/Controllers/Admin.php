<?php

namespace App\Controllers;
use App\Models\PostModel;

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $postModel = new PostModel();
        $data['posts'] = $postModel->findAll();
        return view('admin/indexx', $data);
    }

    public function create()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        return view('admin/create');
    }

    public function store()
    {
        $postModel = new PostModel();

        $imagen = $this->request->getFile('imagen');
        $nombreImagen = '';

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved() &&
            in_array($imagen->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
            
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
        }

        $postModel->save([
            'titulo'    => $this->request->getPost('titulo'),
            'fecha'     => $this->request->getPost('fecha'),
            'categoria' => $this->request->getPost('categoria'),
            'contenido' => $this->request->getPost('contenido'),
            'imagen'    => $nombreImagen,
            'calificacion' => $this->request->getPost('calificacion', FILTER_VALIDATE_INT) ?: 0
        ]);

        return redirect()->to('/admin');
    }

    public function edit($id)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $postModel = new PostModel();
        $data['post'] = $postModel->find($id);
        return view('admin/edit', $data);
    }

    public function update($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        $imagen = $this->request->getFile('imagen');
        $nombreImagen = $post['imagen']; // por defecto la misma imagen

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved() &&
            in_array($imagen->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
            
            // Eliminar imagen anterior
            if (!empty($post['imagen']) && file_exists(ROOTPATH . 'public/uploads/' . $post['imagen'])) {
                unlink(ROOTPATH . 'public/uploads/' . $post['imagen']);
            }

            // Guardar nueva imagen
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
        }

        $postModel->update($id, [
            'titulo'    => $this->request->getPost('titulo'),
            'fecha'     => $this->request->getPost('fecha'),
            'categoria' => $this->request->getPost('categoria'),
            'contenido' => $this->request->getPost('contenido'),
            'imagen'    => $nombreImagen,
            'calificacion' => $this->request->getPost('calificacion', FILTER_VALIDATE_INT) ?: 0
        ]);

        return redirect()->to('/admin');
    }

    public function delete($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        if (!empty($post['imagen']) && file_exists(ROOTPATH . 'public/uploads/' . $post['imagen'])) {
            unlink(ROOTPATH . 'public/uploads/' . $post['imagen']);
        }

        $postModel->delete($id);
        return redirect()->to('/admin');
    }
}
