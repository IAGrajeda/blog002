<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostModel;

class Blog extends BaseController
{
    public function index()
    {
        // Cargar el modelo de Post
        $postModel = new PostModel();
        $data['posts'] = $postModel->findAll();
        return view('blog/index', $data);
    }
}