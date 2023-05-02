<?php

namespace App\Controllers;

use App\Models\Post;
use CodeIgniter\RESTful\ResourceController;

class PostController extends ResourceController
{
    private $post;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->post = new Post;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $posts = $this->post->orderBy('id', 'desc')->findAll();
        return view('posts/index', compact('posts'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $post = $this->post->find($id);
        if($post) {
            return view('posts/show', compact('post'));
        }
        else {
            return redirect()->to('/posts');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('posts/create');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
            'created_at' => 'required|min_length[5]',
            'updated_at' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('posts/create', [
                'validation' => $this->validator
            ]);
        }

        $this->post->save([
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description'),
            'created_at' => $this->request->getVar('created_at'),
            'updated_at' => $this->request->getVar('updated_at')
        ]);
        session()->setFlashdata('success', 'Успешно! Запись создана.');
        return redirect()->to(site_url('/posts'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $post = $this->post->find($id);
        if($post) {
            return view('posts/edit', compact('post'));
        }
        else {
            session()->setFlashdata('failed', 'Внимание! Запись не найдена.');
            return redirect()->to('/posts');
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
            'created_at' => 'required|min_length[5]',
            'updated_at' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('posts/create', [
                'validation' => $this->validator
            ]);
        }

        $this->post->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description'),
            'created_at' => $this->request->getVar('created_at'),
            'updated_at' => $this->request->getVar('updated_at')
        ]);
        session()->setFlashdata('success', 'Успешно! Запись обновлена.');
        return redirect()->to(base_url('/posts'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */

    public function delete($id = null) {
        //$post = new Post();
        $this->post = new Post;
        $data['posts'] = $this->post->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/posts'));

    }


}
